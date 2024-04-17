<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Court;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TransactionController extends Controller
{
    // menampilkan halaman daftarbooking
    public function index()
    {
        $bookings = Transaction::where('paytotal', '=', 0)->get();
        return view('daftarbooking', compact('bookings'));
    }

    // menampilkan halaman booking
    public function create()
    {
        $courts = Court::all();
        return view('booking', compact('courts'));
    }

    // menyimpan data booking
    public function store(Request $request)
    {
        $court = Court::find($request->court_id);

        $message = [
            'required' => ':attribute harus diisi',
            'min' => ':attribute minimal :min karakter',
            'after' => ':attribute minimal hari ini'
        ];

        $startTime = Carbon::parse($request->starttime)->format('H:i:s');
        $endTime = Carbon::parse($request->starttime)->addHour($request->durasi)->format('H:i:s');

        $check = Transaction::where('court_id', $request->court_id)->where('tanggal', $request->tanggal)
        ->where(function ($query) use ($startTime, $endTime) {
            //                                  ↓ this
            $query->where(function ($subQuery) use ($startTime, $endTime) {
                $subQuery->whereTime('starttime', '>=', $startTime)
                    ->whereTime('starttime', '<', $endTime);
            })
            //                                  ↓ this
                ->orWhere(function ($subQuery) use ($startTime, $endTime) {
                    $subQuery->whereTime('endtime', '<=', $endTime)
                        ->whereTime('endtime', '>', $startTime);
                });
        })->get();

        if ($check->count() > 0) {
            return back()->with('error', 'Jadwal sudah ada')->withInput($request->input());
        }

        $this->validate($request, [
            'nama' => 'required|min:3',
            'alamat' => 'required|min:15',
            'telepon' => 'required|min:11',
            'tanggal' => 'required|after:yesterday',
            'starttime' => 'required',
            'durasi' => 'required|min:0',
        ], $message);

        if ($request->kostum != 45000) {
            $kostum = 0;
        }else {
            $kostum = 45000;
        }

        if ($request->sepatu != 50000) {
            $sepatu = 0;
        }else {
            $sepatu = 50000;
        }

        $total = (($request->durasi)*$court['harga']) + ($request->durasi)*($kostum + $sepatu);

        $booking = Transaction::create([
            'user_id' => Auth::user()->id,
            'court_id' => $request->court_id,
            'nama' => $request->nama,
            'alamat' => $request->alamat,
            'telepon' => $request->telepon,
            'tanggal' => $request->tanggal,
            'starttime' => $startTime,
            'endtime' => $endTime,
            'durasi' => $request->durasi,
            'kostum' => $request->kostum*$request->durasi,
            'sepatu' => $request->sepatu*$request->durasi,
            'total' => $total
        ]);

        if ($booking) {
            return redirect(route('booking.index'))->with(['success' => 'Booking Berhasil Dilakukan!']);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Transaction $transaction)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Transaction $transaction)
    {
        //
    }

    // menampilkan halaman pembayaran
    public function bayar($id)
    {
        $booking = Transaction::find($id);
        return view('bayar', compact('booking'));
    }

    // update pembayaran
    public function update(Request $request, $id)
    {
        $message = [
            'required' => ':attribute harus diisi',
            'min' => ':attribute minimal :min karakter',
        ];

        $this->validate($request, [
            'paytotal' => 'required',
        ], $message);
    
        $bayar = Transaction::findOrFail($id);    
        if ($bayar->total <= $request->paytotal) {
            $bayar->update([
                'paytotal' => $request->paytotal
            ]);
        }else{
            //redirect dengan pesan error
            return redirect()->back()->with('error', 'Uang anda kurang');
        }
    
        if($bayar){
            //redirect dengan pesan sukses
            return redirect(route('booking.index'))->with(['success' => 'Pembayaran Berhasil']);
        }
    }

    // menampilkan halaman riwayat transaksi
    public function riwayat() {
        $bookings = Transaction::where('paytotal', '!=', 0)->get();
        return view('riwayat', compact('bookings'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Transaction $transaction)
    {
        //
    }
}

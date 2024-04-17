@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row mt-3">
            <div class="row mb-3">
                <div class="col-6">
                    <h3>Riwayat Transaksi</h3>
                </div>
            </div>
            <div class="col-md-12 mb-4">
                <table class="table table-striped">
                    <tr>
                        <th>#</th>
                        <th>Nama</th>
                        <th>Lapangan</th>
                        <th>Tanggal</th>
                        <th>Jam Mulai</th>
                        <th>Jam Selesai</th>
                        <th>Total</th>
                        <th>Aksi</th>
                    </tr>
                    @forelse ($bookings as $booking) 
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $booking->nama }}</td>
                            <td>{{ $booking->court->court_type->nama }} | {{ $booking->court->nama }}</td>
                            <td>{{ $booking->tanggal }}</td>
                            <td>{{ $booking->starttime }}</td>
                            <td>{{ $booking->endtime }}</td>
                            <td>Rp. {{ number_format($booking->total, 2, '.', '.') }}</td>
                            <td>
                                <button class="btn btn-sm btn-success">Lunas</button>
                            </td>
                        </tr>
                        @empty
                        <tr> 
                            <th scope="row" colspan="8" class="text-center">Data belum tersedia</th>
                        </tr>
                    @endforelse
                </table>
            </div>
        </div>
    </div>
@endsection
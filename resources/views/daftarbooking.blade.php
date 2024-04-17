@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row mt-3">
            @if (Session::has('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>{{ session::get('success') }}</strong>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
            <div class="row mb-3">
                <div class="col-6">
                    <h3>Daftar Booking</h3>
                </div>
                <div class="col-6 text-end">
                    <a href="{{ route('booking.create') }}" class="btn btn-outline-success">Booking</a>
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
                                <a href="{{ route('booking.bayar', $booking->id) }}" class="btn btn-sm btn-outline-info">Bayar</a>
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
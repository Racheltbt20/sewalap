@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            @if (Session::has('error'))
                <div class="alert alert-error alert-dismissible fade show" role="alert">
                    <strong>{{ session::get('error') }}</strong>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
            <div class="row mb-3">
                <div class="col-6 text-start">
                    <a href="{{ route('booking.index') }}" class="btn btn-outline-info">Kembali</a>
                </div>
            </div>
            <div class="card">
                <div class="card-body">
                <form action="{{ route('booking.update', $booking->id) }}" method="post">
                    @csrf
                    @method('PUT')
                        <div class="mb-3">
                            <label for="basic-url" class="form-label">Total Sewa</label>
                            <div class="input-group">
                                <input type="text" class="form-control" placeholder="Total" name="total" value="{{ old('total', $booking->total) }}" id="total" required readonly>
                            </div>
                        </div>
                        <div class="mb-3 form-group">
                            <label for="basic-url" class="form-label">Total Bayar (pembayaran harus lebih dari atau sama dengan total sewa)</label>
                            <input type="number" class="form-control @error('paytotal') is-invalid @enderror" placeholder="Total Bayar" name="paytotal" value="{{ old('paytotal') }}" id="paytotal" min="{{ $booking->total }}" required>   
                            @error('paytotal')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="basic-url" class="form-label">Kembalian</label>
                            <div class="input-group">
                                <input type="text" class="form-control" placeholder="Kembali" name="kembalian" id="kembalian" readonly>
                            </div>
                        </div>
                        <div class="input-group mb-3">
                            <input type="submit" value="Simpan" class="btn btn-success">
                        </div>
                    <form>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    document.getElementById("paytotal").addEventListener('input', ()=> {
          let total = document.getElementById('total').value
          let bayar = document.getElementById('paytotal').value
          document.getElementById('kembalian').value = bayar - total
    })
</script>
@endsection
@extends('layouts.app')

@section('content')
    <div class="container">
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
                <form id="form-category" action="{{ route('booking.store') }}" method="post">
                @csrf
                @method('POST')
                    <div class="row">
                        <div class="col-6">
                            <div class="mb-3 form-group">
                                <label for="basic-url" class="form-label">Nama</label>
                                <input type="text" class="form-control @error('nama') is-invalid @enderror" placeholder="Nama" name="nama" value="{{ old('nama') }}" required>
                                @error('nama')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="mb-3 form-group">
                                <label for="basic-url" class="form-label">Alamat</label>
                                <input type="text" class="form-control @error('alamat') is-invalid @enderror" placeholder="Alamat" name="alamat" value="{{ old('alamat') }}" required>
                                @error('alamat')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="mb-3 form-group">
                                <label for="basic-url" class="form-label">Telepon</label>
                                <input type="number" class="form-control @error('telepon') is-invalid @enderror" placeholder="Nomor Telepon" name="telepon" value="{{ old('telepon') }}" required>
                                @error('telepon')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="mb-3 form-group">
                                <label for="basic-url" class="form-label">Lapangan</label>
                                <select name="court_id" class="form-select" id="court_id" required>
                                    <option value="" disabled selected>Open this select menu</option>
                                    @foreach ($courts as $court)
                                        <option value="{{ $court->id }}" {{ old('court_id') == $court->id ? 'selected' : null }} >{{ $court->nama . " | " . $court->court_type->nama }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3 form-group">
                                <label for="basic-url" class="form-label">Tanggal</label>
                                <input type="date" class="form-control @error('tanggal') is-invalid @enderror" placeholder="Tanggal" name="tanggal" value="{{ old('tanggal') }}" required>
                                @error('tanggal')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="mb-3 form-group">
                                <label for="basic-url" class="form-label">Jam Mulai</label>
                                <input type="time" class="form-control @error('starttime') is-invalid @enderror" placeholder="Jam Mulai" name="starttime" value="{{ old('starttime') }}" required>
                                @error('starttime')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="mb-3 form-group">
                                <label for="basic-url" class="form-label">Durasi</label>
                                <div class="input-group">
                                    <input type="number" class="form-control @error('durasi') is-invalid @enderror" placeholder="Durasi" name="durasi" value="{{ old('durasi') }}" required min="1">
                                    <span class="input-group-text" id="basic-addon2">Jam</span>
                                </div>
                            </div>
                            <div class="input-group mb-3">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="45000" id="flexCheckDefault" name="kostum">
                                    <label class="form-check-label" for="flexCheckDefault">
                                        Kostum (45000/jam)
                                    </label>
                                </div>
                            </div>
                            <div class="input-group mb-3">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="50000" id="flexCheckDefault" name="sepatu">
                                    <label class="form-check-label" for="flexCheckDefault">
                                        Sepatu (50000/jam)
                                    </label>
                                </div>
                            </div>
                            <div class="form-group ms-4 mb-3">
                                <input type="reset" value="Reset" class="btn btn-danger">
                                <input type="submit" value="Simpan" class="btn btn-success">
                            </div>
                        </div>
                    </div>
                <form>
            </div>
        </div>
    </div>
@endsection
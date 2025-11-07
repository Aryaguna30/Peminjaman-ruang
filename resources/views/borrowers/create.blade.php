@extends('layouts.app')

@section('title', 'Tambah Peminjam')

@section('content')
    <div class="row mb-4">
        <div class="col-md-12">
            <h2 style="color: #0066cc; font-weight: 700;">
                <i class="fas fa-plus-circle"></i> Tambah Peminjam Baru
            </h2>
        </div>
    </div>

    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <div class="card-body">
                    <form action="/borrowers" method="POST">
                        @csrf

                        <div class="form-group mb-3">
                            <label class="form-label" for="room_id">Ruangan</label>
                            <select class="form-select @error('room_id') is-invalid @enderror" id="room_id" name="room_id" required>
                                <option value="">-- Pilih Ruangan --</option>
                                @foreach($rooms as $room)
                                    <option value="{{ $room->id }}" {{ old('room_id') == $room->id ? 'selected' : '' }}>
                                        {{ $room->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('room_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group mb-3">
                            <label class="form-label" for="name">Nama Peminjam</label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name') }}" required>
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group mb-3">
                            <label class="form-label" for="phone">Nomor Telepon</label>
                            <input type="text" class="form-control @error('phone') is-invalid @enderror" id="phone" name="phone" value="{{ old('phone') }}">
                            @error('phone')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group mb-3">
                            <label class="form-label" for="class_name">Kelas (Contoh: 10-PPLG 1, 11-RPL 2)</label>
                            <input type="text" class="form-control @error('class_name') is-invalid @enderror" id="class_name" name="class_name" value="{{ old('class_name') }}" placeholder="10-PPLG 1">
                            @error('class_name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group mb-3">
                            <label class="form-label" for="purpose">Keperluan</label>
                            <textarea class="form-control @error('purpose') is-invalid @enderror" id="purpose" name="purpose" rows="3" required>{{ old('purpose') }}</textarea>
                            @error('purpose')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label class="form-label" for="borrow_date">Tanggal Peminjaman</label>
                                    <input type="date" class="form-control @error('borrow_date') is-invalid @enderror" id="borrow_date" name="borrow_date" value="{{ old('borrow_date') }}" required>
                                    @error('borrow_date')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label class="form-label" for="borrow_time">Jam Peminjaman</label>
                                    <input type="time" class="form-control @error('borrow_time') is-invalid @enderror" id="borrow_time" name="borrow_time" value="{{ old('borrow_time') }}" required>
                                    @error('borrow_time')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label class="form-label" for="return_date">Tanggal Pengembalian</label>
                                    <input type="date" class="form-control @error('return_date') is-invalid @enderror" id="return_date" name="return_date" value="{{ old('return_date') }}" required min="">
                                    @error('return_date')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label class="form-label" for="return_time">Jam selesai</label>
                                    <input type="time" class="form-control @error('return_time') is-invalid @enderror" id="return_time" name="return_time" value="{{ old('return_time') }}" required>
                                    @error('return_time')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="d-flex gap-2">
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save"></i> Simpan
                            </button>
                            <a href="/borrowers" class="btn btn-secondary">
                                <i class="fas fa-arrow-left"></i> Kembali
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.getElementById('borrow_date').addEventListener('change', function() {
            document.getElementById('return_date').min = this.value;
        });
    </script>
@endsection

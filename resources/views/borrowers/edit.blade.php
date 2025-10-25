@extends('layouts.app')

@section('title', 'Edit Peminjam')

@section('content')
    <div class="row mb-4">
        <div class="col-md-12">
            <h2 style="color: #0066cc; font-weight: 700;">
                <i class="fas fa-edit"></i> Edit Data Peminjam
            </h2>
        </div>
    </div>

    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <div class="card-body">
                    <form action="/borrowers/{{ $borrower->id }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="form-group mb-3">
                            <label class="form-label" for="room_id">Ruangan</label>
                            <select class="form-select @error('room_id') is-invalid @enderror" id="room_id" name="room_id" disabled>
                                <option value="{{ $borrower->room_id }}">{{ $borrower->room->name }}</option>
                            </select>
                            <small class="text-muted">Ruangan tidak bisa diubah</small>
                        </div>

                        <div class="form-group mb-3">
                            <label class="form-label" for="name">Nama Peminjam</label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name', $borrower->name) }}" required>
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group mb-3">
                            <label class="form-label" for="email">Email</label>
                            <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email', $borrower->email) }}">
                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group mb-3">
                            <label class="form-label" for="phone">Nomor Telepon</label>
                            <input type="text" class="form-control @error('phone') is-invalid @enderror" id="phone" name="phone" value="{{ old('phone', $borrower->phone) }}">
                            @error('phone')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group mb-3">
                            <label class="form-label" for="purpose">Keperluan</label>
                            <textarea class="form-control @error('purpose') is-invalid @enderror" id="purpose" name="purpose" rows="3" required>{{ old('purpose', $borrower->purpose) }}</textarea>
                            @error('purpose')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label class="form-label" for="borrow_date">Tanggal Peminjaman</label>
                                    <input type="date" class="form-control @error('borrow_date') is-invalid @enderror" id="borrow_date" name="borrow_date" value="{{ old('borrow_date', $borrower->borrow_date) }}" required>
                                    @error('borrow_date')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label class="form-label" for="borrow_time">Jam Peminjaman</label>
                                    <input type="time" class="form-control @error('borrow_time') is-invalid @enderror" id="borrow_time" name="borrow_time" value="{{ old('borrow_time', $borrower->borrow_time) }}" required>
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
                                    <input type="date" class="form-control @error('return_date') is-invalid @enderror" id="return_date" name="return_date" value="{{ old('return_date', $borrower->return_date) }}" required>
                                    @error('return_date')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label class="form-label" for="return_time">Jam Pengembalian</label>
                                    <input type="time" class="form-control @error('return_time') is-invalid @enderror" id="return_time" name="return_time" value="{{ old('return_time', $borrower->return_time) }}" required>
                                    @error('return_time')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="form-group mb-3">
                            <label class="form-label" for="status">Status</label>
                            <select class="form-select @error('status') is-invalid @enderror" id="status" name="status" required>
                                <option value="pending" {{ old('status', $borrower->status) == 'pending' ? 'selected' : '' }}>Pending</option>
                                <option value="approved" {{ old('status', $borrower->status) == 'approved' ? 'selected' : '' }}>Disetujui</option>
                                <option value="rejected" {{ old('status', $borrower->status) == 'rejected' ? 'selected' : '' }}>Ditolak</option>
                                <option value="completed" {{ old('status', $borrower->status) == 'completed' ? 'selected' : '' }}>Selesai</option>
                            </select>
                            @error('status')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="d-flex gap-2">
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save"></i> Simpan Perubahan
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
@endsection
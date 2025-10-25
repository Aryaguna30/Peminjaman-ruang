@extends('layouts.app')

@section('title', 'Edit User')

@section('content')
    <div class="row mb-4">
        <div class="col-md-12">
            <h2 style="color: #0066cc; font-weight: 700;">
                <i class="fas fa-edit"></i> Edit User
            </h2>
        </div>
    </div>

    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <div class="card-body">
                    <form action="/users/{{ $user->id }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="form-group mb-3">
                            <label class="form-label" for="name">Nama Lengkap</label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name', $user->name) }}" required>
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group mb-3">
                            <label class="form-label" for="email">Email</label>
                            <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email', $user->email) }}" required>
                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group mb-3">
                            <label class="form-label" for="password">Password (Kosongkan jika tidak ingin mengubah)</label>
                            <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password">
                            @error('password')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group mb-3">
                            <label class="form-label" for="role">Role</label>
                            <select class="form-select @error('role') is-invalid @enderror" id="role" name="role" required onchange="toggleCategory()">
                                <option value="sarpras" {{ old('role', $user->role) == 'sarpras' ? 'selected' : '' }}>Sarpras</option>
                                <option value="toolman" {{ old('role', $user->role) == 'toolman' ? 'selected' : '' }}>Toolman</option>
                            </select>
                            @error('role')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group mb-3" id="categoryDiv" style="display: none;">
                            <label class="form-label" for="category_id">Kategori Jurusan</label>
                            <select class="form-select @error('category_id') is-invalid @enderror" id="category_id" name="category_id">
                                <option value="">-- Pilih Jurusan --</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}" {{ old('category_id', $user->category_id) == $category->id ? 'selected' : '' }}>
                                        {{ $category->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('category_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group mb-3">
                            <label class="form-label" for="phone">Nomor Telepon</label>
                            <input type="text" class="form-control @error('phone') is-invalid @enderror" id="phone" name="phone" value="{{ old('phone', $user->phone) }}">
                            @error('phone')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group mb-3">
                            <label class="form-label" for="is_active">Status</label>
                            <select class="form-select @error('is_active') is-invalid @enderror" id="is_active" name="is_active" required>
                                <option value="1" {{ old('is_active', $user->is_active) == 1 ? 'selected' : '' }}>Aktif</option>
                                <option value="0" {{ old('is_active', $user->is_active) == 0 ? 'selected' : '' }}>Nonaktif</option>
                            </select>
                            @error('is_active')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="d-flex gap-2">
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save"></i> Simpan Perubahan
                            </button>
                            <a href="/users" class="btn btn-secondary">
                                <i class="fas fa-arrow-left"></i> Kembali
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        function toggleCategory() {
            const role = document.getElementById('role').value;
            const categoryDiv = document.getElementById('categoryDiv');
            const categorySelect = document.getElementById('category_id');

            if (role === 'toolman') {
                categoryDiv.style.display = 'block';
                categorySelect.required = true;
            } else {
                categoryDiv.style.display = 'none';
                categorySelect.required = false;
            }
        }

        document.addEventListener('DOMContentLoaded', toggleCategory);
    </script>
@endsection
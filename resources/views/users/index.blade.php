@extends('layouts.app')

@section('title', 'Kelola User')

@section('content')
    <div class="row mb-4">
        <div class="col-md-8">
            <h2 style="color: #0066cc; font-weight: 700;">
                <i class="fas fa-users"></i> Kelola User
            </h2>
        </div>
        <div class="col-md-4 text-end">
            <a href="/users/create" class="btn btn-primary">
                <i class="fas fa-plus"></i> Tambah User
            </a>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>Email</th>
                            <th>Role</th>
                            <th>Kategori</th>
                            <th>Telepon</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($users as $user)
                            <tr>
                                <td>{{ ($users->currentPage() - 1) * $users->perPage() + $loop->iteration }}</td>
                                <td><strong>{{ $user->name }}</strong></td>
                                <td>{{ $user->email }}</td>
                                <td>
                                    @if($user->role == 'admin')
                                        <span class="badge bg-danger">Admin</span>
                                    @elseif($user->role == 'sarpras')
                                        <span class="badge bg-warning">Sarpras</span>
                                    @else
                                        <span class="badge bg-info">Toolman</span>
                                    @endif
                                </td>
                                <td>{{ $user->category->name ?? '-' }}</td>
                                <td>{{ $user->phone ?? '-' }}</td>
                                <td>
                                    @if($user->is_active)
                                        <span class="badge bg-success">Aktif</span>
                                    @else
                                        <span class="badge bg-secondary">Nonaktif</span>
                                    @endif
                                </td>
                                <td>
                                    <a href="/users/{{ $user->id }}/edit" class="btn btn-sm btn-warning">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="/users/{{ $user->id }}" method="POST" style="display: inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Yakin ingin menghapus?')">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="text-center text-muted">Tidak ada data user</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            <div class="d-flex justify-content-center mt-4">
                {{ $users->links('pagination::bootstrap-5') }}
            </div>
        </div>
    </div>
@endsection
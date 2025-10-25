@extends('layouts.app')

@section('title', 'Kelola Jadwal')

@section('content')
    <div class="row mb-4">
        <div class="col-md-8">
            <h2 style="color: #0066cc; font-weight: 700;">
                <i class="fas fa-calendar-alt"></i> Kelola Jadwal Pembelajaran
            </h2>
        </div>
        <div class="col-md-4 text-end">
            <a href="/schedules/create" class="btn btn-primary">
                <i class="fas fa-plus"></i> Tambah Jadwal
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
                            <th>Ruangan</th>
                            <th>Hari</th>
                            <th>Jam</th>
                            <th>Blok</th>
                            <th>Kelas</th>
                            <th>Guru</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($schedules as $schedule)
                            <tr>
                                <td>{{ ($schedules->currentPage() - 1) * $schedules->perPage() + $loop->iteration }}</td>
                                <td><strong>{{ $schedule->room->name }}</strong></td>
                                <td>{{ $schedule->day }}</td>
                                <td>{{ $schedule->start_time }} - {{ $schedule->end_time }}</td>
                                <td><span class="badge bg-info">Blok {{ $schedule->block }}</span></td>
                                <td>{{ $schedule->class_name ?? '-' }}</td>
                                <td>{{ $schedule->teacher_name ?? '-' }}</td>
                                <td>
                                    <a href="/schedules/{{ $schedule->id }}/edit" class="btn btn-sm btn-warning">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="/schedules/{{ $schedule->id }}" method="POST" style="display: inline;">
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
                                <td colspan="8" class="text-center text-muted">Tidak ada data jadwal</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            <div class="d-flex justify-content-center mt-4">
                {{ $schedules->links('pagination::bootstrap-5') }}
            </div>
        </div>
    </div>
@endsection
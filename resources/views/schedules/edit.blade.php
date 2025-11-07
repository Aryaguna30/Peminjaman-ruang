@extends('layouts.app')

@section('title', 'Edit Jadwal')

@section('content')
    <div class="row mb-4">
        <div class="col-md-12">
            <h2 style="color: #0066cc; font-weight: 700;">
                <i class="fas fa-edit"></i> Edit Jadwal Pembelajaran
            </h2>
        </div>
    </div>

    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <div class="card-body">
                    <form action="/schedules/{{ $schedule->id }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="form-group mb-3">
                            <label class="form-label" for="room_id">Ruangan</label>
                            <select class="form-select @error('room_id') is-invalid @enderror" id="room_id" name="room_id" required>
                                <option value="">-- Pilih Ruangan --</option>
                                @foreach($rooms as $room)
                                    <option value="{{ $room->id }}" {{ old('room_id', $schedule->room_id) == $room->id ? 'selected' : '' }}>
                                        {{ $room->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('room_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group mb-3">
                            <label class="form-label" for="day">Hari</label>
                            <select class="form-select @error('day') is-invalid @enderror" id="day" name="day" required>
                                @foreach($days as $day)
                                    <option value="{{ $day }}" {{ old('day', $schedule->day) == $day ? 'selected' : '' }}>{{ $day }}</option>
                                @endforeach
                            </select>
                            @error('day')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label class="form-label" for="start_time">Jam Mulai</label>
                                    <input type="time" class="form-control @error('start_time') is-invalid @enderror" id="start_time" name="start_time" value="{{ old('start_time', $schedule->start_time) }}" required>
                                    @error('start_time')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label class="form-label" for="end_time">Jam Selesai</label>
                                    <input type="time" class="form-control @error('end_time') is-invalid @enderror" id="end_time" name="end_time" value="{{ old('end_time', $schedule->end_time) }}" required>
                                    @error('end_time')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label class="form-label" for="block">Blok</label>
                                    <select class="form-select @error('block') is-invalid @enderror" id="block" name="block" required>
                                        <option value="1" {{ old('block', $schedule->block) == '1' ? 'selected' : '' }}>Blok 1 (3 Bulan Pertama)</option>
                                        <option value="2" {{ old('block', $schedule->block) == '2' ? 'selected' : '' }}>Blok 2 (3 Bulan Kedua)</option>
                                    </select>
                                    @error('block')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label class="form-label" for="semester">Semester</label>
                                    <select class="form-select @error('semester') is-invalid @enderror" id="semester" name="semester" required>
                                        <option value="1" {{ old('semester', $schedule->semester) == '1' ? 'selected' : '' }}>Semester 1</option>
                                        <option value="2" {{ old('semester', $schedule->semester) == '2' ? 'selected' : '' }}>Semester 2</option>
                                    </select>
                                    @error('semester')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="form-group mb-3">
                            <label class="form-label" for="class_name">Nama Kelas</label>
                            <input type="text" class="form-control @error('class_name') is-invalid @enderror" id="class_name" name="class_name" value="{{ old('class_name', $schedule->class_name) }}" placeholder="Contoh: X RPL 1">
                            @error('class_name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group mb-3">
                            <label class="form-label" for="teacher_name">Nama Guru</label>
                            <input type="text" class="form-control @error('teacher_name') is-invalid @enderror" id="teacher_name" name="teacher_name" value="{{ old('teacher_name', $schedule->teacher_name) }}">
                            @error('teacher_name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="d-flex gap-2">
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save"></i> Simpan Perubahan
                            </button>
                            <a href="/schedules" class="btn btn-secondary">
                                <i class="fas fa-arrow-left"></i> Kembali
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

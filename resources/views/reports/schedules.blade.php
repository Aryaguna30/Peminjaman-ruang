<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Laporan Jadwal Pembelajaran</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            color: #333;
        }

        .header {
            text-align: center;
            margin-bottom: 30px;
            border-bottom: 3px solid #0066cc;
            padding-bottom: 15px;
        }

        .header h1 {
            margin: 0;
            color: #0066cc;
            font-size: 24px;
        }

        .header p {
            margin: 5px 0;
            font-size: 12px;
            color: #666;
        }

        .info {
            margin-bottom: 20px;
            font-size: 12px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        table thead {
            background-color: #0066cc;
            color: white;
        }

        table th {
            padding: 10px;
            text-align: left;
            font-weight: bold;
            border: 1px solid #ddd;
            font-size: 11px;
        }

        table td {
            padding: 8px;
            border: 1px solid #ddd;
            font-size: 11px;
        }

        table tbody tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        .footer {
            margin-top: 30px;
            text-align: right;
            font-size: 12px;
        }

        .badge {
            background-color: #e6f2ff;
            color: #0066cc;
            padding: 3px 8px;
            border-radius: 3px;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>LAPORAN JADWAL PEMBELAJARAN</h1>
        <p>SMKN 1 Katapang - Ruang Nekat</p>
        <p>Tanggal Cetak: {{ now()->format('d/m/Y H:i') }}</p>
    </div>

    <div class="info">
        <p><strong>Total Jadwal:</strong> {{ count($schedules) }} jadwal</p>
    </div>

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Ruangan</th>
                <th>Kategori</th>
                <th>Hari</th>
                <th>Jam</th>
                <th>Blok</th>
                <th>Kelas</th>
                <th>Guru</th>
            </tr>
        </thead>
        <tbody>
            @forelse($schedules as $schedule)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $schedule->room->name }}</td>
                    <td>{{ $schedule->room->category->name }}</td>
                    <td>{{ $schedule->day }}</td>
                    <td>{{ $schedule->start_time }} - {{ $schedule->end_time }}</td>
                    <td><span class="badge">Blok {{ $schedule->block }}</span></td>
                    <td>{{ $schedule->class_name ?? '-' }}</td>
                    <td>{{ $schedule->teacher_name ?? '-' }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="8" style="text-align: center;">Tidak ada data jadwal</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <div class="footer">
        <p>Dicetak oleh: {{ Auth::user()->name }}</p>
        <p>Tanggal: {{ now()->format('d/m/Y') }}</p>
    </div>
</body>
</html>
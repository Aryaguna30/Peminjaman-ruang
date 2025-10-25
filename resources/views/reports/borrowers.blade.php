<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Laporan Data Peminjam Ruangan</title>
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

        .status-pending {
            background-color: #fff3cd;
            color: #856404;
            padding: 3px 8px;
            border-radius: 3px;
        }

        .status-approved {
            background-color: #d4edda;
            color: #155724;
            padding: 3px 8px;
            border-radius: 3px;
        }

        .status-rejected {
            background-color: #f8d7da;
            color: #721c24;
            padding: 3px 8px;
            border-radius: 3px;
        }

        .status-completed {
            background-color: #d1ecf1;
            color: #0c5460;
            padding: 3px 8px;
            border-radius: 3px;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>LAPORAN DATA PEMINJAM RUANGAN</h1>
        <p>SMKN 1 Katapang - Ruang Nekat</p>
        <p>Tanggal Cetak: {{ now()->format('d/m/Y H:i') }}</p>
    </div>

    <div class="info">
        <p><strong>Total Data:</strong> {{ count($borrowers) }} peminjam</p>
    </div>

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Peminjam</th>
                <th>Email</th>
                <th>Telepon</th>
                <th>Ruangan</th>
                <th>Keperluan</th>
                <th>Tanggal Peminjaman</th>
                <th>Jam</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @forelse($borrowers as $borrower)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $borrower->name }}</td>
                    <td>{{ $borrower->email ?? '-' }}</td>
                    <td>{{ $borrower->phone ?? '-' }}</td>
                    <td>{{ $borrower->room->name }}</td>
                    <td>{{ Str::limit($borrower->purpose, 30) }}</td>
                    <td>{{ $borrower->borrow_date->format('d/m/Y') }}</td>
                    <td>{{ $borrower->borrow_time }} - {{ $borrower->return_time }}</td>
                    <td>
                        @if($borrower->status == 'pending')
                            <span class="status-pending">Pending</span>
                        @elseif($borrower->status == 'approved')
                            <span class="status-approved">Disetujui</span>
                        @elseif($borrower->status == 'rejected')
                            <span class="status-rejected">Ditolak</span>
                        @else
                            <span class="status-completed">Selesai</span>
                        @endif
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="9" style="text-align: center;">Tidak ada data peminjam</td>
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
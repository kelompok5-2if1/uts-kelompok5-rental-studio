<!DOCTYPE html>
<html>
<head>
    <title>Laporan Rental</title>
    <style>
        body{font-family: sans-serif; font-size: 11px;}
        table{width:100%; border-collapse: collapse; margin-top: 12px;}
        table,th,td{border:1px solid #333;}
        th,td{padding:6px; text-align:left; vertical-align: top;}
        h2{margin-bottom: 6px;}
    </style>
</head>
<body>
    <h2>Laporan Rental Studio Musik</h2>
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Pelanggan</th>
                <th>Jenis Transaksi</th>
                <th>Tanggal</th>
                <th>Metode Pembayaran</th>
                <th>Total</th>
                <th>Nominal Dibayar</th>
                <th>Kembalian</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach($laporan as $item)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $item['pelanggan'] ?? '-' }}</td>
                    <td>{{ $item['jenis_transaksi'] ?? '-' }}</td>
                    <td>{{ $item['tanggal'] ?? '-' }}</td>
                    <td>{{ $item['metode_pembayaran'] ?? '-' }}</td>
                    <td>Rp {{ number_format($item['total'] ?? 0, 0, ',', '.') }}</td>
                    <td>{{ $item['nominal_dibayar'] !== null ? 'Rp ' . number_format($item['nominal_dibayar'], 0, ',', '.') : '-' }}</td>
                    <td>{{ $item['kembalian'] !== null ? 'Rp ' . number_format($item['kembalian'], 0, ',', '.') : '-' }}</td>
                    <td>{{ $item['status'] ?? '-' }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
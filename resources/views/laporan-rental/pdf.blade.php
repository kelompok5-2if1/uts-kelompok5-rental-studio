<!DOCTYPE html>
<html>
<head>
    <title>Laporan Rental</title>

    <style>
        body{
            font-family: sans-serif;
        }

        table{
            width:100%;
            border-collapse: collapse;
        }

        table,th,td{
            border:1px solid black;
        }

        th,td{
            padding:8px;
            text-align:left;
        }
    </style>
</head>

<body>

<h2>Laporan Rental Studio Musik</h2>

<table>

    <thead>
        <tr>
            <th>No</th>
            <th>Pelanggan</th>
            <th>Total</th>
            <th>Tanggal</th>
        </tr>
    </thead>

    <tbody>

    @foreach($laporan as $item)

        <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $item->pelanggan->nama ?? '-' }}</td>
            <td>
                Rp {{ number_format($item->total,0,',','.') }}
            </td>
            <td>
                {{ $item->created_at }}
            </td>
        </tr>

    @endforeach

    </tbody>

</table>

</body>
</html>
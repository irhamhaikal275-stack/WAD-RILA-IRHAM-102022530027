<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Data Pemesanan - Rental Alat Olahraga</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>

    <nav>
        <a href="{{ url('/pemesanan-user') }}">Input Data</a>
        <a href="{{ url('/pemesanan-user/data') }}" class="active">Data Pemesanan</a>
    </nav>

    <div class="box" style="max-width: 800px;">
        <h2>Daftar Pemesanan</h2>
        <table class="tabel1" style="width: 100%;">
            <thead>
                <tr>
                    <th>Nama</th>
                    <th>Tanggal</th>
                    <th>Jam</th>
                    <th>Total Bayar</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($pemesanans as $p)
                <tr>
                    <td>{{ $p->nama }}</td>
                    <td>{{ \Carbon\Carbon::parse($p->tanggal)->format('d/m/Y') }}</td>
                    <td>{{ $p->jam }}</td>
                    <td>Rp {{ number_format($p->total_bayar, 0, ',', '.') }}</td>
                    <td>
                        <a href="{{ url('/pemesanan-user/' . $p->id . '/edit') }}" class="btn-sm btn-edit">Edit</a>
                        
                        <form action="{{ url('/pemesanan-user/' . $p->id) }}" method="POST" style="display:inline;" onsubmit="return confirm('Yakin ingin menghapus data ini?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn-sm btn-hapus" style="border:none; cursor:pointer;">Hapus</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

</body>
</html>
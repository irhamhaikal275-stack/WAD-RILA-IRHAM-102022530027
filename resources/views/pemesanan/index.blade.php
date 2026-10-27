<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Input Pemesanan - Rental Alat Olahraga</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>

    <nav>
        <a href="{{ url('/pemesanan-user') }}" class="active">Input Data</a>
        <a href="{{ url('/pemesanan-user/data') }}">Data Pemesanan</a>
    </nav>

    <div class="box" style="max-width: 600px; margin-bottom: 30px;">
        <h1>Sewa Alat Olahraga</h1>
        <h2>{{ isset($editData) ? 'Edit Data Pemesanan' : 'Form Pemesanan Baru' }}</h2>

        <form method="POST" action="{{ isset($editData) ? url('/pemesanan-user/' . $editData->id) : url('/pemesanan-user') }}">
            @csrf
            @if(isset($editData))
                @method('PUT')
            @endif

            <label>Nama:</label><br>
            <input type="text" name="nama" value="{{ $editData->nama ?? '' }}" required><br><br>

            <label>Tanggal:</label><br>
            <input type="date" name="tanggal" value="{{ isset($editData) ? \Carbon\Carbon::parse($editData->tanggal)->format('Y-m-d') : '' }}" required><br><br>

            <label>Jam:</label><br>
            <input type="time" name="jam" value="{{ $editData->jam ?? '' }}" required><br><br>

            <h3>Pilih Jumlah Alat</h3>
            <table class="tabel1" style="width: 100%; margin-bottom: 20px;">
                <thead>
                    <tr>
                        <th>Alat</th>
                        <th>Harga</th>
                        <th>Jumlah</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Raket Badminton</td>
                        <td>25.000</td>
                        <td><input type="number" name="raket" min="0" value="{{ $editData->raket ?? 0 }}"></td>
                    </tr>
                    <tr>
                        <td>Sepatu Futsal</td>
                        <td>25.000</td>
                        <td><input type="number" name="sepatu" min="0" value="{{ $editData->sepatu ?? 0 }}"></td>
                    </tr>
                    <tr>
                        <td>Bola Futsal</td>
                        <td>25.000</td>
                        <td><input type="number" name="bola" min="0" value="{{ $editData->bola ?? 0 }}"></td>
                    </tr>
                </tbody>
            </table>

            @if(isset($editData))
                <button type="submit" class="btn" style="background: #f39c12;">Update Data</button>
                <a href="{{ url('/pemesanan-user/data') }}" class="btn" style="background: #6c757d;">Batal</a>
            @else
                <button type="submit" class="btn">Simpan Data</button>
            @endif
        </form>
    </div>

</body>
</html>
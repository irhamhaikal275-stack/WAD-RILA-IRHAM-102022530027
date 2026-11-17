<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Dashboard Admin - Rental Alat Olahraga</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>

    <nav>
        <a href="{{ url('/dashboard') }}" class="active">Dashboard</a>
        <a href="{{ url('/pemesanan-user') }}">Input Data</a>
        <a href="{{ url('/pemesanan-user/data') }}">Data Pemesanan</a>
        <a href="{{ url('/admin') }}">Panel Admin</a>
        <span class="nav-user">{{ auth()->user()->name }} (admin)</span>
        <form action="{{ url('/logout') }}" method="POST" class="nav-logout">
            @csrf
            <button type="submit">Logout</button>
        </form>
    </nav>

    <div class="box" style="max-width: 800px;">
        <h2>Dashboard Admin</h2>
        <p>Selamat datang, <strong>{{ auth()->user()->name }}</strong>.</p>

        <div class="stat-grid">
            <div class="stat-card">
                <div class="stat-label">Total Pemesanan</div>
                <div class="stat-value">{{ $totalPemesanan }}</div>
            </div>
            <div class="stat-card">
                <div class="stat-label">Total Pendapatan</div>
                <div class="stat-value">Rp {{ number_format($totalPendapatan, 0, ',', '.') }}</div>
            </div>
            <div class="stat-card">
                <div class="stat-label">User Terdaftar</div>
                <div class="stat-value">{{ $totalUser }}</div>
            </div>
        </div>

        <div class="stat-grid">
            <div class="stat-card stat-kecil">
                <div class="stat-label">Raket Disewa</div>
                <div class="stat-value">{{ $totalRaket }}</div>
            </div>
            <div class="stat-card stat-kecil">
                <div class="stat-label">Sepatu Disewa</div>
                <div class="stat-value">{{ $totalSepatu }}</div>
            </div>
            <div class="stat-card stat-kecil">
                <div class="stat-label">Bola Disewa</div>
                <div class="stat-value">{{ $totalBola }}</div>
            </div>
        </div>

        <h3>5 Pemesanan Terbaru</h3>
        <table class="tabel1" style="width: 100%;">
            <thead>
                <tr>
                    <th>Nama</th>
                    <th>Tanggal</th>
                    <th>Jam</th>
                    <th>Total Bayar</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($terbaru as $p)
                    <tr>
                        <td>{{ $p->nama }}</td>
                        <td>{{ \Carbon\Carbon::parse($p->tanggal)->format('d/m/Y') }}</td>
                        <td>{{ $p->jam }}</td>
                        <td>Rp {{ number_format($p->total_bayar, 0, ',', '.') }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4">Belum ada pemesanan.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        <p style="margin-top: 20px;">
            <a href="{{ url('/pemesanan-user/data') }}" class="btn">Kelola Data</a>
            <a href="{{ url('/admin') }}" class="btn">Buka Panel Admin</a>
        </p>
    </div>

</body>
</html>
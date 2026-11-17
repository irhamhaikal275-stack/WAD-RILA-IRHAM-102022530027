<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Daftar - Rental Alat Olahraga</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>

    <div class="box" style="max-width: 400px; margin-top: 60px;">
        <h1>Daftar Akun</h1>

        @if ($errors->any())
            <div class="alert-error">
                @foreach ($errors->all() as $error)
                    <div>{{ $error }}</div>
                @endforeach
            </div>
        @endif

        <form method="POST" action="{{ url('/register') }}">
            @csrf

            <label>Nama:</label><br>
            <input type="text" name="name" value="{{ old('name') }}" required autofocus><br><br>

            <label>Email:</label><br>
            <input type="email" name="email" value="{{ old('email') }}" required><br><br>

            <label>Password (min. 8 karakter):</label><br>
            <input type="password" name="password" required><br><br>

            <label>Konfirmasi Password:</label><br>
            <input type="password" name="password_confirmation" required><br><br>

            <button type="submit" class="btn">Daftar</button>
        </form>

        <p>Sudah punya akun? <a href="{{ url('/login') }}">Login</a></p>
    </div>

</body>
</html>

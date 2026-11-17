<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login - Rental Alat Olahraga</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>

    <div class="box" style="max-width: 400px; margin-top: 60px;">
        <h1>Login</h1>

        @if ($errors->any())
            <p class="alert-error">{{ $errors->first() }}</p>
        @endif

        <form method="POST" action="{{ url('/login') }}">
            @csrf

            <label>Email:</label><br>
            <input type="email" name="email" value="{{ old('email') }}" required autofocus><br><br>

            <label>Password:</label><br>
            <input type="password" name="password" required><br><br>

            <label><input type="checkbox" name="remember" value="1"> Ingat saya</label><br><br>

            <button type="submit" class="btn">Masuk</button>
        </form>

        <p>Belum punya akun? <a href="{{ url('/register') }}">Daftar</a></p>
    </div>

</body>
</html>

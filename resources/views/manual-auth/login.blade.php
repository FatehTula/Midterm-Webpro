<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Form Login</title>

    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>

<body>

    <div class="login-container">

        <h1>Form Login</h1>

        {{-- Pesan registrasi berhasil --}}
        @if (session('success'))
            <div class="success-message">
                {{ session('success') }}
            </div>
        @endif

        {{-- Pesan kesalahan login --}}
        @if ($errors->has('email'))
            <div class="error-message">
                {{ $errors->first('email') }}
            </div>
        @endif

        <form action="{{ route('loginProses') }}" method="POST">
            @csrf

            {{-- Email --}}
            <div class="form-group">
                <label for="email">Email</label>

                <input
                    type="email"
                    id="email"
                    name="email"
                    placeholder="Masukkan email..."
                    value="{{ old('email') }}"
                    required
                >
            </div>

            {{-- Password --}}
            <div class="form-group">
                <label for="password">Password</label>

                <input
                    type="password"
                    id="password"
                    name="password"
                    placeholder="Masukkan password..."
                    required
                >
            </div>

            <button type="submit" class="tombol">
                Login
            </button>

        </form>

        <p class="register-link">
            Belum memiliki akun?
            <a href="{{ route('register') }}">Registrasi di sini</a>
        </p>

    </div>

</body>

</html>
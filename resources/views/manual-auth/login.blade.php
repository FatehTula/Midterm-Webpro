
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- [DIUBAH] Judul tab browser -->
    <title>Pustaka | Login</title>

    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>

<!-- [DIUBAH 1] Aktifkan styling khusus halaman autentikasi -->
<body class="auth-page">

    <!-- [DIUBAH 2] Tambahkan auth-card, pertahankan login-container -->
    <div class="login-container auth-card">

        <h1>Form Login</h1>

        {{-- Pesan registrasi berhasil --}}
        @if (session('success'))
            <!-- [DIUBAH 3] Tambahkan class success untuk styling -->
            <div class="success-message success">
                {{ session('success') }}
            </div>
        @endif

        {{-- Pesan kesalahan login --}}
        @if ($errors->has('email'))
            <div class="error-message error">
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

            {{-- Tombol login tetap menggunakan route yang lama --}}
            <button type="submit" class="tombol">
                Login
            </button>

        </form>

        <!-- [DIUBAH 4] Tambahkan auth-links -->
        <p class="register-link auth-links">
            Belum memiliki akun?
            <a href="{{ route('register') }}">Registrasi di sini</a>
        </p>

    </div>

</body>

</html>


<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- [DIUBAH] Judul tab browser -->
    <title>Pustaka | Registrasi</title>

    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>

<!-- [DIUBAH] Mengaktifkan layout khusus autentikasi -->
<body class="auth-page">

    <!-- [DIUBAH] Menambahkan class auth-card -->
    <div class="login-container auth-card">

        <h1>Form Registrasi</h1>

        <!-- Form registrasi tetap menggunakan route lama -->
        <form action="{{ route('registerProses') }}" method="POST">
            @csrf

            {{-- Nama --}}
            <div class="form-group">
                <label for="name">Nama</label>

                <input
                    type="text"
                    id="name"
                    name="name"
                    placeholder="Masukkan nama..."
                    value="{{ old('name') }}"
                    autocomplete="name"
                    required
                >

                @error('name')
                    <small class="error-message">{{ $message }}</small>
                @enderror
            </div>

            {{-- Email --}}
            <div class="form-group">
                <label for="email">Email</label>

                <input
                    type="email"
                    id="email"
                    name="email"
                    placeholder="Masukkan email..."
                    value="{{ old('email') }}"
                    autocomplete="email"
                    required
                >

                @error('email')
                    <small class="error-message">{{ $message }}</small>
                @enderror
            </div>

            {{-- Password --}}
            <div class="form-group">
                <label for="password">Password</label>

                <input
                    type="password"
                    id="password"
                    name="password"
                    placeholder="Minimal 8 karakter..."
                    autocomplete="new-password"
                    minlength="8"
                    required
                >

                @error('password')
                    <small class="error-message">{{ $message }}</small>
                @enderror
            </div>

            {{-- Konfirmasi password --}}
            <div class="form-group">
                <label for="password_confirmation">
                    Konfirmasi Password
                </label>

                <input
                    type="password"
                    id="password_confirmation"
                    name="password_confirmation"
                    placeholder="Ulangi password..."
                    autocomplete="new-password"
                    minlength="8"
                    required
                >
            </div>

            {{-- Tombol registrasi --}}
            <button type="submit" class="tombol">
                Registrasi
            </button>

        </form>

        <!-- [DIUBAH] Menyesuaikan styling tautan -->
        <p class="register-link auth-links">
            Sudah memiliki akun?
            <a href="{{ route('login') }}">Login di sini</a>
        </p>

    </div>

</body>

</html>

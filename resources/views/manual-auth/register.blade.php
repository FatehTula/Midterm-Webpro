<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Form Registrasi</title>

    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>

<body>

    <div class="login-container">

        <h1>Form Registrasi</h1>

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
                    required
                >
            </div>

            <button type="submit" class="tombol">
                Registrasi
            </button>

        </form>

        <p class="register-link">
            Sudah memiliki akun?
            <a href="{{ route('login') }}">Login di sini</a>
        </p>

    </div>

</body>

</html>
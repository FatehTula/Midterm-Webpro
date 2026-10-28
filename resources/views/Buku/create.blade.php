@include('layout.header')

<h3>Tambah Buku</h3>

<form action="{{ route('buku.store') }}" method="POST">
    @csrf

    <div class="form-group">
        <label for="judul">Judul Buku:</label>
        <input
            type="text"
            name="judul"
            id="judul"
            placeholder="Masukkan judul buku"
            value="{{ old('judul') }}"
            maxlength="255"
            required
        >
        @error('judul')
            <p class="error">{{ $message }}</p>
        @enderror
    </div>

    <br>

    <div class="form-group">
        <label for="pengarang">Pengarang:</label>
        <input
            type="text"
            name="pengarang"
            id="pengarang"
            placeholder="Masukkan nama pengarang"
            value="{{ old('pengarang') }}"
            maxlength="255"
            required
        >
        @error('pengarang')
            <p class="error">{{ $message }}</p>
        @enderror
    </div>

    <br>

    <div class="form-group">
        <label for="tahun_terbit">Tahun Terbit:</label>
        <input
            type="number"
            name="tahun_terbit"
            id="tahun_terbit"
            placeholder="Contoh: 2024"
            value="{{ old('tahun_terbit') }}"
            min="1000"
            max="9999"
            required
        >
        @error('tahun_terbit')
            <p class="error">{{ $message }}</p>
        @enderror
    </div>

    <br>

    <div class="form-group">
        <label for="kategori_id">Kategori:</label>

        <select name="kategori_id" id="kategori_id" required>
            <option value="">-- Pilih Kategori --</option>

            @foreach ($kategori as $k)
                <option
                    value="{{ $k->id }}"
                    {{ old('kategori_id') == $k->id ? 'selected' : '' }}
                >
                    {{ $k->nama_kategori }}
                </option>
            @endforeach
        </select>

        @error('kategori_id')
            <p class="error">{{ $message }}</p>
        @enderror
    </div>

    <br>

    <div class="form-group">
        <label for="penerbit_id">Penerbit:</label>

        <select name="penerbit_id" id="penerbit_id" required>
            <option value="">-- Pilih Penerbit --</option>

            @foreach ($penerbit as $p)
                <option
                    value="{{ $p->id }}"
                    {{ old('penerbit_id') == $p->id ? 'selected' : '' }}
                >
                    {{ $p->nama_penerbit }}
                </option>
            @endforeach
        </select>

        @error('penerbit_id')
            <p class="error">{{ $message }}</p>
        @enderror
    </div>

    <br>

    <button type="submit" class="tombol">
        Simpan
    </button>

    <a href="{{ route('buku.index') }}" class="tombol">
        Kembali
    </a>
</form>

@include('layout.footer')
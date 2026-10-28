@include('layout.header')

<h3>Tambah Kategori</h3>

<form action="{{ route('kategori.store') }}" method="POST">

    @csrf

    <div class="form-group">
        <label for="nama_kategori">Nama Kategori:</label>

        <input
            type="text"
            name="nama_kategori"
            id="nama_kategori"
            placeholder="Masukkan nama kategori"
            value="{{ old('nama_kategori') }}"
            required
        >
    </div>

    <br>

    <button type="submit" class="tombol">
        Submit
    </button>

    <a href="{{ route('kategori.index') }}" class="tombol">
        Kembali
    </a>

</form>

@include('layout.footer')

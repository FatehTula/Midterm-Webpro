@include('layout.header')

<h3>Tambah Penerbit</h3>

<form action="{{ route('penerbit.store') }}" method="POST">

    @csrf

    <div class="form-group">
        <label for="nama_penerbit">Nama Penerbit:</label>

        <input
            type="text"
            name="nama_penerbit"
            id="nama_penerbit"
            placeholder="Masukkan nama penerbit"
            value="{{ old('nama_penerbit') }}"
            required
        >
    </div>

    <br>

    <button type="submit" class="tombol">
        Submit
    </button>

    <a href="{{ route('penerbit.index') }}" class="tombol">
        Kembali
    </a>

</form>

@include('layout.footer')

@include('layout.header')

<h3>Edit Penerbit</h3>

<form action="{{ route('penerbit.update', $penerbit -> id) }}" method="POST">

    @csrf
    @method('PUT')
    <div class="form-group">
        <label for="nama_penerbit">Nama Penerbit:</label>

        <input
            type="text"
            name="nama_penerbit"
            id="nama_penerbit"
            placeholder="Masukkan nama penerbit"
            value="{{ $penerbit -> nama_penerbit }}"
            required
        >
    </div>

    <br>

    <button type="submit" class="tombol">
        Update
    </button>

    <a href="{{ route('penerbit.index') }}" class="tombol">
        Kembali
    </a>

</form>

@include('layout.footer')

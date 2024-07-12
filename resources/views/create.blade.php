@extends('layouts.admin')

@section('content')
    <div class="container">
        <h1>Tambah Buku Baru</h1>
        <form action="{{ route('admin.books.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="title">Judul Buku:</label>
                <input type="text" class="form-control" id="title" name="title" required>
            </div>
            <div class="form-group">
                <label for="author">Penulis:</label>
                <input type="text" class="form-control" id="author" name="author" required>
            </div>
            <div class="form-group">
                <label for="cover_image">Cover Buku:</label>
                <input type="file" class="form-control-file" id="cover_image" name="cover_image" required>
            </div>
            <div class="form-group">
                <label for="pdf_file">File PDF:</label>
                <input type="file" class="form-control-file" id="pdf_file" name="pdf_file" required>
            </div>
            <button type="submit" class="btn btn-primary">Simpan</button>
        </form>
    </div>
@endsection

@extends('layouts.admin')

@section('content')
    <div class="container">
        <h1>Edit Buku</h1>
        <form action="{{ route('admin.books.update', $book->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="title">Judul Buku:</label>
                <input type="text" class="form-control" id="title" name="title" value="{{ $book->title }}" required>
            </div>
            <div class="form-group">
                <label for="author">Penulis:</label>
                <input type="text" class="form-control" id="author" name="author" value="{{ $book->author }}" required>
            </div>
            <div class="form-group">
                <label for="cover_image">Cover Buku:</label>
                <input type="file" class="form-control-file" id="cover_image" name="cover_image">
                <img src="{{ asset('storage/' . $book->cover_image) }}" alt="{{ $book->title }}" width="100">
            </div>
            <div class="form-group">
                <label for="pdf_file">File PDF:</label>
                <input type="file" class="form-control-file" id="pdf_file" name="pdf_file">
                <a href="{{ asset('storage/' . $book->pdf_file) }}" target="_blank">Unduh PDF</a>
            </div>
            <button type="submit" class="btn btn-primary">Perbarui</button>
        </form>
    </div>
@endsection

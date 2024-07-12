@extends('layouts.app')

@section('content')
<div class="book-grid">
    @foreach ($books as $book)
        <div class="book-item">
            <img src="{{ asset('storage/covers/' . $book->cover_image) }}" alt="{{ $book->title }}">
            <h3>{{ $book->title }}</h3>
            <a href="{{ asset('storage/pdfs/' . $book->pdf_file) }}" class="download-btn">Unduh E-Book</a>
        </div>
    @endforeach
</div>
@endsection

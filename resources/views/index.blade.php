@extends('layouts.admin')

@section('content')
    <div class="container">
        <h1>Daftar Buku</h1>
        <a href="{{ route('admin.books.create') }}" class="btn btn-primary">Tambah Buku</a>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Judul</th>
                    <th>Penulis</th>
                    <th>Cover</th>
                    <th>File PDF</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($books as $book)
                    <tr>
                        <td>{{ $book->title }}</td>
                        <td>{{ $book->author }}</td>
                        <td><img src="{{ asset('storage/' . $book->cover_image) }}" alt="{{ $book->title }}" width="50"></td>
                        <td><a href="{{ asset('storage/' . $book->pdf_file) }}" target="_blank">Unduh PDF</a></td>
                        <td>
                            <a href="{{ route('admin.books.edit', $book->id) }}" class="btn btn-warning">Edit</a>
                            <button class="btn btn-danger" data-toggle="modal" data-target="#deleteModal{{ $book->id }}">Hapus</button>
                            
                            <!-- Modal Konfirmasi -->
                            <div class="modal fade" id="deleteModal{{ $book->id }}" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="deleteModalLabel">Konfirmasi Hapus</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            Apakah Anda yakin ingin menghapus buku ini?
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                                            <form action="{{ route('admin.books.destroy', $book->id) }}" method="POST" style="display:inline-block;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger">Hapus</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Akhir Modal Konfirmasi -->
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection

@section('scripts')
    <!-- Tambahkan script Bootstrap jika belum ada -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJTYVPIl5TbrVQzKhD3N6UuaxUwXsnFfw7K77p3XWz7AytF+0" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
@endsection

<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Book;
use Illuminate\Support\Facades\Storage;

class BookController extends Controller
{
    // Menampilkan daftar buku
    public function index()
    {
        $books = Book::all();
        return view('admin.books.index', compact('books'));
    }

    // Menampilkan form untuk menambah buku baru
    public function create()
    {
        return view('admin.books.create');
    }

    // Menyimpan buku baru ke database
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'author' => 'required|string|max:255',
            'cover_image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'pdf_file' => 'required|mimes:pdf|max:10000',
        ]);

        $coverImagePath = $request->file('cover_image')->store('covers', 'public');
        $pdfFilePath = $request->file('pdf_file')->store('pdfs', 'public');

        Book::create([
            'title' => $request->title,
            'author' => $request->author,
            'cover_image' => $coverImagePath,
            'pdf_file' => $pdfFilePath,
        ]);

        return redirect()->route('admin.books.index')->with('success', 'Buku berhasil ditambahkan');
    }

    // Menampilkan form untuk mengedit buku
    public function edit(Book $book)
    {
        return view('admin.books.edit', compact('book'));
    }

    // Mengupdate buku yang sudah ada
    public function update(Request $request, Book $book)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'author' => 'required|string|max:255',
            'cover_image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'pdf_file' => 'mimes:pdf|max:10000',
        ]);

        if ($request->hasFile('cover_image')) {
            Storage::disk('public')->delete($book->cover_image);
            $coverImagePath = $request->file('cover_image')->store('covers', 'public');
            $book->cover_image = $coverImagePath;
        }

        if ($request->hasFile('pdf_file')) {
            Storage::disk('public')->delete($book->pdf_file);
            $pdfFilePath = $request->file('pdf_file')->store('pdfs', 'public');
            $book->pdf_file = $pdfFilePath;
        }

        $book->update([
            'title' => $request->title,
            'author' => $request->author,
        ]);

        return redirect()->route('admin.books.index')->with('success', 'Buku berhasil diperbarui');
    }

    // Menghapus buku
    public function destroy(Book $book)
    {
        Storage::disk('public')->delete($book->cover_image);
        Storage::disk('public')->delete($book->pdf_file);
        $book->delete();

        return redirect()->route('admin.books.index')->with('success', 'Buku berhasil dihapus');
    }
}

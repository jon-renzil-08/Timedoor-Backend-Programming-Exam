<?php

namespace App\Http\Controllers;

use App\Models\Author;
use App\Models\Book;
use App\Models\BookCategory;
use Illuminate\Http\Request;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->input('search');
        $author_id = $request->input('author_id');
        $category_id = $request->input('category_id');
        $limit = $request->input('limit', 10);
        $min_rating = $request->input('min_rating'); // <— tambahkan ini

        $query = Book::with('author', 'ratings', 'category')
            ->withAvg('ratings', 'rating')
            ->withCount('ratings');

        // 🔍 filter search
        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                    ->orWhereHas('author', function ($authorQuery) use ($search) {
                        $authorQuery->where('name', 'like', "%{$search}%");
                    });
            });
        }

        // 👨‍💼 filter berdasarkan penulis
        if ($author_id) {
            $query->where('author_id', $author_id);
        }

        // 🗂️ filter berdasarkan kategori
        if ($category_id) {
            $query->where('book_category_id', $category_id);
        }

        // ⭐ filter berdasarkan rata-rata rating minimal
        if ($min_rating) {
            $query->having('ratings_avg_rating', '>=', $min_rating);
        }

        $books = $query->orderByDesc('ratings_avg_rating')->paginate($limit);

        $authors = \App\Models\Author::select('id', 'name')->orderBy('name')->get();
        $categories = \App\Models\BookCategory::select('id', 'name')->orderBy('name')->get();

        return view('book.index', compact('books', 'authors', 'categories', 'search', 'author_id', 'category_id', 'limit', 'min_rating'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Book $book)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Book $book)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Book $book)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Book $book)
    {
        //
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Http\Requests\StoreBookRequest;
use App\Http\Requests\UpdateBookRequest;
use App\Models\Bookshelf;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Support\Facades\Storage;
use Barryvdh\DomPDF\Facade\Pdf as FacadePdf;


class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $books = Book::with(['categories', 'bookshelf'])->get();;
        return view('books.index', [
            'user' => $request->user(),
            'books' => $books,
        ]);
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $bookshelves = Bookshelf::all();
        $categories = Category::all();
        return view('books.create', compact('bookshelves', 'categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreBookRequest $request)
    {
        $validatedData = $request->validated();


        if ($request->hasFile('cover') && $request->file('cover')->isValid()) {
            $validatedData['cover'] = $request->file('cover')->store('images/books', 'public');
        }

        $book = Book::create($validatedData);

        if ($request->has('categories')) {
            $categories = array_filter($request->input('categories'), fn($value) => !is_null($value) && $value !== '');
            $book->categories()->sync($categories);
        }

        return redirect()->route('books.index')->with('success', 'Book created successfully.');
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
    public function edit(Book $book): View
    {
        return view('books.edit', [
            'book' => $book,
            'bookshelves' => Bookshelf::all(),
            'categories' => Category::all()
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateBookRequest $request, Book $book)
{
    $validatedData = $request->validated();
    if ($request->hasFile('cover')) {
        if ($book->cover && Storage::disk('public')->exists($book->cover)) {
            Storage::disk('public')->delete($book->cover);
        }
        $validatedData['cover'] = $request->file('cover')->store('images/books', 'public');
    } else {
        $validatedData['cover'] = $book->cover;
    }
    $book->update($validatedData);
    if ($request->has('categories')) {
        $categories = array_filter($request->input('categories'), fn($value) => !is_null($value) && $value !== '');
        $book->categories()->sync($categories);
    }

    return redirect()->route('books.index')->with('success', 'Book updated successfully.');
}





    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Book $book)
    {
        if ($book->loans()->count() > 0) {
            return redirect()->route('books.index')
                            ->with('error', 'Book cannot be deleted because it is still used by loan.');
        }
        $book->delete();
        return redirect()->route('books.index')
                        ->with('success', 'Book deleted successfully!');
    }

    public function generatePDF(){

        $books = Book::with(['categories', 'bookshelf'])->get();;
        $pdf = FacadePdf::loadView('books.pdf', ['books' => $books]);

        return $pdf->download('tableBooks.pdf');

    }
}

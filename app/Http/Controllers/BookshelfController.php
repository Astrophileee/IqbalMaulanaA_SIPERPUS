<?php

namespace App\Http\Controllers;

use App\Models\Bookshelf;
use App\Http\Requests\StoreBookshelfRequest;
use App\Http\Requests\UpdateBookshelfRequest;
use Illuminate\Http\Request;
use Illuminate\View\View;

class BookshelfController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $bookshelves = Bookshelf::all();
        return view('bookshelves.index', [
            'user' => $request->user(),
            'bookshelves' => $bookshelves,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        return view('bookshelves.create', [
            'user' => $request->user()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreBookshelfRequest $request)
    {

        $validatedData = $request->validated();
        $bookshelf = Bookshelf::create($validatedData);

        return redirect()->route('bookshelves.index')->with('success', 'Booksheld added successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Bookshelf $bookshelf)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Bookshelf $bookshelf)
    {
        return view('bookshelves.edit', compact('bookshelf'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateBookshelfRequest $request, Bookshelf $bookshelf)
    {
        $validatedData = $request->validated();
        $bookshelf->update($validatedData);
        return redirect()->route('bookshelves.index')->with('success', 'Bookshelf updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Bookshelf $bookshelf)
    {
        $bookshelf->delete();
        return redirect()->route('bookshelves.index')->with('success', 'Bookshelf deleted successfully!');
    }
}

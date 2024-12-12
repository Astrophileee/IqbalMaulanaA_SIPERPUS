<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\BookshelfController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\LoanController;
use App\Http\Controllers\LoanDetailController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/', [DashboardController::class, 'dashboard'])->name('dashboard');
});


Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/categories', [CategoryController::class, 'index'])->name('categories.index');
    Route::get('/categories/create', [CategoryController::class, 'create'])->name('categories.create');
    Route::post('/categories', [CategoryController::class, 'store'])->name('categories.store');
    Route::get('/categories/{category}/edit', [CategoryController::class, 'edit'])->name('categories.edit');
    Route::patch('/categories/{category}', [CategoryController::class, 'update'])->name('categories.update');
    Route::delete('/categories/{category}', [CategoryController::class, 'destroy'])->name('categories.destroy');
    Route::get('/categories/pdf', [CategoryController::class, 'generatePDF'])->name('categories.pdf');
});
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/bookshelves', [BookshelfController::class, 'index'])->name('bookshelves.index');
    Route::get('/bookshelves/create', [BookshelfController::class, 'create'])->name('bookshelves.create');
    Route::post('/bookshelves', [BookshelfController::class, 'store'])->name('bookshelves.store');
    Route::get('/bookshelves/{bookshelf}/edit', [BookshelfController::class, 'edit'])->name('bookshelves.edit');
    Route::patch('/bookshelves/{bookshelf}', [BookshelfController::class, 'update'])->name('bookshelves.update');
    Route::delete('/bookshelves/{bookshelf}', [BookshelfController::class, 'destroy'])->name('bookshelves.destroy');
    Route::get('/bookshelves/pdf', [BookshelfController::class, 'generatePDF'])->name('bookshelves.pdf');
});
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/books', [BookController::class, 'index'])->name('books.index');
    Route::get('/books/create', [BookController::class, 'create'])->name('books.create');
    Route::post('/books', [BookController::class, 'store'])->name('books.store');
    Route::get('/books/{book}/edit', [BookController::class, 'edit'])->name('books.edit');
    Route::patch('/books/{book}', [BookController::class, 'update'])->name('books.update');
    Route::delete('/books/{book}', [BookController::class, 'destroy'])->name('books.destroy');
    Route::get('/books/pdf', [BookController::class, 'generatePDF'])->name('books.pdf');
});
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/members', [MemberController::class, 'index'])->name('members.index');
    Route::get('/members/create', [MemberController::class, 'create'])->name('members.create');
    Route::post('/members', [MemberController::class, 'store'])->name('members.store');
    Route::get('/members/{member}/edit', [MemberController::class, 'edit'])->name('members.edit');
    Route::patch('/members/{member}', [MemberController::class, 'update'])->name('members.update');
    Route::delete('/members/{member}', [MemberController::class, 'destroy'])->name('members.destroy');
    Route::get('/members/pdf', [MemberController::class, 'generatePDF'])->name('members.pdf');
});
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/loans', [LoanController::class, 'index'])->name('loans.index');
    Route::get('/loans/create', [LoanController::class, 'create'])->name('loans.create');
    Route::post('/loans', [LoanController::class, 'store'])->name('loans.store');
    Route::get('/loans/{loan}/edit', [LoanController::class, 'edit'])->name('loans.edit');
    Route::patch('/loans/{loan}', [LoanController::class, 'update'])->name('loans.update');
    Route::delete('/loans/{loan}', [LoanController::class, 'destroy'])->name('loans.destroy');
    Route::get('/loans/{loan}/detail', [LoanController::class, 'show'])->name('loans.show');
    Route::post('/loan-details/{loanDetail}/return', [LoanDetailController::class, 'return'])->name('loan-details.return');
    Route::get('/loans/returns', [LoanController::class, 'returns'])->name('loans.returns');
    Route::get('/loans/pdf', [LoanController::class, 'generatePDF'])->name('loans.pdf');
    Route::get('/loans/{loan}/detailPdf', [LoanController::class, 'generateDetailPDF'])->name('loans.detailPdf');
    Route::get('/loans/returnsPdf', [LoanController::class, 'generateReturnsPDF'])->name('loans.returnsPdf');

});

Route::middleware(['auth', 'role:admin','verified'])->group(function () {
    Route::get('/users', [UserController::class, 'index'])->name('users.index');
    Route::post('/users/update-role', [UserController::class, 'updateRole'])->name('users.updateRole');
    Route::delete('/users/{user}', [UserController::class, 'destroy'])->name('users.destroy');
    Route::get('/users/pdf', [UserController::class, 'generatePDF'])->name('users.Pdf');
});




require __DIR__.'/auth.php';

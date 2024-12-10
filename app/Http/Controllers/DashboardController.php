<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;
use App\Models\Bookshelf;
use App\Models\Category;
use App\Models\loan;
use App\Models\Member;

class DashboardController extends Controller
{
    public function dashboard()
    {
        $data = [
            'books_count' => Book::count(),
            'categories_count' => Category::count(),
            'members_count' => Member::count(),
            'bookshelves_count' => Bookshelf::count(),
            'loans_count' => loan::count(),
            'returns_count' => Loan::where('status', 'returned')->count(),
        ];

        return view('dashboard', compact('data'));
    }
}

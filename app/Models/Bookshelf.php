<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Book;

class Bookshelf extends Model
{
    /** @use HasFactory<\Database\Factories\BookshelfFactory> */
    use HasFactory;
    protected $table = 'bookshelves';
    protected $fillable = ['code','name'];
    public function books()
    {
        return $this->hasMany(Book::class);
    }
}

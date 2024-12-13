<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Bookshelf;
use Illuminate\Support\Facades\Storage;

class Book extends Model
{
    /** @use HasFactory<\Database\Factories\BookFactory> */
    use HasFactory;
    protected $table = 'books';
    protected $fillable = ['title', 'author', 'year', 'publisher', 'city', 'cover', 'bookshelf_id'];
    public function bookshelf()
    {
        return $this->belongsTo(Bookshelf::class);
    }
    public function categories()
    {
        return $this->belongsToMany(Category::class, 'book_categories', 'book_id', 'category_id');
    }
    public function loans()
    {
        return $this->belongsToMany(Loan::class, 'loan_detail', 'book_id', 'loan_id');
    }


    protected static function boot()
    {
        parent::boot();

        static::deleting(function ($book) {
            if ($book->cover && Storage::disk('public')->exists($book->cover)) {
                Storage::disk('public')->delete($book->cover);
            }
        });
    }

}

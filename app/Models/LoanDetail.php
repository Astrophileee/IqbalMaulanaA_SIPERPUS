<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LoanDetail extends Model
{
    /** @use HasFactory<\Database\Factories\LoanDetailFactory> */
    use HasFactory;
    protected $table = 'loan_detail';

    protected $fillable = ['loan_id', 'book_id', 'is_return'];

    // Relasi ke model Loan
    public function loan()
    {
        return $this->belongsTo(Loan::class);
    }
    public function returnBook()
    {
        return $this->hasOne(ReturnBook::class);
    }
    public function book()
    {
        return $this->belongsTo(Book::class);
    }
}

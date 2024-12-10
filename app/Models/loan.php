<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class loan extends Model
{
    /** @use HasFactory<\Database\Factories\LoanFactory> */
    use HasFactory;
    protected $table = 'loans';
    protected $fillable = ['user_id', 'member_id', 'date', 'return_at','status'];
    public function books()
    {
        return $this->belongsToMany(Book::class, 'loan_detail', 'loan_id', 'book_id');
    }
    public function member()
    {
        return $this->belongsTo(Member::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function loanDetails()
    {
        return $this->hasMany(LoanDetail::class);
    }
    public function returnBooks()
    {
        return $this->hasManyThrough(ReturnBook::class, LoanDetail::class, 'loan_id', 'loan_detail_id', 'id', 'id');
    }
}

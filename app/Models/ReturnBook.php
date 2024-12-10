<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReturnBook extends Model
{
    /** @use HasFactory<\Database\Factories\ReturnBookFactory> */
    use HasFactory;
    protected $fillable = ['loan_detail_id', 'charge', 'amount'];

    public function loanDetail()
    {
        return $this->belongsTo(LoanDetail::class);
    }
    
}

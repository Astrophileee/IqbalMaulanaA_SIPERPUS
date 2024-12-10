<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    /** @use HasFactory<\Database\Factories\MemberFactory> */
    use HasFactory;
    protected $table = 'members';
    protected $fillable = ['name','phone','email','address'];
    public function loans()
    {
        return $this->hasMany(Loan::class);
    }
}

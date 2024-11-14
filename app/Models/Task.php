<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    // Menambahkan title dan atribut lain yang perlu diisi massal
    protected $fillable = [
        'title', 
        'description',
        'status',
        'user_id',  // jika user_id juga perlu diisi massal
    ];
}

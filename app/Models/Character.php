<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Character extends Model
{
    use HasFactory;

    protected $fillable = [

        'name',
        'role',
        'server name',
        'char_level',
        'exp amount',

    ];

    protected $casts = [

        'logged in at' => 'datetime',

    ];
}

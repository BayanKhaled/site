<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class actor extends Model
{
    use HasFactory;
    protected $table = 'actors';
    public $timestamps = false;
    protected $fillable = [
        'name',
        'email',
    ];

}

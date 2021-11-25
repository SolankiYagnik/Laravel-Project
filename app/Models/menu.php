<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class menu extends Model
{
    protected $fillable = [
        'id',
        'm_name',
        'order',
    ];
    use HasFactory;
}

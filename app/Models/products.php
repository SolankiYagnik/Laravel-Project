<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class products extends Model
{
    protected $fillable = [
        'id',
        'c_id',
        'p_name',
        'p_sku',
        'p_tags',
        'p_description',
        'p_image',
        'p_stock',
        'p_price',
    ];
    use HasFactory;
}

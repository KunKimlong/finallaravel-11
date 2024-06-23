<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'qty',
        'regular_price',
        'sale_price',
        'color',
        'size',
        'author',
        'viewer',
        'category',
        'thumbnail',
        'description'
    ];
    protected $table = 'product';
}

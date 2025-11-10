<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = 'products';

    protected $fillable = [
        'name',
        'description',
        'category_id',
        'stock',
        'price',
        'image_path',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}

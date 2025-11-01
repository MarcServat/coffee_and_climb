<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = 'products';

    protected $fillable = ['name', 'category_id', 'price'];

    // A product belongs to a category
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}

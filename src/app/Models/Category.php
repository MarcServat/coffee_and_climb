<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table = 'categories';

    protected $fillable = ['id','name'];

    // A category has many products
    public function products()
    {
        return $this->hasMany(Product::class);
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory; // 1. Import the trait

class Product extends Model
{
    use HasFactory; // 2. Use the trait
    protected $table = 'products';
    protected $fillable = ['name','category_id'];

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory; // 1. Import the trait

class Category extends Model
{
    use HasFactory; // 2. Use the trait
    protected $table = 'categories';
    protected $fillable = ['name', 'description', 'parent_id'];



    public function parent()
    {
        return $this->belongsTo(Category::class, 'parent_id');
    }
    public function children()
    {
        return $this->hasMany(Category::class, 'parent_id');
    }

    // Get infinite sub-children recursively
public function allChildren()
{
    return $this->children()->with('allChildren');
}

    public function products()
    {
        return $this->hasMany(Product::class, 'category_id');
    }


    public function active_products()
    {
        return $this->hasMany(Product::class, 'category_id')->where('status', 'active');
    }
     public function inactive_products()
    {
        return $this->hasMany(Product::class, 'category_id')->where('status', 'inactive');
    }


    
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'parent_id'];

    
    public function products()
    {
        return $this->belongsToMany(Product::class, 'categories_products', 'category_id','product_id');
    }

    public function children()
    {
        return $this->hasMany(SELF::class, 'parent_id');
    }

    public function parentCategory()
    {
        return $this->hasOne(SELF::class, 'id', 'parent_id');
    }



 

}

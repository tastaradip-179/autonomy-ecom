<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function categories()
    {
        return $this->belongsToMany(Category::class, 'categories_products', 'product_id', 'category_id');
    }

    public function attributes()
    {
        return $this->belongsToMany(Attribute::class, 'products_attributes', 'product_id', 'attribute_id')->withPivot("attribute_value");
    }


    public function images()
    {
        return $this->morphMany('App\Models\Image', 'imageable');
    }

    public function getImage()
    {
        $image = $this->images()->where('type', 1)->first();
        if (!empty($image)) {
            return $image->name;
        }
        return '';
    }

}

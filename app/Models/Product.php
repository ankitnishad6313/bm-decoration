<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'category_id',
        'sub_category_id',
        'title',
        'name',
        'product_slug',
        'thumb_img',
        'price',
        'discount_price',
        'discount_percentage',
        'inclusion',
        'exclusion',
        'status',
        'is_trending',
        'is_popular',
        'description',
        'meta_keywords',
        'meta_description'
    ];
    protected $casts = [
        'images' => 'array',
        'inclusion' => 'array',
        'exclusion' => 'array'
    ];

    public function setTitleAttribute($value){
        return $this->attributes['title'] = ucwords($value);
    }
    public function setNameAttribute($value){
        return $this->attributes['name'] = ucwords($value);
    }

    public function setProductSlugAttribute($value)
    {
        return $this->attributes['product_slug'] = strtolower(str_replace(" ", "-", $value));
    }
    
    public function category(){
        return $this->belongsTo(Category::class);
    }

    public function subCategory(){
        return $this->belongsTo(SubCategory::class);
    }

    public function reviews(){
        return $this->hasMany(Review::class);
    }
    public function carts(){
        return $this->hasMany(Cart::class);
    }
    public function productImages(){
        return $this->hasMany(ProductImage::class);
    }
    public function orders(){
        return $this->hasMany(Order::class);
    }
}

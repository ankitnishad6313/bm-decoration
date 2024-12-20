<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'cat_name',
        'cat_image',
        'category_slug',
        'status',
        "is_trending",
        "is_popular",
        "is_menu",
        'description',
        'meta_keywords',
        'meta_description'
    ];

    protected $hidden = [
        "is_trending",
        "is_popular",
        "is_menu",
        "created_at",
        "updated_at",
        "deleted_at"
    ];

    public function getCatImageAttribute($value){
        return url("/uploads/categories/$value");
    }

    public function setTitleAttribute($value){
        return $this->attributes['title'] = ucwords($value);
    }
    public function setCatNameAttribute($value){
        return $this->attributes['cat_name'] = ucwords($value);
    }

    public function setCategorySlugAttribute($value)
    {
        return $this->attributes['category_slug'] = strtolower(str_replace(" ", "-", $value));
    }
    
    public function subCategory()
    {
        return $this->hasMany(SubCategory::class);
    }
    public function products()
    {
        return $this->hasMany(Product::class);
    }

}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubCategory extends Model
{
    use HasFactory;

    protected $fillable = [
      'category_id',
      'title',
      'sub_cat_name',
      'sub_category_slug',
      'status'  
    ];

    public function setTitleAttribute($value){
        return $this->attributes['title'] = ucwords($value);
    }
    public function setNameAttribute($value){
        return $this->attributes['name'] = ucwords($value);
    }

    public function setSubCategorySlugAttribute($value)
    {
        return $this->attributes['sub_category_slug'] = strtolower(str_replace(" ", "-", $value));
    }

    public function category(){
        return $this->belongsTo(Category::class);
    }

    public function products(){
        return $this->hasMany(Product::class);
    }
}

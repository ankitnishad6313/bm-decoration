<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'city',
        'image',
        'phone',
        'city_slug',
        'is_popular',
        'is_menu',
        'status',
        'description',
        'meta_keywords',
        'meta_description',
        'map'
    ];

    public function setTitleAttribute($value)
    {
        return $this->attributes['title'] = ucwords($value);
    }

    public function setCityAttribute($value)
    {
        return $this->attributes['city'] = ucwords($value);
    }
    public function setCitySlugAttribute($value)
    {
        return $this->attributes['city_slug'] = strtolower(str_replace(" ", "-", $value));
    }

    public function orders(){
        return $this->hasMany(Order::class);
    }
}

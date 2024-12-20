<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'user_id',
        'product_id',
        'city_id',
        'date',
        'time',
        'amount',
        'product_quantity',
        'product_price',
        'addon_id',
        'addon_quantity',
        'addon_price',
        'total_amount',
        'payment_status',
        'name',
        'email',
        'phone',
        'alternate_phone',
        'current_address',
        'landmark',
        'pincode',
        'city',
        'occasion',
        'location',
    ];

    protected $casts = [
        'addon_id' => 'array',
        'addon_quantity' => 'array',
        'addon_price' => 'array',
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function category(){
        return $this->belongsTo(Category::class);
    }

    public function subCategory(){
        return $this->belongsTo(SubCategory::class);
    }
    public function product(){
        return $this->belongsTo(Product::class);
    }

    public function city(){
        return $this->belongsTo(City::class);
    }
}

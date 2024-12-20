<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AddonItems extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'product_id',
        'addon_product_id',
        'quantity'
    ];

    public function addonproduct(){
        return $this->belongsTo(AddonProduct::class, 'addon_product_id');
    }


}


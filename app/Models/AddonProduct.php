<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AddonProduct extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'image',
        'price',
        'is_popular'
    ];

    public function addonitems()
    {
        return $this->hasMany(AddonItems::class);
    }
}

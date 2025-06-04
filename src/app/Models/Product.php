<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
     
     protected $fillable = [
        'name',
        'price',
        'image',
        'description',
    ];

    // 多対多リレーション：Product は複数の Season に属する
    public function seasons()
    {
        return $this->belongsToMany(Season::class, 'product_season');
    }
}


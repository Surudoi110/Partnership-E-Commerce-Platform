<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'seller_id',
        'title',
        'description',
        'price',
        'stock',
        'category',
        'condition',
        'status'
    ];

    public function partner()
    {
        return $this->belongsTo(User::class, 'seller_id');
    }
    
    public function images()
    {
        return $this->hasMany(ProductImage::class);
    }

    public function cartItems()
    {
        return $this->hasMany(CartItem::class);
    }
}

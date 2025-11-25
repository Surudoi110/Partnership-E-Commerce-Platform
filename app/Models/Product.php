<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'name',
        'description',
        'price',
        'image',
        'partner_id',
    ];

    // Relationship: one partner has many products
    public function partner()
    {
        return $this->belongsTo(Partner::class);
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class cart_item extends Model
{
 protected $table = 'cart_item';

    protected $fillable = [
        'quantity',
        'cart_id',
        'product_id'
    ];

    // Cart item belongs to a cart
    public function cart()
    {
        return $this->belongsTo(cart::class, 'cart_id');
    }

    // Cart item belongs to a product
    public function product()
    {
        return $this->belongsTo(product::class, 'product_id');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class order_item extends Model
{
    protected $table = 'order_item';
    
    public $timestamps = false;

    protected $fillable = [
        'quantity',
        'amount',
        'product_id',
        'order_id',
        'created_at',
        'updated_at'
    ];

    // Relationship with orders
    public function orders()
    {
        return $this->belongsTo(orders::class, 'order_id');
    }

    // Relationship with product
    public function product()
    {
        return $this->belongsTo(product::class, 'product_id');
    }
}
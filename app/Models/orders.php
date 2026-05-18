<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class orders extends Model
{
    protected $table = 'orders';
    
    public $timestamps = true;

    protected $fillable = [
        'status',
        'total_amount',
        'address_id',
        'user_id',
        'created_at',
        'updated_at'
    ];

    // Order belongs to a user
    public function user()
    {
        return $this->belongsTo(user::class, 'user_id');
    }

    public function review()
{
    return $this->hasMany(\App\Models\review::class, 'order_id');
}

    // Order belongs to an address
    public function address()
    {
        return $this->belongsTo(address::class, 'address_id');
    }

    // Order has many order items
    public function order_item()
    {
        return $this->hasMany(order_item::class, 'order_id');
    }

    // Order has one payment
    public function payment()
    {
        return $this->hasOne(payment::class, 'order_id');
    }
}
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserGood extends Model
{
protected $table = 'user_table';

protected $fillable = [
    'quantity',
    'collect_delivery',
    'destination',
    'status',
    'user_id',
    'product_id',
    'amount'
];

public function user()
{
    return $this->belongsTo(User::class, 'user_id');
}
 
public product()
{
    return $this->belongsTo(product::class, 'product_id');
}

public function payment()
{
    return $this->hasOne(payment::class, 'user_goods_id');
}

public function review()
{
    return $this->hasOne(Review::class, 'user_goods_id');
}
}

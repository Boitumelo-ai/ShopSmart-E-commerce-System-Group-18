<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
protected $table = 'product';

protected $fillable =[
    'description',
    'quantity',
    'amount',
    'offered_by'
];
public function user()
{
    return $this->belongsTo(User::class, 'offered_by');
}

public function userGood()
 {
  return $this->hasMany(UserGood::class, 'product_id');
 }
}

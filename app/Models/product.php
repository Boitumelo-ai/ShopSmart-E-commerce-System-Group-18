<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class product extends Model
{
protected $table = 'product';

protected $table =[
    'description',
    'Quantity',
    'amount',
    'offered_by'
];
public function user()
{
    return $this->belongsTo(User::class, 'offered_by');
}

public function userGood()
{
public $this->hasMany(UserGood::class, 'product_id')
}
}

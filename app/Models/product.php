<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = 'product';

<<<<<<< HEAD
    protected $fillable = [
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
=======
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
>>>>>>> 3068948830f8d83785cd1025885a24c47203daec

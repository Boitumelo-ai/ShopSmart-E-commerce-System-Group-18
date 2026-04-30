<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class review extends Model
{
protected $table = 'review';

protected $fillable = [
    'comment',
    'ratings',
    'user_good_id'
];

public function userGood()
{
    return $this->belongsTo(userGood::class, 'user_goods_id');
}
}

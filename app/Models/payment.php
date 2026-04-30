<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class payment extends Model
{
    protected $table = 'payment';

    protected $fillable = [
        'method',
        'user_goods_id'
    ];

    public function userGood()
    {
        return $this->belongsTo(userGood::class, 'user_goods_id');
    }
}

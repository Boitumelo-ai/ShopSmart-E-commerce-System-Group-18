<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class address extends Model
{
    protected $table = 'address';
    public $timestamps = false;

    protected $fillable = [
        'residence',
        'user_id',
        'created_at',
        'updated_at'
    ];

    // Address belongs to a user
    public function user()
    {
        return $this->belongsTo(user::class, 'user_id');
    }

    // Address has many orders
    public function orders()
    {
        return $this->hasMany(orders::class, 'address_id');
    }
}
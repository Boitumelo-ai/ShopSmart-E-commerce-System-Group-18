<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class category extends Model
{
    protected $table = 'category';
    public $timestamps = false;

    protected $fillable = ['name'];

    // Category has many products
    public function product()
    {
        return $this->hasMany(product::class, 'category_id');
    }
}
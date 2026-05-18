<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class product_image extends Model
{
     protected $table = 'product_image';
     public $timestamps = false;

    protected $fillable = [
        'image_url',
        'product_id'
    ];

    // Image belongs to a product
    public function product()
    {
        return $this->belongsTo(product::class, 'product_id');
    }
}

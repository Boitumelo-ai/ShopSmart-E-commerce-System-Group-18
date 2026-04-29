<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class role extends Model
{
    protected $table = 'role';
    protected $fillable =['name'];

    public function users(){
        return $this -> hasMany(user:: class, 'role_id')
    }
}

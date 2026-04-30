<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
// Authenticatable gives our User model login/authentication features
// This is what allows users to log in and log out
use Illuminate\Foundation\Auth\User as Authenticatable;

// Notifiable allows us to send notifications to users
use Illuminate\Notifications\Notifiable;


// The User class represents the 'user' table in our database
// Each User object = one row in the user table
class User extends Authenticatable
{
    // Notifiable trait adds notification features to this model
    use Notifiable;
    
    // Tell Laravel the exact table name in the database
    // Our table is called 'user' not 'users'
    protected $table = 'user';
    
     // Only these columns can be filled when creating or updating a user
    // This prevents unwanted columns from being changed (mass assignment protection)
    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'password',
        'role_id'
    ];
    protected $hidden = ['password']; // Never expose the password in responses


    // casts() tells Laravel how to treat certain column values
    // 'hashed' means the password will be automatically encrypted
    // before being saved to the database
    protected function casts(): array{
        return [
            'password' => 'hashed',
        ];
    }
    // RELATIONSHIP: A User BELONGS TO one Role
    // For example: John belongs to the "Student" role
    // 'role_id' is the foreign key in our user table
    public function role()
    {
        return $this->belongsTo(Role::class, 'role_id');
    }
   
     // RELATIONSHIP: A User HAS MANY Products
    // For example: A vendor user can sell many products
    // 'offered_by' is the foreign key in the product table
    public function products()
    {
        return $this->hasMany(product::class, 'offered_by');
    }

    // RELATIONSHIP: A User HAS MANY UserGoods (orders)
    // For example: A user can place many orders over time
    // 'user_id' is the foreign key in the user_goods table
    public function userGoods()
    {
        return $this->hasMany(UserGood::class, 'user_id');
    }
}
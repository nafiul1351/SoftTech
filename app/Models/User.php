<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'firstname',
        'lastname',
        'gender',
        'dob',
        'email',
        'phonenumber',
        'image',
        'type',
        'approved',
        'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function sellerdetails()
    {
        return $this->hasOne('App\Models\Sellerdetail');
    }

    public function shops()
    {
        return $this->hasMany('App\Models\Shop');
    }

    public function products()
    {
        return $this->hasMany('App\Models\Product');
    }

    public function reviews()
    {
        return $this->hasMany('App\Models\Review');
    }

    public function wishlists()
    {
        return $this->hasMany('App\Models\Wishlist');
    }

    public function checkwishlists($product_id)
    {
        return $this->wishlists->where('product_id', $product_id)->count() > 0;
    }

    public function carts()
    {
        return $this->hasMany('App\Models\Cart');
    }

    public function orders()
    {
        return $this->hasMany('App\Models\Order');
    }
}

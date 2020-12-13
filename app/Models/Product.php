<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'productid',
        'productname',
        'productmodel',
        'productcolor',
        'productsize',
        'coverimage',
        'regularprice',
        'discountedprice',
        'productdescription',
        'user_id',
        'brand_id',
        'category_id',
        'shop_id',
    ];

    public function users()
    {
        return $this->belongsTo('App\Models\User', 'user_id');
    }

    public function brands()
    {
        return $this->belongsTo('App\Models\Brand', 'brand_id');
    }

    public function categories()
    {
        return $this->belongsTo('App\Models\Category', 'category_id');
    }

    public function shops()
    {
        return $this->belongsTo('App\Models\Shop', 'shop_id');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sellerdetail extends Model
{
    use HasFactory;

    protected $fillable = [
        'bkashnumber',
        'rocketnumber',
        'user_id',
    ];

    public function users()
    {
        return $this->belongsTo('App\Models\User', 'user_id');
    }
}

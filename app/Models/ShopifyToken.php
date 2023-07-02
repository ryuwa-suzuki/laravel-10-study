<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

class ShopifyToken extends Authenticatable
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array<string>
     */
    protected $fillable = [
        'token'
    ];
}

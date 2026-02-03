<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class Store extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'description',
        'logo_image',
        'caver_image',
        'status',
    ];

    public function products(){
        return $this->hasMany(Products::class, 'store_id', 'id');
    }
}

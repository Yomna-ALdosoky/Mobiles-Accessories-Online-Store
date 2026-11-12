<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;
use Spatie\Translatable\HasTranslations;

class Store extends Model
{
    use HasFactory, Notifiable, HasTranslations;

    protected $fillable = [
        'name',
        'slug',
        'description',
        'logo_image',
        'caver_image',
        'status',
    ];

    public $translatable = [
        'name',
        'description',
    ];

    public function products()
    {
        return $this->hasMany(Products::class, 'store_id', 'id');
    }
}

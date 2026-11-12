<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Str;
use Spatie\Translatable\HasTranslations;

class Brand extends Model
{
    use HasFactory, HasTranslations;

    protected $fillable = ['name', 'slug', 'image', 'status'];

    public $translatable = [
        'name',
    ];

    public function products()
    {
        return $this->hasMany(Product::class, 'brand_id', 'id');
    }
    public function setNameAttribute($value)
    {
        $this->attributes['name'] = $value;
        $this->attributes['slug'] = Str::slug($value);
    }
}

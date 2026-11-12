<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\Translatable\HasTranslations;

class Blog extends Model
{
    use HasFactory, HasTranslations;

    protected $fillable = [
        'user_id',
        'category_id',
        'title',
        'slug',
        'image',
        'excerpt',
        'content',
        'published_at',
        'is_published',
    ];

    public $translatable = ['title', 'excerpt', 'content'];

    protected $casts = [
        'published_at' => 'datetime',
        'is_published' => 'boolean',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function scopeFeatured($query)
    {
        return $query->where('is_published', true)
            ->where('is_featured', true);
    }

    public function scopeSearch($query, $term)
    {
        return $query->when($term, function ($q, $s) {
            $q->where(function ($q) use ($s) {
                $q->where('title', 'like', "%{$s}%")
                    ->orWhere('excerpt', 'like', "%{$s}%")
                    ->orWhere('content', 'like', "%{$s}%")
                    ->orWhereHas('category', function ($catQuery) use ($s) {
                        $catQuery->where('name', 'like', "%{$s}%");
                    });
            });
        });
    }
}

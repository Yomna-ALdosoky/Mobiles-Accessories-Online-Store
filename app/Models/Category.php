<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use App\Models\Product;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Spatie\Translatable\HasTranslations;

use Illuminate\Validation\Rule;

class Category extends Model
{
    // use SoftDeletes, HasFactory;
    use HasFactory, HasTranslations;

    protected $fillable = [
        'name',
        'parent_id',
        'slug',
        'description',
        'image',
        'status',
    ];

    public $translatable = [
        'name',
        'description',
    ];

    public function products()
    {
        return $this->hasMany(Product::class, 'category_id', 'id');
    }

    public function parent()
    {
        return $this->belongsTo(Category::class, 'parent_id', 'id');
    }

    public function posts()
    {
        return $this->hasMany(Post::class);
    }

    public function children()
    {
        return $this->hasMany(Category::class, 'parent_id', 'id');
    }

    public function blogs()
    {
        return $this->hasMany(Blog::class);
    }

    public function scopeFilter(Builder $builder, $filters)
    {

        $builder->when($filters['name'] ?? false, function ($builder, $value) {
            $builder->where('categories.name', 'LIKE', "%{$value}%");
        });
        $builder->when($filters['status'] ?? false, function ($builder, $value) {
            $builder->where('categories.status', '=', $value);
        });
    }

    public static function rules($id = 0)
    {
        return [
            'name' => [
                'required',
                'string',
                'min:3',
                'max:255',
                Rule::unique('categories', 'name')->ignore($id),
                'fillter:php,laravel,html',
            ],
            'parent_id' => [
                'nullable',
                'integer',
                'exists:categories,id'
            ],
            'image' => [
                'image',
                'max:1048576',
                'dimensions:min_width=100,min_height=100',
            ],
            'status' => 'required|in:active,archived',
        ];
    }
    public function scopeActive(Builder $builder)
    {
        $builder->where('status', '=', 'active');
    }

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($category) {
            if (empty($category->slug)) {
                $category->slug = Str::slug($category->name);
            }
        });

        static::updating(function ($category) {
            if (empty($category->slug)) {
                $category->slug = Str::slug($category->name);
            }
        });
    }

    // protected function name(): Attribute
    // {
    //     return Attribute::make(
    //         get: fn($value) => json_decode($value, true)[app()->getLocale()]
    //             ?? json_decode($value, true)['en']
    //             ?? $value
    //     );
    // }
}

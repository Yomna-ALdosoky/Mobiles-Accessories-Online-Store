<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Spatie\Translatable\HasTranslations;

class Product extends Model
{
    use SoftDeletes, HasFactory, HasTranslations;

    protected $fillable = [
        'store_id',
        'category_id',
        'name',
        'slug',
        'description',
        'image',
        'price',
        'compare_price',
        'options',
        'rating',
        'featured',
        'quantity',
        'status',
        'brand_id'
    ];
    public $translatable = [
        'name',
        'description'
    ];
    protected $hidden = [
        // 'image',
        'created_at',
        'updated_at',
        'deleted_at'
    ];
    protected $casts = [
        'options' => 'array',
        'featured' => 'boolean',
        'rating' => 'float',
    ];
    protected $appends = [
        'image_url',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }

    public function store()
    {
        return $this->belongsTo(Store::class, 'store_id', 'id');
    }
    public function tags()
    {
        return $this->belongsToMany(
            Tag::class,
            'product_tag',
            'product_id',
            'tag_id',
            'id',
            'id'
        );
    }
    public function brand()
    {
        return $this->belongsTo(Brand::class, 'brand_id', 'id');
    }
    public function images()
    {
        return $this->hasMany(ProductImage::class, 'product_id');
    }
    public function coverImage()
    {
        return $this->hasOne(ProductImage::class)->where('is_primary', true)->withDefault();
    }

    protected static function booted()
    {
        static::addGlobalScope('store', function (Builder $builder) {
            $user = Auth::user();
            if ($user && $user->store_id && request()->is('admin/*')) {
                $builder->where('store_id', '=', $user->store_id);
            }
        });

        static::creating(function (Product $product) {
            if (empty($product->slug)) {
                $product->slug = Str::slug($product->name) . '-' . Str::lower(Str::random(5));
            }
        });
    }

    public function scopeActive(Builder $builder)
    {
        $builder->where('status', '=', 'active');
    }

    public function getImageUrlAttribute()
    {
        $imagePath = $this->coverImage->image ?? $this->images->first()?->image;

        if (!$imagePath) {
            return asset('assets/images/default-product.png');
        }
        if (Str::startsWith($imagePath, ['http://', 'https://'])) {
            return $imagePath;
        }
        return asset('storage/' . $imagePath);
    }

    public function getSalePercentAttribute()
    {
        if (!$this->compare_price) {
            return 0;
        }
        return round(100 - (100 * $this->price / $this->compare_price), 1);
    }
    public function scopeFilter(Builder $builder, $filters)
    {
        $options = array_merge([
            'store_id' => null,
            'category_id' => null,
            'tag_id' => null,
            'status' => 'active',
            'name' => null,
        ], $filters);

        $builder->when($options['status'], function ($query, $status) {
            return $query->where('status', $status);
        });
        $builder->when($options['store_id'], function ($builder, $value) {
            $builder->where('store_id', $value);
        });
        $builder->when($options['category_id'], function ($builder, $value) {
            $builder->where('category_id', $value);
        });
        $builder->when($options['name'], function ($builder, $value) {
            $builder->where('name', 'LIKE', '%{$value}%');
        });
        $builder->when($options['tag_id'], function ($builder, $value) {
            $builder->whereExists(function ($query) use ($value) {
                $query->select(1)
                    ->from('product_tag')
                    ->whereRaw('product_id = product.id')
                    ->where('tag_id', $value);
            });
        });
    }
}

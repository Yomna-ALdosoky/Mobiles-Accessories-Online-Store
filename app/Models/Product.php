<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class Product extends Model
{
    use SoftDeletes, HasFactory;

    protected $fillable = [
        'store_id', 'category_id', 'name', 'slug', 
        'description', 'image', 'price', 'compare_price',
        'options','rating', 'featured', 'status'
    ];

    public function category(){
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }

    public function store() {
        return $this->belongsTo(Store::class, 'store_id', 'id');
    }
    public function tags(){
        return $this->belongsToMany(
            Tag::class,
            'product_tag',
            'product_id',
            'tag_id',
            'id',
            'id'
        );
    }

    protected static function booted(){
        static::addGlobalScope('store', function (Builder $builder) {
            $user = Auth::user();
            if($user && $user->store_id){
                $builder->where('store_id', '=', $user->store_id);
            }
        });
    }

    public function scopeActive(Builder $builder){
        $builder->where('status', '=', 'active');
    }

    public function getImageUrlAttribute(){

        if(!$this->image){
            return "https://www.opelgtsource.com/assets/default_product.png";
        }
        if(Str::startsWith($this->image, ['http://', 'https://'])){
            return $this->image;
       }
        return asset('storage/' . $this->image);
      
    }

    public function getSalePercentAttribute(){
        if(!$this->compare_price){
            return 0;
        }
        return round(100-(100 *$this->price / $this->compare_price), 1);
    }
    
    public function scopeFilter(Builder $builder, $filters){
        $builder->when($filters['name'] ?? null, function ($query, $value) {
            $query->where('name', 'LIKE', "%{$value}%");
        });

        $builder->when($filters['status'] ?? null, function ($query, $value) {
            $query->where('status', 'LIKE', $value);
        });
    }
    

}

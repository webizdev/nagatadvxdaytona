<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = ['category_id', 'sku', 'name', 'slug', 'description', 'features', 'image_path', 'gallery', 'technical_specs'];

    protected $casts = [
        'gallery' => 'array',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function specifications()
    {
        return $this->hasMany(ProductSpecification::class);
    }

    public function motorcycles()
    {
        return $this->belongsToMany(MotorcycleModel::class, 'product_motorcycle', 'product_id', 'motorcycle_id')
            ->withPivot(['diameter', 'color', 'part_number'])
            ->withTimestamps();
    }
}

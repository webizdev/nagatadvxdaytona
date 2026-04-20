<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MotorcycleModel extends Model
{
    protected $table = 'motorcycle_models';
    
    protected $fillable = ['brand', 'model_name'];

    public function products()
    {
        return $this->belongsToMany(Product::class, 'product_motorcycle', 'motorcycle_id', 'product_id');
    }
}

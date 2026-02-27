<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    //
    protected $fillable = [
    'name',
    'description',
    'price',
    'brand',
    'inStock',
    'category_id',
    'type',
    
    ];
    public function category(){
    return $this->belongsTo(Category::class);
    }
    public function ac(){
        return $this->hasOne(Ac::class);
    }
    public function waterFilter(){
        return $this->hasOne(WaterFilter::class);
    }
}

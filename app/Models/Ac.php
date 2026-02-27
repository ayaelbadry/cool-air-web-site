<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ac extends Model
{
    //
    protected $table= 'ac';
    protected $fillable = [
    'product_id',    
    'horsepower',
    'energy_rating'];
     protected $primaryKey = 'product_id';
    public $incrementing = false;
    public function product(){
    return $this->belongsTo(Product::class);
}
}
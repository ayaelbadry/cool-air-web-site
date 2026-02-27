<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WaterFilter extends Model
{
    //
    protected $fillable = [
    'product_id',    
    'number_of_stages'];
     protected $primaryKey = 'product_id';
public $incrementing = false;

public function product()
{
    return $this->belongsTo(Product::class);
}
}

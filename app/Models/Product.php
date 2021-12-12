<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Jenssegers\Mongodb\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $fillable = [
      'product_name',
      'product_description',
      'product_price',
        'product_picture'
    ];

   public function order()
   {
       return $this->hasMany(Order::class);
   }

   public function deliveredProduct()
   {
       return $this->hasMany(DeliveredProduct::class);
   }




}

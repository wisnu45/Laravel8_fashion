<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;
  protected $fillable=[
      'customer_id',
      'product_id',
      'qty',
      'price',
      'created_at'
  ];
  public function Customer() {
    return $this->hasOne(Customer::class,'id','customer_id');
  }
  public function product() {
    return $this->hasOne(Product::class,'id','product_id');
  }
}

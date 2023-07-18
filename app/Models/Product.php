<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Menu;
class Product extends Model
{
    use HasFactory;
    protected $fillable=[
        'name',
        'category_id',
        'thumb',
        'content',
        'description',
        'price',
        'price_sale',
        'active'
    ];
    public function menu() {
        return $this->hasOne(Menu::class,'id','category_id'); //id của Menu , menu_id của Product
    }
}

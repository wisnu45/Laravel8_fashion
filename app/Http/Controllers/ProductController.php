<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function detailProduct($id) {
      return Product::where('id',$id)->firstOrFail();
    }
    
    public function index($id) {
       $product=$this->detailProduct($id);
      // dd($product->name);
       return view('frontend.detailProduct',[
           'title'=>$product->name,
           'product'=>$product
       ]);
    }
    
}

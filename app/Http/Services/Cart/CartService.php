<?php

namespace App\Http\Services\Cart;

use App\Jobs\SendMail;
use App\Models\Cart;
use App\Models\Customer;
use App\Models\Product;
use Illuminate\Contracts\Session\Session;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session as FacadesSession;
use PhpParser\Node\Stmt\Return_;

class CartService
{
    public function create($request) {
        $quantity=(int)$request->input('num-product');
        $product_id=$request->input('product-id');
      
        if($quantity<=0 || $product_id<=0) {
            Session()->flash('error','Số lượng hoặc sản phẩm không chinh xác');
            return false;
        }
        $carts=Session()->get('carts');
        if(is_null($carts)) {
            Session()->put('carts',[
                $product_id =>$quantity
            ]);
            return true;
        }
        $exists=Arr::exists($carts,$product_id);
        if($exists) {
            $carts[$product_id]=$carts[$product_id]+$quantity;
           Session()->put('carts',$carts);
              
          
           return true;
        }
        $carts[$product_id]=$quantity;
        Session()->put('carts',$carts);
        return true;
    
    }
    public function getProduct() {
        $carts=Session()->get('carts');
        if(is_null($carts)) {
            return [];
        }
        $productId=array_keys($carts);
        return Product::select('id','name','price','price_sale','thumb')->
        where('active',1)->whereIn('id',$productId)->get();
    } 
    public function update($request) {
      //  dd($request->all());
     
        Session()->put('carts',$request->input('num-product'));
        return true;
    }
    public function addCart($request) {

        try {
            DB::beginTransaction();
            $carts = Session()->get('carts');
         
            if (is_null($carts))
                return false;
          
            $customer = Customer::create([
                'name' => $request->input('name'),
                'phone' => $request->input('phone'),
                'address' => $request->input('address'),
                'email' => $request->input('email'),
                'content' => $request->input('content')
            ]);

           

         
        $this-> infoProductCart($carts,$customer->id) ;
        DB::commit();
            Session()->flash('success','Đặt Hàng Thành Công');

            #Queue
            SendMail::dispatch($request->input('email'))->delay(now()->addSecond(2));
            Session()->forget('carts'); //Xóa session Carts

        } catch (\Throwable $th) {
            DB::rollBack();
            Session()->flash('error','Đặt Hàng Thất Bại');
            return false;
        }
     
     return true;
    }

    protected function infoProductCart($carts,$customer) {

        $productId=array_keys($carts);
        $products= Product::select('id','name','price','price_sale','thumb')->
        where('active',1)->whereIn('id',$productId)->get();
        $data=[];
       
        foreach($products as $product) {
          
            //dd($carts[$product->id]);
         $data[]=[
             'customer_id'=>$customer,
             'product_id'=>$product->id,
             'qty'=>$carts[$product->id],
             'price'=>$product->price_sale !=0?$product->price_sale:$product->price,
         ];
        
        }
        return Cart::insert($data);
    }
}
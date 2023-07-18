<?php

namespace App\Http\Controllers;

use App\Http\Services\Cart\CartService;
use Illuminate\Contracts\Session\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session as FacadesSession;

class CartController extends Controller
{
    public function __construct(CartService $cartService)
    {
        $this->cartService=$cartService;
    }
    public function index(Request $request) {
       $result=$this->cartService->create($request);
     if($result ==false) {
         return Redirect()->back();
     }
     return redirect('/cart');
    }
    public function show() {
        $product=$this->cartService->getProduct();
        return view('frontend.Carts.list',[
            'title'=>'Giỏ Hàng',
            'products'=>$product,
            'carts'=>Session()->get('carts')
        ]);
    }
    public function update(Request $request) {
        $this->cartService->update($request);
        return redirect('/cart');
    }
    public function delete($id) {
        $cart=Session()->get('carts');
        unset($cart[$id]);
        Session()->put('carts',$cart);
        return redirect('/cart');
    }
    public function add(Request $request) {
    $result=$this->cartService->addCart($request);
   
    return redirect()->back();
    }
}

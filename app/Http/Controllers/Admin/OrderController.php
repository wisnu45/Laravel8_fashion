<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Services\Order\OrderService;
use App\Models\Customer;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    
  public function __construct(OrderService $orderService)
  {
    $this->orderService=$orderService;  
  }

    public function list() {
       // dd($this->orderService->list());
    return view('admin.orders.list',[
     'title'=>'Danh sách đơn hàng',
     'orders'=>  $this->orderService->list(),
 ]);
    }
    public function view( $id) {
    
      $customer=Customer::where('id',$id)->first();
     //dd($customer->carts()->get());
      $this->orderService->view($id);
       return response()->json([
         'customer'=>$customer,
         'carts'=>$customer->carts()->with('product')->get()
       ]);
    }
}

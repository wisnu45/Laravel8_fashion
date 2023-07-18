<?php

namespace App\Http\Services\Order;

use App\Models\Cart;
use App\Models\Customer;

class orderService
{


    public function list() {
        return Customer::orderBy('id','DESC')->paginate(15);
    }
    public function view($id) {
        
    }
}
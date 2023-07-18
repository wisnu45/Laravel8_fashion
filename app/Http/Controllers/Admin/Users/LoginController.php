<?php

namespace App\Http\Controllers\Admin\Users;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\Session\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class LoginController extends Controller
{
    public function index() {
        return view('admin.users.login',[
            'title'=>'Đăng nhập hệ thống'
        ]);
    }
    public function store(Request $request) {
       

        $this->validate($request,[
         'email'=>'required',
         'password'=>'required'
        ],[
            'email.required'=>'Vui lòng nhập email',
            'password.required'=>'vui lòng nhập mật khẩu',
        ]);
        if (Auth::attempt(['email' => $request->input('email'), 'password' => $request->input('password')],
        $request->input('remember')
        )) {
           return redirect()-> route('admin.main',[
               'title'=>'Tramg quản trị'
           ]);
        }
        session()->flash('error','Thông tin hoặc mật khẩu không chính xác');
        return redirect()->back();

    }
}

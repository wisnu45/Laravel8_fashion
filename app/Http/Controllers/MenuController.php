<?php

namespace App\Http\Controllers;

use App\Http\Services\Menu\MenuService;
use Illuminate\Http\Request;

class MenuController extends Controller
{
    public function __construct(MenuService $menutService)
    {
        $this->menuService=$menutService;
    }
    public function index(Request $request,$id,$slug) {
        dd($request->input('price'));
      $menu=  $this->menuService->getMenuById($id,$request);
    
     
      $product= $this->menuService->getProductById($menu,$request);
      return view('frontend.menu',[
          'title'=>$menu->name,
          'products'=>$product
      ]);
    }
}

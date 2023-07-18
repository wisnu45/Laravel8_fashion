<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Http\Requests\Menu\CreateFormRequest;
use Illuminate\Http\Request;
use  App\Http\Services\Menu\MenuService;
use App\Models\Menu;
use Illuminate\Support\Facades\Redirect;

class MenuController extends Controller
{

    public function __construct(MenuService $menuService)
    {
        return $this->menuService=$menuService;
    }
    public function create() {
        $menu=$this->menuService->getParent();
        return view('admin.menus.add',[
            'title'=>'Thêm danh mục',
            'menu'=>$menu
        ]);
    }
    public function store(CreateFormRequest $request) {
        $result=$this->menuService->create($request);
        return redirect()->back();
    }
    public function index() {
        $menus=$this->menuService->getAll();
     // dd($menus);
        return view('admin.menus.list',[
            'title'=>'Danh sách sản phẩm',
            'menus'=>$menus
        ]);
    }
    public function destroy(Request $request) {
        $result=$this->menuService->destroy($request);
        if($result) {
            return response()->json([
                'error'=>false,
                'message'=>'Xóa danh mục thành công',
            ]);
        }
        return response()->json([
            'error'=>true,
            'message'=>'Xóa danh mục thất bại ',
        ]);
    }
    public function show(Menu $menu) {
      return view('admin.menus.edit',[
          'title'=>'Chỉnh sửa danh mục / '.$menu->name,
          'menu'=>$menu,
          'menus'=>$menus=$this->menuService->getAll()
      ]);
    }
    public function update(Menu $menu ,CreateFormRequest $request) {
        $result=$this->menuService->update($menu,$request);
        if($result)
        return Redirect()->route('admin.menu.list');
    }
}

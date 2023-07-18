<?php
namespace App\Http\Services\Menu;

use App\Http\Requests\Menu\CreateFormRequest;
use App\Models\Menu;
use PhpParser\Node\Stmt\TryCatch;

class MenuService
{

  public function getParent() {
    $menu=Menu::where('parent_id',0)->get();
    return $menu;
  }
  public function getAll() {
    return Menu::orderbyDesc('id')->get();
    
  }
    public function create(CreateFormRequest $request) {
        try {
         $menu=Menu::create([
           'name'=>(string)$request->input('name'),
           'parent_id'=>(int)$request->input('parent'),
           'description'=>(string)$request->input('description'),
           'content'=>(string)$request->input('content'),
           'active'=>(int)$request->input('active'),
         ]);
         session()->flash('success','Thêm danh mục thành công');
        } catch (\Exception $error) {
          session()->flash('error',$error->getMessage());
          return false;
        }
        return true;
    }
    public function destroy($request) {
      $id=$request->input('id');
      $menu=Menu::where('id',$id)->first();
  if($menu) {
       return Menu::where('id',$id)->orWhere('parent_id',$id)->delete();
  }
  return false;
    }
 public function update($menu,$request) {
   if($request->parent_id !=$menu->id)
  $menu->parent_id=$request->parent_id;
  $menu->name=$request->name;
  $menu->description=$request->description;
  $menu->content=$request->content;
  $menu->active=$request->active;
  $menu->save();
  session()->flash('success','Cập nhật thành công');
  return true;


 }
 public function getMenuById($id) {
       return Menu::where('id',$id)->where('active',1)->firstOrFail();
}
public function getProductById($menu,$request) {
  dd($request->input('price'));
    $query= $menu->products()->select('id','name','thumb','price','price_sale','description','content','active')
   ->where('active',1);
   if($request->input('price')) {
     $query->orderBy('price',$request->input('price'));
   }
     return $query ->orderBy('id','asc')->paginate(16);
}
}
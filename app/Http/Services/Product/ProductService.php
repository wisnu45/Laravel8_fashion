<?php
namespace App\Http\Services\Product;
use App\Models\Menu;
use App\Models\Product;
use Exception;
use Illuminate\Contracts\Session\Session;

class ProductService
{
  public function getMenu() {
      $menu=Menu::where('active',1)->get();
      return $menu;
  }
 
  protected function isValidPrice($request) {
        if($request->input('price') !=0 && $request->input('price_sale') !=0
        && ($request->input('price')  <= $request->input('price_sale') ) 
        ) {
         return false;
        }
        return true;
  }
  public function store($request) {
      $isValidPrice=$this->isValidPrice($request);
      if($isValidPrice ==false) return false;
      try {

         $request->except('_token'); //bỏ token
          $product=Product::create($request->all());
         
         Session()->flash('success','Thêm sản phẩm thành công');
         
      } catch (\Exception $err) {
        Session()->flash('error','Thêm sản phẩm thất bại');
        \logs()->info($err->getMessage());
       
        return false;
      }
      return true;
  }
  public function getProduct() {
      $product=Product::with('menu')->paginate(25);
      return $product;
  }
  public function update($product,$request) {
    $isValidPrice=$this->isValidPrice($request);
    if($isValidPrice==false){  session()->flash('error','Giá sale phải nhỏ hơn giá gốc'); return false;}
    try {
      $product->fill($request->input());
      $product->save();
      session()->flash('success','Cập nhật thành công');
       return true;
    } catch (\Exception $err) {
      session()->flash('error','Cập nhật thất bại');
      \logs()->info($err->getMessage());
      return false;
    }
   return true;
  }
  public function destroy($request) {
    $product=Product::find($request->id);
    if($product) {$product->delete(); return true;}
    return false;
    
  }
  const LIMIT =16;
  public function getProductClient($page=null) {
  //    return Product::where('active',1)->orderBy('id','ASC')
  //    ->when($page!=null,function($query) use($page) {
  //     $query->offset($page*self::LIMIT);
  // })
  //    ->LIMIT(self::LIMIT)->get();
  return Product::select('id', 'name', 'price', 'price_sale', 'thumb')
  ->orderBy('id','asc')
  ->when($page != null, function ($query) use ($page) {
      $query->offset($page * self::LIMIT);
  })
  ->limit(self::LIMIT)
  ->get();
  }
  
}
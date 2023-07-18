<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProductFormRequest;
use Illuminate\Http\Request;
use App\Http\Services\Product\ProductService;
use App\Models\Product;

class ProductController extends Controller
{

    public function __construct(ProductService $productService) {
    $this->productService=$productService;
    }
  
    public function index() {
        return view('admin.products.list',[
            'title'=>'Danh sách sản phẩm',
            'products'=>$this->productService->getProduct()
        ]);
    }
    public function add() {
        return view('admin.products.add',[
            'title'=>'Thêm sản phẩm',
            'menu'=> $this->productService->getMenu(),
        ]);
    }
    public function store(ProductFormRequest $request) {
        $result=$this->productService->store($request);
        return redirect()->back();
    }
    public function show(Product $product) {
       
        return view('admin.products.edit',[
          'title'=>'Sửa sản phẩm'.$product->id,
          'product'=>$product,
          'menu'=> $this->productService->getMenu()
        ]);
    }
    public function update(Product $product, ProductFormRequest $request) {
         $result=$this->productService->update($product,$request);
       //  dd($result);
         if($result){
         return redirect('/admin/products/list');
         }
         return redirect()->back();
    }
    public function destroy(Request $request)
    {
       $result=$this->productService->destroy($request);
       if($result) {
           return response()->json([
               'error'=>false,
               'message'=>'Xóa sản phẩm thành công'
           ]);
       }
       return response()->json([
        'error'=>true,
        'message'=>'Xóa sản phẩm thất bại'
    ]);
}
}

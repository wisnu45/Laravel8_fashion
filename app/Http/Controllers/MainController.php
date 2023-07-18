<?php

namespace App\Http\Controllers;

use App\Http\Services\Product\ProductService;
use App\Http\Services\Slider\SliderService;
use App\Models\Product;
use Illuminate\Http\Request;


class MainController extends Controller
{
    public function __construct(SliderService $sliderService,ProductService $productService)
    {
        $this->slideService=$sliderService;
        $this->productService=$productService;
    }
    public function index() {
        return view('frontend.home',[
            'title'=>'Trang chủ',
            'sliders'=> $this->slideService->show(),
            'products'=>$this->productService->getProductClient()
        ]);
    }
    public function loadProduct(Request $request) {
    //     $page=$request->input('page',0);
        
    //     $result=  $this->productService->getProductClient($page);
    //   if(count($result)!=0) {
    //       $html=view('frontend.product',[
    //           'products'=>$result
    //       ])->render();
    //       return response()->json([
    //           'html'=>$html
    //       ]);
    //   }
    //   return response()->json([
    //     'html'=>'' 
    //   ]);
    $page = $request->input('page', 0);
    $result = $this->productService->getProductClient($page);
    if (count($result) != 0) {
        $html = view('frontend.product', ['products' => $result ])->render();

        return response()->json([ 'html' => $html ]);
    }

    return response()->json(['html' => '' ]);

       
    }
    public function productPreview(Request $request) {
       
        $product=Product::where('id',$request->id)->where('active',1)->first();
        return view('frontend.productPreview',[
            'title'=>'Xem sản phẩm',
            'product'=>$product
        ]);

    }
}

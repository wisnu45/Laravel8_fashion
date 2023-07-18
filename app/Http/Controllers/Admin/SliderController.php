<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\SliderFormRequest;
use Illuminate\Http\Request;
use App\Http\Services\Slider\SliderService;
use App\Models\Slider;

class SliderController extends Controller
{
    public function __construct(SliderService $sliderService)
    {
        $this->sliderService=$sliderService;
    }
    public function add() {
        return view('admin.slider.add',[
            'title'=>'Thêm slider'
        ]);
    }
    public function store(SliderFormRequest $request) {
   $result= $this->sliderService->store($request);
 
       return redirect()->back();

    }
    public function index() {
        return view('admin.slider.list',[
            'title'=>'Danh sách slide',
            'slide'=>$this->sliderService->getAll()
        ]);
    }
    public function destroy(Request $request) {
      $result=$this->sliderService->destroy($request);
      if($result) {
          return response()->json([
              'error'=>false,
              'message'=>'Xóa slider thành công'
          ]);
      }
      return response()->json([
        'error'=>true,
        'message'=>'Xóa slider thất bại'
    ]);
    }
    public function show(Slider $slider) {
       // dd($slider);
            return view('admin.slider.edit',[
                'title'=>'Sửa slider '.$slider->name,
                'slider'=>$slider
            ]);
    }
    public function update(Slider $slider,SliderFormRequest $request) {
        $result=$this->sliderService->update($slider,$request);
        if($result) {
            return redirect('/admin/slider/list');
        }
        return redirect()->back();
    }
}

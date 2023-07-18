<?php
namespace App\Http\Services\Slider;

use App\Models\Slider;

class SliderService

{
    public function getAll() {
        return Slider::orderbyDesc('id')->get();
    }
    public function store($request) {
  // dd($request->all());
        try {
            $request->except('_token'); //bỏ token
            $slider=Slider::create($request->all());
            session()->flash('success','Thêm slider thành công');
        } catch (\Exception $err) {
            session()->flash('error','Thêm slider thất bại');
            \logs()->info($err->getMessage());
            return false;
        }
        return true;
      
      
    }
    public function destroy($request) {
        $slide=Slider::find($request->id);
        if($slide) {
            $slide->delete();
            return true;
        }
        return false;
    }
    public function update($slider,$request) {
        try {
             $slider->fill($request->all());
             $slider->save();
             session()->flash('success','Cập nhật thành công');
             return true;

        } catch (\Exception $err) {
            session()->flash('error','Cập nhật slider thất bại');
            \logs()->info($err->getMessage());
            return false;
        }
    }
    public function show($slide=null) {
        return Slider::where('active',1)->orderByDesc('sort_by')->get();
    }
    
}
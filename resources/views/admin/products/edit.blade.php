@extends('welcome')
@section('head')
<script src="../ckeditor/ckeditor.js"></script>
@endsection

@section('content')
<br/>
<form method="post" enctype="multipart/form-data">
@csrf
  <div class="form-group">
  <label ><strong>Tên danh mục<span style="color:red" >(*)</span></strong></label>
    <input type="text" class="form-control" id="name" name="name" value="{{$product->name}}" placeholder="Nhập tên danh mục">
    
  </div>
  <div class="form-group">
    <label ><strong>Danh mục <span style="color:red" >(*)</span></strong></label>
     <select class="form-control" name="category_id" id="parent">

    
     @foreach($menu as $menu)
    <option value="{{$menu->id}}"
      {{$menu->id==$product->category_id?'selected':''}}    
    >{{$menu->name}}</option>
     @endforeach
     </select>
  </div>
  <div class="form-group">
  <label ><strong>Mô tả<span style="color:red" >(*)</span></strong></label>
   <textarea class="form-control"  id="description" name="description">{{$product->description}}</textarea>
    
  </div>
  <div class="form-group">
  <label ><strong>Nội dung<span style="color:red" >(*)</span></strong></label>
   <textarea  id="contents" name="content" cols="30" rows="10">{{$product->content}}</textarea>
    
  </div>
  <div class="form-group">
      <label for="">Giá </label>
      <input class="form-control" name="price"  value="{{$product->price}}" type="number" id="price">
      
  </div>
  <div class="form-group">
      <label for="">Giá khuyến mại </label>
      <input class="form-control" type="number"  value="{{$product->price_sale}}" name="price_sale" id="price_sale">
  </div>
  <div class="form-group">
      <label for="">Ảnh </label>
      <input class="form-control" type="file" id="upload">
      <div id="show-image">
          <a href="{{$product->thumb}}">
          <img src="{{$product->thumb}}" style="max-width:100px" alt="">
          </a>
           
      </div>
      <input type="hidden" id="file" value="{{$product->thumb}}" name="thumb">
  </div>
  <div class="form-group">
    <label ><strong>Kích Hoạt <span style="color:red" >(*)</span></strong></label>
    <div class="form-check">
  <input class="form-check-input" type="radio" name="active" id="active" value="1" 
    {{$product->active==1?'checked':''}}
  >
  <label class="form-check-label" for="exampleRadios1">
    Có
  </label>
</div>
<div class="form-check">
  <input class="form-check-input" type="radio" name="active" id="noActive" value="0"
  {{$product->active==0?'checked':''}}
  >
  <label class="form-check-label" for="exampleRadios2">
    Không
  </label>
</div>
  </div>

  <button type="submit" class="btn btn-primary">Cập nhật</button>
</form>

@section('footer')
<script>
                // Replace the <textarea id="editor1"> with a CKEditor 4
                // instance, using default configuration.
                CKEDITOR.replace( 'contents' );
            </script>
@endsection
@endsection
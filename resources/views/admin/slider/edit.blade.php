@extends('welcome')

@section('content')
<br/>
<form method="post" enctype="multipart/form-data">
@csrf
  <div class="form-group">
  <label ><strong>Tên slide<span style="color:red" >(*)</span></strong></label>
    <input type="text" class="form-control" id="name" name="name" value="{{$slider->name}}" placeholder="Nhập tên danh mục">
    
  </div>

 
 
  <div class="form-group">
      <label for="">Đường dẫn </label>
      <input class="form-control" name="url"  value="{{$slider->url}}" type="text" id="url">
      
  </div>
  <div class="form-group">
      <label for=""> Sắp xếp</label>
      <input class="form-control" type="number" value="{{$slider->sort_by}}" name="sort_by" id="sort_by">
  </div>
  <div class="form-group">
      <label for="">Ảnh </label>
      <input class="form-control" type="file" id="upload">
      <div id="show-image">
          <img style="max-width:150px" src="{{$slider->thumb}}" alt="">
      </div>
      <input type="hidden" id="file" value="{{$slider->thumb}}" name="thumb">
  </div>
  <div class="form-group">
    <label ><strong>Kích Hoạt <span style="color:red" >(*)</span></strong></label>
    <div class="form-check">
  <input class="form-check-input" type="radio" name="active" id="active" value="1" checked>
  <label class="form-check-label" for="exampleRadios1">
    Có
  </label>
</div>
<div class="form-check">
  <input class="form-check-input" type="radio" name="active" id="noActive" value="0">
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
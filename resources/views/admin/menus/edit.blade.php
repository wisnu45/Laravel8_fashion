@extends('welcome')
@section('head')
<script src="../ckeditor/ckeditor.js"></script>
@endsection

@section('content')
<br/>
<form method="post">
@csrf
  <div class="form-group">
  <label ><strong>Tên danh mục<span style="color:red" >(*)</span></strong></label>
    <input type="text" class="form-control" id="name" name="name" value="{{$menu->name}}" placeholder="Nhập tên danh mục">
    
  </div>
  <div class="form-group">
    <label ><strong>Danh mục <span style="color:red" >(*)</span></strong></label>
     <select class="form-control" name="parent_id" id="parent">

     <option  value="0" {{$menu->parent_id==0 ?'selected':''}}>Danh mục cha</option>
     @foreach($menus as $menuParent)
    <option value="{{$menuParent->id}}"  {{$menu->parent_id==$menuParent->id ?'selected':''}}>{{$menuParent->name}}</option>
     @endforeach
     </select>
  </div>
  <div class="form-group">
  <label ><strong>Mô tả<span style="color:red" >(*)</span></strong></label>
   <textarea class="form-control" value=""  id="description" name="description">{{$menu->description}}</textarea>
    
  </div>
  <div class="form-group">
  <label ><strong>Nội dung<span style="color:red" >(*)</span></strong></label>
   <textarea  id="contents"  value=""name="content" cols="30" rows="10">{{$menu->content}}</textarea>
    
  </div>
  <div class="form-group">
    <label ><strong>Kích Hoạt <span style="color:red" >(*)</span></strong></label>
    <div class="form-check">
  <input class="form-check-input" type="radio" name="active"id="active" value="1" 
  {{$menu->active==1 ?'checked':''}}
  >
  <label class="form-check-label" for="exampleRadios1">
    Có
  </label>
</div>
<div class="form-check">
  <input class="form-check-input" type="radio" name="active" id="noActive" {{$menu->active==0 ?'checked':''}} value="0">
  <label class="form-check-label" for="exampleRadios2" >
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
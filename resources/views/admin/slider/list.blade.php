@extends('welcome')
@section('content')
<div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">DataTables Example</h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <div id="dataTable_wrapper" class="dataTables_wrapper dt-bootstrap4"><div class="row"><div class="col-sm-12 col-md-6"><div class="dataTables_length" id="dataTable_length"><label>Show <select name="dataTable_length" aria-controls="dataTable" class="custom-select custom-select-sm form-control form-control-sm"><option value="10">10</option><option value="25">25</option><option value="50">50</option><option value="100">100</option></select> entries</label></div></div><div class="col-sm-12 col-md-6"><div id="dataTable_filter" class="dataTables_filter"><label>Search:<input type="search" class="form-control form-control-sm" placeholder="" aria-controls="dataTable"></label></div></div></div><div class="row"><div class="col-sm-12"><table class="table table-bordered dataTable" id="dataTable" width="100%" cellspacing="0" role="grid" aria-describedby="dataTable_info" style="width: 100%;">
                                    <thead>
                                        <tr role="row">
                                            <th>ID</th>
                                            <th >Name</th>
                                        
                                            <th>Hình ảnh</th>
                                            <th>Đường dẫn</th>
                                            <th>Sắp xếp</th>
                                            <th>Trạng thái</th>
                                            <th>Tác vụ</th>
                                      
                                    </thead>
                                  
                                    <tbody>              
                                  @foreach($slide as $sli)
                                    <tr>
                                        <td>{{$sli->ID}}</td>
                                        <td>{{$sli->name}}</td>
                                        <td>
                                            <img src="{{$sli->thumb}}" alt="" style="max-width:150px">
                                        </td>
                                        <td>{{$sli->url}}</td>
                                        <td>{{$sli->sort_by}}</td>
                                        <td>{!! \App\Helpers\Helper::active($sli->active) !!}</td>
                                        <td>
                                            <a class="btn btn-primary btn-sm"
                                             href="/admin/slider/edit/{{$sli->id}}">Sửa</a>
                                            <a class="btn btn-danger btn-sm" href="javascript:void(0)"
                                            onclick="removeRow({{$sli->id}},'admin/slider/destroy')"
                                            >Xóa</a>
                                        </td>
                                    </tr>
                                  @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="row">
                            
                    </div>
@endsection
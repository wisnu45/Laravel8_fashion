@extends('welcome')
@section('content')
<div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Danh sách đơn hàng : 
                                 <span class="text-danger">{{$orders->total()}}</span></h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <div id="dataTable_wrapper" class="dataTables_wrapper dt-bootstrap4"><div class="row"><div class="col-sm-12 col-md-6"><div class="dataTables_length" id="dataTable_length"><label>Show <select name="dataTable_length" aria-controls="dataTable" class="custom-select custom-select-sm form-control form-control-sm"><option value="10">10</option><option value="25">25</option><option value="50">50</option><option value="100">100</option></select> entries</label></div></div><div class="col-sm-12 col-md-6"><div id="dataTable_filter" class="dataTables_filter"><label>Search:<input type="search" class="form-control form-control-sm" placeholder="" aria-controls="dataTable"></label></div></div></div><div class="row"><div class="col-sm-12"><table class="table table-bordered dataTable" id="dataTable" width="100%" cellspacing="0" role="grid" aria-describedby="dataTable_info" style="width: 100%;">
                                    <thead>
                                        <tr role="row">
                                            <th>ID</th>
                                            <th >Name</th>
                                          
                                            <th>Địa Chỉ</th>
                                            <th>Số Điện Thoại</th>
                                            <th>Email </th>
                                            <th>Ghi Chú</th>
                                           
                                            <th>Thời Gian</th>
                                            <th>Tác vụ</th>
                                      
                                    </thead>
                                  
                                    <tbody>              
                                  @foreach($orders as $order)
                                    <tr>
                                        <td>{{$order->id}}</td>
                                        <td>{{$order->name}}</td>
                                        <td>{{$order->address}}</td>
                                    
                                        <td>{{$order->phone}}</td>
                                        <td>{{$order->email}}</td>
                                        <td>{{$order->content}}</td>
                                        <td>{{$order->created_at}}</td>
                                      
                                       
                                        <td>
                                            <a class="btn btn-primary btn-sm"
                                            onclick="customerView({{$order->id}})"
                                             data-toggle="modal" data-target="#exampleModal"
                                             ><i class="fas fa-eye"></i></a>
                                            <a  href="javascript:void(0)"  class="btn btn-danger btn-sm"><i class="fas fa-trash-alt"></i></a>
                                        </td>
                                    </tr>
                                  @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="row">
                            
                    </div>

                 


<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Chi Tiết Đơn Hàng</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="content">
            <li>Tên Khách Hàng : <strong id="nameCustomer"></strong> </li>
            <li>Số Điện Thoại : <strong id="phoneCustomer"></strong></li>
            <li>Email : <strong id="emailCustomer"></strong></li>
            <li>Địa Chỉ : <strong id="addressCustomer"></strong></li>
            <li>Ghi Chú : <strong id="noteCustomer"></strong></li>
        </div>
        <div class="">
            <table class="table">
                <tr>
                    <thead>
                        <th>IMG</th>
                        <th>Product</th>
                        <th>Price</th>
                        <th>Quantity</th>
                        <th>Total</th>
                    </thead>
                   
                </tr>
                <tr>
                <tbody>
                        <td >
                            <img src="" width="100px" id="thumb" alt="">
                        </td>
                        <td id="product"></td>
                        <td id="price"></td>
                        <td id="quantity"></td>
                        <td id="total"></td>
                    </tbody>
                </tr>
            </table>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
       
      </div>
    </div>
  </div>
</div>

<script>
    function customerView(id) {
      //  console.log(id);
        $.get('/admin/orders/view/'+id,function(result){
            
           let name =result.customer.name;
           let phone =result.customer.phone;
           let email =result.customer.email;
           let address =result.customer.address;
           let content =result.customer.content;

           // console.log(result.customer.name);
            document.getElementById("nameCustomer").innerHTML=name;
            document.getElementById("phoneCustomer").innerHTML=phone;
           
            document.getElementById("emailCustomer").innerHTML=email;
            document.getElementById("addressCustomer").innerHTML=address;
            document.getElementById("noteCustomer").innerHTML=content;
            const carts=result.carts;
            carts.forEach(myFunction);
            function myFunction(item,index) {
             // console.log(carts);
            
             let qty=item.qty;
            let price=item.price;
            let product=item.product.name;
            let thumb=item.product.thumb;
            let total=qty*price;
           // console.log(thumb);
             $("#thumb").attr("src",thumb);
             // document.getElementById("thumb").innerHTML=" ";
              document.getElementById("product").innerHTML=product;
              document.getElementById("price").innerHTML=price;
              document.getElementById("quantity").innerHTML=qty;
              document.getElementById("total").innerHTML=total;
            }
           
           
            
        });
            
        
    }
</script>

@endsection
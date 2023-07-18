$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});
function removeRow(id,url) {
    if(confirm("Bạn có muốn xóa danh mục này ? "))
    {
   $.ajax( {
      type:'DELETE',
      dataType:'json',
      data: {
          id:id
      },
      url:url,
      success:function(result) {
        if(result.error==false) {
            alert(result.message);
            location.reload();
        }
        else {
       alert("Xóa danh mục thất bại ");
        }
      }
     
   }
   )}
    
}
//upload
$('#upload').change(function() {
  
    const form= new FormData();
    form.append('file',$(this)[0].files[0]);
    $.ajax({
        url:'/admin/upload/service',
        method: "post",
        data:form,
       dataType:'JSON',
        processData: false,
        contentType: false,
        success:function(result) {
        if(result.error==false) {
            $('#show-image').html('<a href="'+result.url+'"><img src="'+result.url+'" width="150px" ></a>');
            $('#file').val(result.url);
        }
        }
    })
})
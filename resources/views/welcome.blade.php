<!DOCTYPE html>
<html lang="en">

<head>

  @include('admin.header')

</head>


<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
      @include('admin.sidebar')
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">
        
                <!-- Topbar -->
              @include('admin.topbar')
                <!-- End of Topbar -->
                <div class="container-fluid">
                  @include('admin.alert')
                <div class="row">
                   <div class="col-md-12">
                       <div  class="card card-primary mt-1 " style="background-color:#000">
                          <div style="padding:0" class="card-header ">
                              <h3 style="padding:0; line-height:center" class="card-title">{{$title}}</h3>
                          </div>
                       </div>
                   </div>
               </div>
                <!-- Begin Page Content -->
                @yield('content');
                <!-- /.container-fluid -->
                </div>
               
               

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
          @include('admin.footer')

</body>

</html>
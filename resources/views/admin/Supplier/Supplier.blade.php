<!DOCTYPE html>
<html>
@include("admin.style.css")

<body id="page-top">
   <!-- Page Wrapper -->
   <div id="wrapper">
      @include("admin.layouts.sidebar")
      <!-- Content Wrapper -->
      <div id="content-wrapper" class="d-flex flex-column">

         <!-- Main Content -->
         <div id="content">

            @include("admin.layouts.topbar")

            <!-- Begin Page Content -->
            <div class="container-fluid">
               <!-- Page Heading -->
               <h1 class="h3 mb-2 text-gray-800">Insert Products</h1>
               <div class="card shadow mb-4">
                  <div class="card-body">
                     <div class="table-responsive">
                        <form action="{{route('ad.supadd')}}" method="POST" enctype="multipart/form-data">
                           @csrf
                           <div class="form-group">
                              <label for="exampleInputEmail1">Name Supplier</label>
                              <input type="text" class="form-control" id="exampleInputEmail1"
                                 aria-describedby="emailHelp" placeholder="Enter Product..." name="name_supplier" value="{{ old('name_supplier') }}">
                              @error('name_supplier')
                              <span style="color:red;">{{$message}}</span>
                              @enderror
                           </div>
                           <div class="form-group">
                              <label for="exampleInputPassword1">Email</label>
                              <input type="email" class="form-control" id="exampleInputPassword1" placeholder="Email..."
                                 name="email" value="{{ old('email') }}">
                              @error('email')
                              <span style="color:red;">{{$message}}</span>
                              @enderror
                           </div>
                           <div class="form-group">
                              <label for="exampleInputPassword1">Phone Number</label>
                              <input type="number" class="form-control" id="exampleInputPassword1"
                                 placeholder="Phone Number..." name="phone" value="{{ old('phone') }}">
                              @error('phone')
                              <span style="color:red;">{{$message}}</span>
                              @enderror
                           </div>
                           <button type="submit" class="btn btn-primary">Submit</button>
                           <a class="btn btn-primary" href="{{route('ad.details')}}" role="button"
                              aria-controls="offcanvasExample">Back To Product Details</a>
                        </form>
                     </div>
                  </div>
               </div>
            </div>
            <!-- /.container-fluid -->

         </div>
         <!-- End of Main Content -->

         <!-- Footer -->
         @include("admin.layouts.footer")
         <!-- End of Footer -->

      </div>
      <!-- End of Content Wrapper -->
   </div>
   <!-- End of Page Wrapper -->
   <!-- Scroll to Top Button-->
   <a class="scroll-to-top rounded" href="#page-top">
      <i class="fas fa-angle-up"></i>
   </a>
   <!-- Logout Modal-->
   @include('admin.login.logout')
   @include("admin.style.boostrap")
</body>

</html>
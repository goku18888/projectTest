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
                               <form action="{{route('ad.typeadd')}}" method="POST" enctype="multipart/form-data">
                                 @csrf
                                  {{-- <div class="form-group">
                                    <label for="exampleInputPassword1">More Picture Product</label>
                                    <input type="file" class="form-control" id="exampleInputPassword1" placeholder="Pictures..." name="imgs_product">
                                  </div> --}}
                                  <div class="form-group">
                                    <label for="exampleInputEmail1">Name Products</label>
                                    <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter Product..." name="name_producttype">
                                    @error('name_producttype')
                                    <span style="color:red;">{{$message}}</span>
                                    @enderror
                                  </div>
                                  <div class="form-group">
                                    <label for="exampleInputPassword1">Name Suppilier</label>
                                    <select name="supplier_id" class="form-control">   
                                       @foreach ($suppliers as $supplier)
                                          <option value="{{ $supplier->id }}">
                                             {{$supplier->name_supplier}}
                                          </option>
                                       @endforeach
                                    </select>
                                  </div>
                                  <button type="submit" class="btn btn-primary">Submit</button>
                                  <a class="btn btn-primary" href="{{route('ad.detail')}}" role="button" aria-controls="offcanvasExample">Back To Product Details</a>
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
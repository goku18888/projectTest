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
                        <form action="{{route('ad.processadd')}}" method="POST" enctype="multipart/form-data">
                           @csrf
                           <div class="form-group">
                              <label for="exampleInputEmail1">Name Products</label>
                              <input type="text" class="form-control" id="exampleInputEmail1"
                                 aria-describedby="emailHelp" placeholder="Enter Product..." name="name_product" value="{{ old('name_product') }}">
                              @error('name_product')
                              <span style="color:red;">{{$message}}</span>
                              @enderror
                           </div>
                           <div class="form-group">
                              <label for="exampleInputPassword1">Old Price</label>
                              <input type="number" class="form-control" id="exampleInputPassword1"
                                 placeholder="Bought Price..." name="old_price" value="{{ old('old_price') }}">
                              @error('old_price')
                              <span style="color:red;">{{$message}}</span>
                              @enderror
                           </div>
                           <div class="form-group">
                              <label for="exampleInputPassword1">Price products</label>
                              <input type="number" class="form-control" id="exampleInputPassword1"
                                 placeholder="Price..." name="price_product" value="{{ old('price_product') }}">
                              @error('price_product')
                              <span style="color:red;">{{$message}}</span>
                              @enderror
                           </div>
                           <div class="form-group">
                              <label for="exampleInputPassword1">Quantity</label>
                              <input type="number" class="form-control" id="exampleInputPassword1"
                                 placeholder="Quantity..." name="amount" value="{{ old('amount') }}">
                              @error('amount')
                              <span style="color:red;">{{$message}}</span>
                              @enderror
                           </div>
                           <div class="form-group">
                              <label for="exampleInputPassword1">Description</label>
                              <input type="text" class="form-control" id="exampleInputPassword1"
                                 placeholder="Description..." name="depscribe" value="{{ old('depscribe') }}">
                              @error('depscribe')
                              <span style="color:red;">{{$message}}</span>
                              @enderror
                           </div>
                           <div class="form-group">
                              <label for="exampleInputPassword1">Main Picture Product</label>
                              <input type="file" class="form-control" id="exampleInputPassword1"
                                 placeholder="Picture..." name="img_product" value="{{ old('img_product') }}">
                              @error('img_product')
                              <span style="color:red;">{{$message}}</span>
                              @enderror
                           </div>
                           <div class="form-group">
                              <label for="exampleInputPassword1">More Picture Product</label>
                              <input type="file" class="form-control" id="exampleInputPassword1"
                                 placeholder="Pictures..." name="imgs_product[]" accept="image/*" multiple >
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
                           <div class="form-group">
                              <label for="exampleInputPassword1">Name Producttype</label>
                              <select name="producttype_id" class="form-control">
                                 @foreach ($producttypes as $product)
                                 <option value="{{ $product->id }}">
                                    {{$product->name_producttype}}
                                 </option>
                                 @endforeach
                              </select>
                           </div>
                           <button type="submit" class="btn btn-primary">Submit</button>
                           <a class="btn btn-primary" href="{{ route('ad.detail') }}" role="button"
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
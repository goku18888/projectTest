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
        <h2>Images For Products:<span class="text-primary">{{ $product->name_product }}</span></h2>
        <a href="{{ route('ad.detail') }}" class="btn btn-primary">Go Back</a>
        <div class="row mt-4">
          @foreach ($imageProduct as $key=>$item)
              <div class="col-md-3">
                <div class="card text-white bg-secondary mb-3" style="max-width:20rem;">
                  <div class="card-body">
                    <img src="/product_images/{{ $item->imgs_product }}" class="card-img-top">
                  </div>
                </div>
              </div>
          @endforeach
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
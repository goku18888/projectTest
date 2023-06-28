<!DOCTYPE html>
<html>
@include('admin.style.css')
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
                @include("admin.prodtype.view")
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

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

                @include("admin.layouts.topbar", ['messages' => $messages])

                <!-- Begin Page Content -->
                @include("admin.CRUD.view")
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
<script>
    $('.dropdown-item-thread').click(function () {
        $(this).find('.status-indicator').removeClass('bg-success').addClass('status-indicator')
        const id = $(this).find('.status-indicator').data('id')
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: '{{ route("ad.updateStatus") }}',
            type: 'POST',
            data: {
                id
            }
        }).done(function() {
            $( this ).addClass( "done" );
        });
    })
</script>
</html>

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

                @include("admin.comment.topbar", ['messages' => $messages])

                <!-- Begin Page Content -->
                <div class="container-fluid">
                    <!-- Page Heading -->
                    <h1 class="h3 mb-2 text-gray-800" style="text-align: center">Them Van Chuyen</h1>
                    <div class="notify_comment"></div>
                    <!--  <p class="mb-4">DataTables is a third party plugin that is used to generate the demo table below.
          For more information about DataTables, please visit the <a target="_blank"
              href="https://datatables.net">official DataTables documentation</a>.</p> -->

                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-body">
                            <div class="table-responsive" style="text-align: center;background-color: antiquewhite;">
                                <form action="">
                                    @csrf
                                    <div class="form-group">
                                        <label for="">Chọn Thành Phố</label>
                                        <select name="city" id="city" class="choose city">
                                            <option value="">>---Chọn Thành Phố---<</option>
                                            @foreach ($city as $item)
                                                <option value="{{ $item->matp }}">{{ $item->name_city }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="">Chọn Quận Huyện</label>
                                        <select name="province" id="province" class="choose province">
                                            <option value="">>---Chọn Quận Huyện---<</option>
                                            @foreach ($province as $provin)
                                                <option value="{{ $provin->maqh }}">{{ $provin->name_quanhuyen }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="">Chọn Xã Phường</label>
                                        <select name="wards" id="wards" class="wards">
                                            <option value="">>---Chọn Xã Phường---<</option>
                                            @foreach ($wards as $ward)
                                                <option value="{{ $ward->xaid }}">{{ $ward->name_xaphuong }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="">Phí Vận Chuyển</label>
                                        <input type="text" name="fee_ship" class="fee_ship">
                                    </div>
                                    <button type="button" name="add_delivery" class="btn btn-info add_delivery">Thêm Phí Vận Chuyển</button>
                                </form>
                            </div>
                            <div id="load_delivery"></div>
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
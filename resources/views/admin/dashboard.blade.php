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
                <div class="container-fluid">
                    <div class="row">
                        <p class="title_thongke">thong ke don hang doanh so</p>
                        <form autocomplete="off">
                            @csrf
                            <div class="row">
                                <div class="col-md-2">
                                    <p>Tu Ngay:<input type="text" id="datepicker" class="form-control"></p>
                                    <input type="button" id="btn-dashboard-filter" class="btn btn-primary btn-sm" value="Loc ket qua">
                                </div>
                                <div class="col-md-2">
                                    <p>Den ngay:<input type="text" id="datepicker2" class="form-control"></p>
                                </div>
                                <div class="col-md-2">
                                    <p>
                                        Loc Theo:
                                        <select class="dashboard-filter form-control">
                                            <option>---chon--</option>
                                            <option value="7ngay">7 ngay qua</option>
                                            <option value="thangtruoc">thang truoc</option>
                                            <option value="thangnay">thang nay</option>
                                            <option value="365ngayqua">365ngayqua</option>
                                        </select>
                                    </p>
                                </div>
                            </div>
                        </form>
                        <div class="col-md-12">
                            <div id="myfirstchart" style="height: 250px;"></div>
                        </div>
                    </div>
                    <div class="row">
                        <p class="title_thongke">Thong Ke Truy Cap Vao Trang Web</p>
                        <table class="table table-dark">
                            <thead>
                              <tr>
                                <th scope="col">dang online</th>
                                <th scope="col">tong thang truoc</th>
                                <th scope="col">tong thang nay</th>
                                <th scope="col">tong mot nam truy cap</th>
                                <th scope="col">tong truy cap vao trang web</th>
                              </tr>
                            </thead>
                            <tbody>
                              <tr>
                                <td>{{ $visitor_count }}</td>
                                <td>{{ $visitor_last_month_count }}</td>
                                <td>{{ $visitor_this_month_count }}</td>
                                <td>{{ $visitor_year_count }}</td>
                                <td>{{ $visitors_total }}</td>
                              </tr>
                            </tbody>
                          </table>
                    </div>
                    <div class="row">
                        <div class="col-md-4 col-xs-12">
                            <p class="title_thongke">Tong San Pham Bai Viet Don Hang</p>
                            <div id="donut" class="morris-donut-inverse"></div>
                        </div>
                        <div class="col-md-4 col-xs-12">
                            <h3>San Pham Xem Nhieu</h3>
                            <ol>
                                @foreach ($product_views as $key => $pro)
                                    <li>
                                        <a target="_blank" href="{{ url('user/detail/'.$pro->id.'') }}">{{$pro->name_product}} | <span>{{ $pro->product_views }}</span></a>
                                    </li>
                                @endforeach
                            </ol>
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
<script>
    $(function() {
        $( "#datepicker" ).datepicker({
            prevText:"Tháng Trước",
            nextText:"Tháng Trước",
            dateFormat:"yy-mm-dd",
            dayNamesMin:["Thứ 2","Thứ 3","Thứ 4","Thứ 5","Thứ 6","Thứ 7","Chủ Nhật"],
            duration:"slow"
        });
        $( "#datepicker2" ).datepicker({
            prevText:"Tháng Trước",
            nextText:"Tháng Trước",
            dateFormat:"yy-mm-dd",
            dayNamesMin:["Thứ 2","Thứ 3","Thứ 4","Thứ 5","Thứ 6","Thứ 7","Chủ Nhật"],
            duration:"slow"
        });
    });
</script>
<script>
$(document).ready(function(){
    chart30daysorder();

    var chart=new Morris.Bar({
        element:'myfirstchart',
        lineColors:['#819C79','#fc8710','#FF6541','#A4ADD3','#766856'],
        parseTime:false,
        xkey:'period',
        ykeys:['order','sales','quantity'],
        labels:['don hang','doanh so','so luong']
    });

    function chart30daysorder(){
        var _token=$('input[name="_token"]').val();
        $.ajax({
            url:"{{ url('/admin/days-order') }}",
            method:"POST",
            dataType:'JSON',
            data:{_token:_token},
            success:function(data){
                chart.setData(data);
            }
        });
    }
    
    $('.dashboard-filter').change(function(){
        var dashboard_value=$(this).val();
        var _token=$('input[name="_token"]').val();
        $.ajax({
            url:"{{ url('/admin/dashboard-filter') }}",
            method:"POST",
            dataType:'JSON',
            data:{dashboard_value:dashboard_value,_token:_token},
            success:function(data){
                chart.setData(data);
            }
        });
    });

    $('#btn-dashboard-filter').click(function(){
        var _token=$('input[name="_token"]').val();
        var from_date=$('#datepicker').val();
        var to_date=$('#datepicker2').val();
        $.ajax({
            url:"{{ url('/admin/filter-by-date') }}",
            method:"POST",
            dataType:'JSON',
            data:{from_date:from_date,to_date:to_date,_token:_token},
            success:function(data){
                chart.setData(data);
            }
        });
    });
});
</script>
<script>
$(document).ready(function(){

    var donut = Morris.Donut({
        element: 'donut',
        resize: true,
        colors: [
            '#E0F7FA',
            '#B2EBF2',
            '#80DEEA',
            '#4DD0E1',
            '#26C6DA',
        ],
    //labelColor:"#cccccc", // text color
    //backgroundColor: '#333333', // border color
        data: [
            {label:"San Pham", value:<?php echo $product ?>},
            {label:"Hoa Don", value:<?php echo $bill ?>},
            {label:"Khach Hang", value:<?php echo $customer ?>}
        ]
    }); 
});
</script>
</html>
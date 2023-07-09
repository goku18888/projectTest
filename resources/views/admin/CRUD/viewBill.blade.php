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

                <!-- Topbar -->
<nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">
  <!-- Sidebar Toggle (Topbar) -->
  <form class="form-inline">
      <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
          <i class="fa fa-bars"></i>
      </button>
  </form>
  <!-- Topbar Search -->
  <form class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
      <div class="input-group">
          <input type="search" name="search-bill" class="form-control bg-light border-0 small" placeholder="Search for..."
              aria-label="Search" aria-describedby="basic-addon2" value="{{ $search }}">
          <div class="input-group-append">
              <button class="btn btn-primary" type="submit">
                  <i class="fas fa-search fa-sm"></i>
              </button>
          </div>
          <!-- Topbar Menu Sidebar Button -->
          <a class="btn btn-primary" data-bs-toggle="offcanvas" href="#offcanvasExample" role="button"
              aria-controls="offcanvasExample">
              Left Menu
          </a>
      </div>
  </form>

  <!-- Topbar Navbar -->
  <ul class="navbar-nav ml-auto">

      <!-- Nav Item - Search Dropdown (Visible Only XS) -->
      <li class="nav-item dropdown no-arrow d-sm-none">
          <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button" data-toggle="dropdown"
              aria-haspopup="true" aria-expanded="false">
              <i class="fas fa-search fa-fw"></i>
          </a>
          <!-- Dropdown - Messages -->
          <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in"
              aria-labelledby="searchDropdown">
              <form class="form-inline mr-auto w-100 navbar-search">
                  <div class="input-group">
                      <input type="text" class="form-control bg-light border-0 small" placeholder="Search for..."
                          aria-label="Search" aria-describedby="basic-addon2">
                      <div class="input-group-append">
                          <button class="btn btn-primary" type="button">
                              <i class="fas fa-search fa-sm"></i>
                          </button>
                      </div>
                  </div>
              </form>
          </div>
      </li>

        <!-- Nav Item - Alerts -->
        <li class="nav-item dropdown no-arrow mx-1">
            <a class="nav-link dropdown-toggle" href="#" id="alertsDropdown" role="button" data-toggle="dropdown"
                aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-bell fa-fw"></i>
                <!-- Counter - Alerts -->
                <span class="badge badge-danger badge-counter">{{ count($billsenger) }}</span>
            </a>
            <!-- Dropdown - Alerts -->
            <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in"
                aria-labelledby="alertsDropdown">
                <h6 class="dropdown-header">
                    Bill Order Nearlest
                </h6>
                @foreach ($billsenger as $bills)
                    <a class="dropdown-item d-flex align-items-center dropdown-item-bill" href="{{ url('/admin/bill-user/'.$bills->customer_id) }}" target="_blank">
                        <div class="mr-3">
                            <img class="rounded-circle" src="{{ asset('/storage/'.$bills->img_customer) }}" alt="..." style="width: 50px;">
                            <div class="status-indicators bg-success" data-id="{{ $bills->id }}"></div>
                        </div>
                        <div>
                            <div class="small text-gray-500">{{ $bills->total_money }}</div>
                            <span class="font-weight-bold">{{ $bills->name_customer}} . {{ $bills->order_date }}</span>
                        </div>
                    </a>
                @endforeach
                <a class="dropdown-item text-center small text-gray-500" href="#">Show All Alerts</a>
            </div>
        </li>

      <!-- Nav Item - Messages -->
      <li class="nav-item dropdown no-arrow mx-1">
          <a class="nav-link dropdown-toggle" href="#" id="messagesDropdown" role="button" data-toggle="dropdown"
              aria-haspopup="true" aria-expanded="false">
              <i class="fas fa-envelope fa-fw"></i>
              <!-- Counter - Messages -->
              <span class="badge badge-danger badge-counter">{{ count($messages) }}</span>
          </a>
          <!-- Dropdown - Messages -->
          <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in messages-thread"
              aria-labelledby="messagesDropdown">
              <h6 class="dropdown-header">
                  Message Center
              </h6>
              @foreach ($messages as $item)
                  <a class="dropdown-item d-flex align-items-center dropdown-item-thread" href="https://mail.google.com/mail/u/0/#inbox" target="_blank">
                      <div class="dropdown-list-image mr-3">
                          <img class="rounded-circle" src="img/undraw_profile_1.svg" alt="...">
                          <div class="status-indicator bg-success" data-id="{{ $item->id }}"></div>
                          
                      </div>
                      <div class="font-weight-bold">
                          <div class="text-truncate">{{ $item->subject }}</div>
                          <div class="small text-gray-500">{{ $item->name_customer }} · {{ $item->created_at }}</div>
                      </div>
                  </a>
              @endforeach
              <a class="dropdown-item text-center small text-gray-500" href="#">Read More Messages</a>
          </div>
      </li>

      <div class="topbar-divider d-none d-sm-block"></div>

      <!-- Nav Item - User Information -->
      <li class="nav-item dropdown no-arrow">
          <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown"
              aria-haspopup="true" aria-expanded="false">
              <span class="mr-2 d-none d-lg-inline text-gray-600 small">{{ session()->get('name_admin') }}</span>
              <img class="img-profile rounded-circle" src="{{ asset('/storage/'.session()->get('avatar')) }}">
          </a>
          <!-- Dropdown - User Information -->
          <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
              <a class="dropdown-item" href="{{ route('ad.profile') }}">
                  <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                  Profile
              </a>
              {{-- <a class="dropdown-item" href="#">
                  <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
                  Settings
              </a> --}}
              <a class="dropdown-item" href="#">
                  <i class="fas fa-list fa-sm fa-fw mr-2 text-gray-400"></i>
                  Activity Log
              </a>
              <div class="dropdown-divider"></div>
              <a class="dropdown-item" href="{{ route('ad.logout') }}" data-toggle="modal" data-target="#logoutModal">
                  <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                  Logout
              </a>
          </div>
      </li>

  </ul>
</nav>

<!-- End of Topbar -->

                <!-- Begin Page Content -->
<div class="container-fluid">
    @if (session('success'))
        <div class="alert alert-dismissible alert-success">
          <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
          <h4 class="alert-heading">Success!!</h4>
          <p class="mb-0">New products was addded success</p>
        </div>
    @endif
    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Products</h1>
    <!--  <p class="mb-4">DataTables is a third party plugin that is used to generate the demo table below.
          For more information about DataTables, please visit the <a target="_blank"
              href="https://datatables.net">official DataTables documentation</a>.</p> -->
  
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="notify_status"></div>
        <div id="notify_addCart"></div>
      <div class="card-body">
        <div class="table-responsive">
          <table class="table table-hover" id="dataTable" width="100%" cellspacing="0">
            <thead>
              <tr>
                <th>ID Bill</th>
                <th>Customer Id</th>
                <th>Total Money</th>
                <th>Status</th>
                <th>Reason</th>
                <th>Status Ship</th>
                <th>Code Ship</th>
                <th>Time</th>
                <th colspan="3">Settings</th>
  
              </tr>
            </thead>
            <tfoot>
              <tr>
                <th>ID Order</th>
                <th>Customer Id</th>
                <th>Total Money</th>
                <th>Status</th>
                <th>Reason</th>
                <th>Status Ship</th>
                <th>Code Ship</th>
                <th>Time</th>
                <th colspan="3">Settings</th>
              </tr>
            </tfoot>
            <tbody>
              @forelse ($bill as $key =>$item)
              <tr>
                <td>{{$item->id}}</td>
                <td>{{$item->customer_id}}</td>
                <td>{{ number_format($item->total, 0, ',', '.') }} VND</td>
                <td>
                @if ( $item->order_status===0 )
                    Đang xử lý hàng
                @elseif( $item->order_status===1 )
                    <p class="text text-primary">Đang vận chuyển</p>
                @elseif( $item->order_status===2 )
                    <p class="text text-success">Đã Giao Hàng</p>
                @else
                    <p class="text text-danger">Khách Hàng Hủy Hàng</p>
                @endif</td>
                <td>{{$item->destroy}}</td>
                <td>
                    @if ($item->shipping_status===0)
                        <p class="text text-primary">Thanh Toán Bằng Tiền Mặt</p>
                    @else
                        <p class="text text-success">Thanh Toán Bằng Thẻ PayPal</p>
                    @endif
                </td>
                <td contenteditable data-order_id="{{$item->id}}" class="code_ship_edit">{{$item->code_ship}}</td>
                <td>{{$item->created_at}}</td>
                <td><a target="_blank" href="{{ route('ad.print_bill',['id'=>$item->id]) }}">PDF</a></td>
                <td><a href="{{route('ad.billDetails',['id'=>$item->id]) }}" class="btn btn-primary">Chi Tiết</a></td>
                <td>
                    @if ($item->order_status==0)
                        <input type="button" data-order_status="1" data-order_id="{{ $item->id }}" id="{{ $item->customer_id }}" class="btn btn-danger btn-xs status_order_btn" value="Đang Vận Chuyển Hàng">
                    @elseif($item->order_status==1)
                        <input type="button" data-order_status="2" data-order_id="{{ $item->id }}" id="{{ $item->customer_id }}" class="btn btn-success btn-xs status_order_btn" value="Đã Giao Hàng">
                    {{-- @elseif($item->order_status==2)
                        <input type="button" data-order_status="1" data-order_id="{{ $item->id }}" id="{{ $item->customer_id }}" class="btn btn-primary btn-xs status_order_btn" value="Đang Vận Chuyển Hàng"> --}}
                    @endif
                </td>
                {{-- <td>
                  {{-- <a href="{{ route('ad.add') }}">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                      class="bi bi-bag-plus-fill" viewBox="0 0 16 16">
                      <path fill-rule="evenodd"
                        d="M10.5 3.5a2.5 2.5 0 0 0-5 0V4h5v-.5zm1 0V4H15v10a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2V4h3.5v-.5a3.5 3.5 0 1 1 7 0zM8.5 8a.5.5 0 0 0-1 0v1.5H6a.5.5 0 0 0 0 1h1.5V12a.5.5 0 0 0 1 0v-1.5H10a.5.5 0 0 0 0-1H8.5V8z" />
                    </svg>
                  </a>
                  <a href="{{ route('ad.edit',['id'=>$item->id]) }}"><svg xmlns="http://www.w3.org/2000/svg" width="16"
                      height="16" fill="currentColor" class="bi bi-gear-wide" viewBox="0 0 16 16">
                      <path
                        d="M8.932.727c-.243-.97-1.62-.97-1.864 0l-.071.286a.96.96 0 0 1-1.622.434l-.205-.211c-.695-.719-1.888-.03-1.613.931l.08.284a.96.96 0 0 1-1.186 1.187l-.284-.081c-.96-.275-1.65.918-.931 1.613l.211.205a.96.96 0 0 1-.434 1.622l-.286.071c-.97.243-.97 1.62 0 1.864l.286.071a.96.96 0 0 1 .434 1.622l-.211.205c-.719.695-.03 1.888.931 1.613l.284-.08a.96.96 0 0 1 1.187 1.187l-.081.283c-.275.96.918 1.65 1.613.931l.205-.211a.96.96 0 0 1 1.622.434l.071.286c.243.97 1.62.97 1.864 0l.071-.286a.96.96 0 0 1 1.622-.434l.205.211c.695.719 1.888.03 1.613-.931l-.08-.284a.96.96 0 0 1 1.187-1.187l.283.081c.96.275 1.65-.918.931-1.613l-.211-.205a.96.96 0 0 1 .434-1.622l.286-.071c.97-.243.97-1.62 0-1.864l-.286-.071a.96.96 0 0 1-.434-1.622l.211-.205c.719-.695.03-1.888-.931-1.613l-.284.08a.96.96 0 0 1-1.187-1.186l.081-.284c.275-.96-.918-1.65-1.613-.931l-.205.211a.96.96 0 0 1-1.622-.434L8.932.727zM8 12.997a4.998 4.998 0 1 1 0-9.995 4.998 4.998 0 0 1 0 9.996z" />
                    </svg>
                  </a>
                </td> --}}
                <td>
                  <form action="{{ route('ad.billDelete',['id'=>$item->id]) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button onclick="return confirm('Xóa Đơn Hàng Này ?')"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                        class="bi bi-trash-fill" viewBox="0 0 16 16">
                        <path
                          d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1H2.5zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5zM8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5zm3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0z" />
                      </svg></button>
                  </form>
                </td>
              </tr>
              @empty
                <tr>
                  <td colspan="11" class="text-center">No products purchar yet!</td>
                </tr>
              @endforelse
            </tbody>
          </table>
          {{ $bill->links() }}
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
<script>
    $('.status_order_btn').click(function(){
        var status = $(this).data('order_status');
        var order_id = $(this).data('order_id');
        var customer_id = $(this).attr('id');
        var confirmationMessage = '';
        
        if (status == 1) {
            confirmationMessage = 'Bạn có chắc chắn muốn chuyển thành trạng thái "Đang Giao Hàng"?';
        } else {
            confirmationMessage = 'Bạn có chắc chắn muốn chuyển thành trạng thái "Nhận Hàng"?';
        }
        
        if (confirm(confirmationMessage)) {
            $.ajax({
                type: "POST",
                url: "{{ url('/admin/status-change') }}",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: {status: status, order_id: order_id, customer_id: customer_id},
                success: function(data) {
                    location.reload();
                    var alertMessage = (status == 1) ? 'Đã Chuyển Thành Đang Giao Hàng' : 'Đã Chuyển Thành Nhận Hàng';
                    $('#notify_addCart').html('<span class="text text-success">' + alertMessage + '</span>');
                },
                error: function(xhr, status, error) {
                    console.log(xhr.responseText); // Hiển thị lỗi chi tiết trong console
                }
            });
        }
    });
</script>
<script>
    $(document).on('blur','.code_ship_edit',function(){
      var order_id=$(this).data('order_id');
      var order_value=$(this).text();
      var _token=$('input[name="_token"]').val();
      $.ajax({
        url:"{{url('/admin/update-code-delivery') }}",
        method:"POST",
        data:{order_value:order_value,order_id:order_id,_token:_token},
        success:function(data){
          location.reload();
        }
      });
    });    
</script>

</body>
</html>

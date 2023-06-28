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
    <div class="card">
        <div class="card-body">
          <div class="container mb-5 mt-3">
            <div class="row d-flex align-items-baseline">
              <div class="col-xl-9">
                <p style="color: #7e8d9f;font-size: 20px;">Đơn Hàng >> <strong>{{ $detail->id }}</strong></p>
              </div>
               <div class="col-xl-3 float-end">
                <a href="{{ route('us.profile') }}" class="btn btn-light text-capitalize border-0" data-mdb-ripple-color="dark"><i
                    class="fas text-primary">Back</i> </a>
                {{--<a class="btn btn-light text-capitalize" data-mdb-ripple-color="dark"><i
                    class="far fa-file-pdf text-danger"></i> Export</a>--}}
              </div>
              <hr>
            </div>
      
            <div class="container">
              <div class="col-md-12">
                <div class="text-center">
                  <i class="fab fa-mdb fa-4x ms-0" style="color:#5d9fc5 ;"></i>
                  <p class="pt-0">Shop</p>
                </div>
      
              </div>
      
      
              <div class="row">
                <div class="col-xl-8">
                  <ul class="list-unstyled">
                    <li class="text-muted">Đến: <span style="color:#5d9fc5 ;">{{ $detail->name_customer }}</span></li>
                    @if ($detail->shipping_address)
                      <li class="text-muted">{{ $detail->shipping_address }}</li>
                    @else
                      <li class="text-muted">{{ $detail->address }}</li>
                    @endif
                    <li class="text-muted"><i class="fas fa-phone"></i> {{ $detail->phone }}</li>
                  </ul>
                </div>
                <div class="col-xl-4">
                  <p class="text-muted">Đơn Hàng</p>
                  <ul class="list-unstyled">
                    <li class="text-muted"><i class="fas fa-circle" style="color:#84B0CA ;"></i> <span
                        class="fw-bold">Mã Đơn Hàng:</span>{{ $detail->id }}</li>
                    <li class="text-muted"><i class="fas fa-circle" style="color:#84B0CA ;"></i> <span
                        class="fw-bold">Thời Gian Mua: </span>{{ $detail->created_at }}</li>
                    <li class="text-muted"><i class="fas fa-circle" style="color:#84B0CA ;"></i> <span
                        class="me-1 fw-bold">Trạng Thái:</span>
                        <span class="badge bg-warning text-black fw-bold">
                          @if ( $detail->status===0 )
                              Đang xử lý hàng
                          @elseif( $detail->status===1 )
                              <p>Đang vận chuyển</p>
                          @elseif( $detail->status===2 )
                              <p>Đã Giao Hàng</p>
                          @else
                              <p>Khách Hàng Hủy Hàng</p>
                          @endif
                        </span>
                    </li>
                  </ul>
                </div>
              </div>
      
              <div class="row my-2 mx-1 justify-content-center">
                <table class="table table-striped table-borderless">
                  <thead style="background-color:#84B0CA ;" class="text-white">
                    <tr>
                      <th scope="col">#</th>
                      <th scope="col">Tên Sản Phẩm</th>
                      <th scope="col">Số Lượng</th>
                      <th scope="col">Giá Sản Phẩm</th>
                      <th scope="col">Tiền Ship</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($bill as $item)
                    <tr>
                      <td>{{ $item->id }}</td>
                      <td>{{ $item->name_product }}</td>
                      <td>{{ $item->total_product }}</td>
                      <td>{{ number_format($item->price_product, 0, ',', '.') }} VND</td>
                      <td>{{ number_format($item->money_ship, 0, ',', '.') }} VND</td>
                    </tr>                       
                    @endforeach
                  </tbody>
                  <tfoot>
                    <tr>
                      <th>Tổng Tiền :</th>
                      <td>{{ number_format($item->total , 0, ',', '.') }} VND</td>
                    </tr>
                  </tfoot>
                </table>
              </div>
              {{-- <div class="row">
                <div class="col-xl-8">
                  <p class="ms-3">Add additional notes and payment information</p>
      
                </div>
                <div class="col-xl-3">
                  <ul class="list-unstyled">
                    <li class="text-muted ms-3"><span class="text-black me-4">SubTotal</span>$1110</li>
                    <li class="text-muted ms-3 mt-2"><span class="text-black me-4">Tax(15%)</span>$111</li>
                  </ul>
                  <p class="text-black float-start"><span class="text-black me-3"> Total Amount</span><span
                      style="font-size: 25px;">$1221</span></p>
                </div>
              </div> --}}
              <hr>
              <div class="row">
                <div class="col-xl-10">
                  <p>Hóa Đơn Khách Hàng</p>
                </div>
                {{-- <div class="col-xl-2">
                  <button type="button" class="btn btn-primary text-capitalize"
                    style="background-color:#60bdf3 ;">Pay Now</button>
                </div> --}}
              </div>
      
            </div>
          </div>
        </div>
      </div>
</div>
<!-- /.container-fluid -->
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

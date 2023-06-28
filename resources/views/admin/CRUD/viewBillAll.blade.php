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
  <form class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search" autocomplete="off">
      <div class="input-group">
          <input type="search" name="search-bill" class="form-control bg-light border-0 small" placeholder="Search for..."
              aria-label="Search" aria-describedby="basic-addon2" value="{{ $search }}" id="keywordss">
            <div id="search_ajax_viewuser"></div>
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
              @foreach ($billsenger as $bill)
                  <a class="dropdown-item d-flex align-items-center dropdown-item-bill" href="{{ url('/admin/bill-user/'.$bill->customer_id) }}" target="_blank">
                      <div class="mr-3">
                          <img class="rounded-circle" src="{{ asset('/storage/'.$bill->img_customer) }}" alt="..." style="width: 50px;">
                          <div class="status-indicators bg-success" data-id="{{ $bill->id }}"></div>
                      </div>
                      <div>
                          <div class="small text-gray-500">{{ $bill->total_money }}</div>
                          <span class="font-weight-bold">{{ $bill->name_customer}} . {{ $bill->order_date }}</span>
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
    <h1 class="h3 mb-2 text-gray-800">Bill</h1>
    <!--  <p class="mb-4">DataTables is a third party plugin that is used to generate the demo table below.
          For more information about DataTables, please visit the <a target="_blank"
              href="https://datatables.net">official DataTables documentation</a>.</p> -->
  
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
      <div class="card-body">
        <div class="table-responsive">
          <table class="table table-hover" id="dataTable" width="100%" cellspacing="0">
            <thead>
              <tr>
                <th>ID</th>
                <th>Customer Id</th>
                <th>Customer Name</th>
                <th>Customer Address</th>
                <th>Product Id</th>
                <th>Total product</th>
                <th>Name product</th>
                <th>Product type</th>
                <th>Money Ship</th>
                <th>Total Money</th>
                <th>Time</th>
                <th colspan="2">Settings</th>
  
              </tr>
            </thead>
            <tfoot>
              <tr>
                <th>ID</th>
                <th>Customer Id</th>
                <th>Customer Name</th>
                <th>Customer Address</th>
                <th>Product Id</th>
                <th>Total product</th>
                <th>Name product</th>
                <th>Product type</th>
                <th>Money Ship</th>
                <th>Total Money</th>
                <th>Time</th>
                <th colspan="2">Settings</th>
              </tr>
            </tfoot>
            <tbody>
              @forelse ($billAll as $key =>$item)
  
              <tr>
                <td>{{$item->id}}</td>
                <td>{{$item->customer_id}}</td>
                <td>{{$item->name_customer}}</td>
                <td>{{$item->address}}</td>
                <td>{{$item->product_id}}</td>
                <td>{{$item->total_product}}</td>
                <td>{{$item->product_type}}</td>
                <td>{{$item->name_product}}</td>
                <td>{{ number_format($item->money_ship, 0, ',', '.') }} VND</td>
                <td>{{ number_format($item->total, 0, ',', '.') }} VND</td>
                <td>{{$item->created_at}}</td>
                <td>
                  <form action="{{ route('ad.deleteBillAll',['id'=>$item->id]) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                        class="bi bi-trash-fill" viewBox="0 0 16 16">
                        <path
                          d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1H2.5zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5zM8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5zm3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0z" />
                      </svg></button>
                  </form>
                </td>
              </tr>
              @empty
                <tr>
                  <td colspan="11" class="text-center">No products yet!</td>
                </tr>
              @endforelse
            </tbody>
          </table>
          {{ $billAll->links() }}
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

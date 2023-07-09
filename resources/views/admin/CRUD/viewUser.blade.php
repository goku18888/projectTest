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
          <input type="search" name="search-user" class="form-control bg-light border-0 small" placeholder="Search for..."
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
    <h1 class="h3 mb-2 text-gray-800">Customer</h1>
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
                <th>ID User</th>
                <th>Name User</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Address</th>
                <th>Avatar</th>
                <th>Bill User</th>
                <th colspan="2">Delete</th>
  
              </tr>
            </thead>
            <tfoot>
              <tr>
                <th>ID User</th>
                <th>Name User</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Address</th>
                <th>Avatar</th>
                <th>Bill User</th>
                <th colspan="2">Delete</th>
              </tr>
            </tfoot>
            <tbody>
              @forelse ($user as $key =>$item)
  
              <tr>
                <td>{{$item->id}}</td>
                <td>{{$item->name_customer}}</td>
                <td><a href="mailto:{{$item->email}}" target="_blank">{{$item->email}}</a></td>
                <td>{{$item->phone}}</td>
                <td>{{$item->address}}</td>
                <td>
                  <!-- Button trigger modal -->
                  <a href="{{ asset('/storage/'.$item->img_customer) }}" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#staticBackdrop{{$item->id}}" style="background-color: white;border-color:white;">
                    <img src="{{ asset('/storage/'.$item->img_customer) }}" style="width: 300px">
                  </a>
                  <!-- Modal -->
                  <div class="modal fade" id="staticBackdrop{{$item->id}}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                    <div class="modal-dialog" style="max-width: 700px">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h5 class="modal-title" id="staticBackdropLabel">Pictures of {{$item->name_customer}}</h5>
                          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                          <img src="{{ asset('/storage/'.$item->img_customer) }}" style="width: 680px">
                        </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                          <button type="button" class="btn btn-primary">Save changes</button>
                        </div>
                      </div>
                    </div>
                  </div>
                </td>
                <td>
                  <!-- Button trigger modal -->
                  <a href="{{ route('ad.userBill',['id'=>$item->id]) }}" class="btn btn-outline-dark">View</a>
                </td>
                {{-- <td>
                  <a href="#">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                      class="bi bi-bag-plus-fill" viewBox="0 0 16 16">
                      <path fill-rule="evenodd"
                        d="M10.5 3.5a2.5 2.5 0 0 0-5 0V4h5v-.5zm1 0V4H15v10a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2V4h3.5v-.5a3.5 3.5 0 1 1 7 0zM8.5 8a.5.5 0 0 0-1 0v1.5H6a.5.5 0 0 0 0 1h1.5V12a.5.5 0 0 0 1 0v-1.5H10a.5.5 0 0 0 0-1H8.5V8z" />
                    </svg>
                  </a>
                  <a href="#"><svg xmlns="http://www.w3.org/2000/svg" width="16"
                      height="16" fill="currentColor" class="bi bi-gear-wide" viewBox="0 0 16 16">
                      <path
                        d="M8.932.727c-.243-.97-1.62-.97-1.864 0l-.071.286a.96.96 0 0 1-1.622.434l-.205-.211c-.695-.719-1.888-.03-1.613.931l.08.284a.96.96 0 0 1-1.186 1.187l-.284-.081c-.96-.275-1.65.918-.931 1.613l.211.205a.96.96 0 0 1-.434 1.622l-.286.071c-.97.243-.97 1.62 0 1.864l.286.071a.96.96 0 0 1 .434 1.622l-.211.205c-.719.695-.03 1.888.931 1.613l.284-.08a.96.96 0 0 1 1.187 1.187l-.081.283c-.275.96.918 1.65 1.613.931l.205-.211a.96.96 0 0 1 1.622.434l.071.286c.243.97 1.62.97 1.864 0l.071-.286a.96.96 0 0 1 1.622-.434l.205.211c.695.719 1.888.03 1.613-.931l-.08-.284a.96.96 0 0 1 1.187-1.187l.283.081c.96.275 1.65-.918.931-1.613l-.211-.205a.96.96 0 0 1 .434-1.622l.286-.071c.97-.243.97-1.62 0-1.864l-.286-.071a.96.96 0 0 1-.434-1.622l.211-.205c.719-.695.03-1.888-.931-1.613l-.284.08a.96.96 0 0 1-1.187-1.186l.081-.284c.275-.96-.918-1.65-1.613-.931l-.205.211a.96.96 0 0 1-1.622-.434L8.932.727zM8 12.997a4.998 4.998 0 1 1 0-9.995 4.998 4.998 0 0 1 0 9.996z" />
                    </svg>
                  </a>
                </td> --}}
                <td>
                  <form action="{{ route('ad.userDelete',['id'=>$item->id]) }}" method="POST">
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

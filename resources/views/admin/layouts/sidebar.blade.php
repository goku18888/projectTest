<!-- Sidebar -->
{{-- <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">
   <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
      <div class="sidebar-brand-icon rotate-n-15">
         <i class="fas fa-laugh-wink"></i>
      </div>
      <div class="sidebar-brand-text mx-3">DB Admin</div>
   </a>
   <hr class="sidebar-divider my-0">
   <li class="nav-item">
      <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true"
         aria-controls="collapseTwo">
         <i class="fas fa-fw fa-cog"></i>
         <span>Admin</span>
      </a>
      <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
         <div class="bg-white py-2 collapse-inner rounded">
            <a class="collapse-item" href="buttons.html">Thêm mới</a>
            <a class="collapse-item" href="cards.html">Danh sách admin</a>
         </div>
      </div>
   </li>
</ul> --}}

{{-- sadgasdkasiduhasdiuasd --}}

<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <meta http-equiv="X-UA-Compatible" content="ie=edge">
   <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
      integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
   <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous">
   </script>
   <title>Document</title>
</head>

<body>
   <div class="offcanvas offcanvas-start" tabindex="-1" id="offcanvasExample" aria-labelledby="offcanvasExampleLabel">
      <div class="offcanvas-header">
         <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
      </div>
      <div class="offcanvas-body">
         <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
               <div class="sidebar-brand-icon rotate-n-15">
                  <i class="fas fa-laugh-wink"></i>
               </div>
               <div class="sidebar-brand-text mx-3">DB Admin</div>
            </a>
            <hr class="sidebar-divider my-0">
            <li class="nav-item">
               <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo"
                  aria-expanded="true" aria-controls="collapseTwo">
                  <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                     class="bi bi-person-square" viewBox="0 0 16 16">
                     <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0z" />
                     <path
                        d="M2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H2zm12 1a1 1 0 0 1 1 1v12a1 1 0 0 1-1 1v-1c0-1-1-4-6-4s-6 3-6 4v1a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1h12z" />
                  </svg>
                  <span>Dashboard</span>
               </a>
               <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                  <div class="bg-white py-2 collapse-inner rounded">
                     <a class="collapse-item" href="{{ route('ad.dashboard') }}">Dashboard</a>
                     <a class="collapse-item" href="{{ route('ad.moneyDashboard') }}">Money Dashboard</a>
                     <a class="collapse-item" href="{{ route('ad.orderDashboard') }}">Order Dashboard</a>
                  </div>
               </div>
            </li>

            <li class="nav-item">
               <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseOne"
                  aria-expanded="true" aria-controls="collapseOne">
                  <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                     class="bi bi-people-fill" viewBox="0 0 16 16">
                     <path d="M7 14s-1 0-1-1 1-4 5-4 5 3 5 4-1 1-1 1H7zm4-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6z" />
                     <path fill-rule="evenodd"
                        d="M5.216 14A2.238 2.238 0 0 1 5 13c0-1.355.68-2.75 1.936-3.72A6.325 6.325 0 0 0 5 9c-4 0-5 3-5 4s1 1 1 1h4.216z" />
                     <path d="M4.5 8a2.5 2.5 0 1 0 0-5 2.5 2.5 0 0 0 0 5z" />
                  </svg>
                  <span>Supplier</span>
               </a>
               <div id="collapseOne" class="collapse" aria-labelledby="headingOne" data-parent="#accordionSidebar">
                  <div class="bg-white py-2 collapse-inner rounded">
                     <a class="collapse-item" href="{{ route('ad.details') }}">Supplier View</a>
                     <a class="collapse-item" href="{{ route('ad.sup') }}">Supplier Add</a>
                  </div>
               </div>
            </li>
            <li class="nav-item">
               <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseThree"
                  aria-expanded="true" aria-controls="collapseThree">
                  <i class="fa-solid fa-mobile-screen-button"></i>
                  <span>Producttype</span>
               </a>
               <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordionSidebar">
                  <div class="bg-white py-2 collapse-inner rounded">
                     <a class="collapse-item" href="{{ route('ad.type_detail') }}">Producttype View</a>

                     <a class="collapse-item" href="{{ route('ad.type') }}">Producttype Add</a>
                  </div>
               </div>
            </li>
            @if (!$Type && !$Sup)
            <li class="nav-item">
               <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseFour"
                  aria-expanded="true" aria-controls="collapseFour">
                  <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                     class="bi bi-briefcase-fill" viewBox="0 0 16 16">
                     <path
                        d="M6.5 1A1.5 1.5 0 0 0 5 2.5V3H1.5A1.5 1.5 0 0 0 0 4.5v1.384l7.614 2.03a1.5 1.5 0 0 0 .772 0L16 5.884V4.5A1.5 1.5 0 0 0 14.5 3H11v-.5A1.5 1.5 0 0 0 9.5 1h-3zm0 1h3a.5.5 0 0 1 .5.5V3H6v-.5a.5.5 0 0 1 .5-.5z" />
                     <path
                        d="M0 12.5A1.5 1.5 0 0 0 1.5 14h13a1.5 1.5 0 0 0 1.5-1.5V6.85L8.129 8.947a.5.5 0 0 1-.258 0L0 6.85v5.65z" />
                  </svg>
                  <span>Product</span>
               </a>
               <div id="collapseFour" class="collapse" aria-labelledby="headingFour" data-parent="#accordionSidebar">
                  <div class="bg-white py-2 collapse-inner rounded">
                     You Must Add Product Type And Suplier First !!! 
                  </div>
               </div>
            </li>
            @else
            <li class="nav-item">
               <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseFour"
                  aria-expanded="true" aria-controls="collapseFour">
                  <i class="fa-solid fa-mobile"></i>
                  <span>Product</span>
               </a>
               <div id="collapseFour" class="collapse" aria-labelledby="headingFour" data-parent="#accordionSidebar">
                  <div class="bg-white py-2 collapse-inner rounded">
                     <a class="collapse-item" href="{{ route('ad.detail') }}">Product View</a>
                     <a class="collapse-item" href="{{ route('ad.add') }}">Product Add</a>
                  </div>
               </div>
            </li>
            @endif
            <li class="nav-item">
               <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseFive"
                  aria-expanded="true" aria-controls="collapseFive">
                  <i class="fa-solid fa-comment"></i>
                  <span>Customer</span>
               </a>
               <div id="collapseFive" class="collapse" aria-labelledby="headingFive" data-parent="#accordionSidebar">
                  <div class="bg-white py-2 collapse-inner rounded">
                     <a class="collapse-item" href="{{ route('ad.user') }}">Customer View</a>
                     <a class="collapse-item" href="{{ route('ad.viewBillAll') }}">View All Bill</a>
                  </div>
               </div>
            </li>
            <li class="nav-item">
               <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseSix"
                  aria-expanded="true" aria-controls="collapseSix">
                  <i class="fa-solid fa-comment"></i>
                  <span>Comment</span>
               </a>
               <div id="collapseSix" class="collapse" aria-labelledby="headingSix" data-parent="#accordionSidebar">
                  <div class="bg-white py-2 collapse-inner rounded">
                     <a class="collapse-item" href="{{ route('ad.list_comment') }}">View Comment</a>
                  </div>
               </div>
            </li>
            <li class="nav-item">
               <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseSeven"
                  aria-expanded="true" aria-controls="collapseSeven">
                  <i class="fa-solid fa-motorcycle"></i>
                  <span>Ship</span>
               </a>
               <div id="collapseSeven" class="collapse" aria-labelledby="headingSeven" data-parent="#accordionSidebar">
                  <div class="bg-white py-2 collapse-inner rounded">
                     <a class="collapse-item" href="{{ route('ad.delivery') }}">Ship Controller</a>
                  </div>
               </div>
            </li>
      </div>
   </div>
</body>

</html>
<!-- End of Sidebar -->
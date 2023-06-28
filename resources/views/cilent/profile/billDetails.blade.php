<!DOCTYPE html>
<html lang="en">
<head>
  @include('cilent.layouts.header')
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Hóa Đơn Chi Tiết</title>
</head>
<body>
  @include('cilent.layouts.topbar')
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
                      <td>{{ $item->price_product }}$</td>
                      <td>{{ $item->money_ship }}$</td>
                    </tr>                       
                    @endforeach
                  </tbody>
                  <tfoot>
                    <tr>
                      <th>Tổng Tiền :</th>
                      <td>{{ $item->total }}$</td>
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
                  <p>Thank you for your purchase</p>
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
</body>
</html>
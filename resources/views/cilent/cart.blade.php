<!DOCTYPE html>
<html lang="en">

@include('cilent.layouts.header')

<body>
    @include('cilent.layouts.topbar')
    <header id="fh5co-header" class="fh5co-cover fh5co-cover-sm" role="banner"
        style="background-image:url('images/img_bg_2.jpg');">
        <div class="overlay"></div>
        <div class="container">
            <div class="row">
                <div class="col-md-8 col-md-offset-2 text-center">
                    <div class="display-t">
                        <div class="display-tc animate-box" data-animate-effect="fadeIn">
                            <h1>Carts</h1>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <div style="text-align: center;">
        <form action="">
            @csrf
            <div><h1 style="color: aqua;">Chọn Vùng Vận Chuyển</h1></div>
            <div class="form-group">
                <label for="">Chọn Thành Phố</label>
                <select name="city" id="city" class="choose city">
                    <option value="">---Chọn Thành Phố---</option>
                    @foreach ($city as $item)
                        <option value="{{ $item->matp }}">{{ $item->name_city }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="">Chọn Quận Huyện</label>
                <select name="province" id="province" class="choose province">
                    <option value="">---Chọn Quận Huyện---</option>
                    @foreach ($province as $provin)
                        <option value="{{ $provin->maqh }}">{{ $provin->name_quanhuyen }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="">Chọn Xã Phường</label>
                <select name="wards" id="wards" class="wards">
                    <option value="">---Chọn Xã Phường---</option>
                    @foreach ($wards as $ward)
                        <option value="{{ $ward->xaid }}">{{ $ward->name_xaphuong }}</option>
                    @endforeach
                </select>
            </div>
            <input type="button" value="Tính Phí Vận Chuyển" name="calculate_delivery"
                class="btn btn-primary btn-sm calculate_delivery">
        </form>
    </div>
    <div class="cart delete_cart_url" data-url="{{ route('us.deleteCart') }}">
        @if (session()->has("outofstock"))
            <div class="alert alert-danger">
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                {{ session()->get('outofstock') }}
            </div>
        @endif
        <table class="table update_cart_url" data-url="{{ route('us.updateCart') }}">
            <thead>
                <tr>
                    <th scope="col">Mã Sản Phẩm</th>
                    <th scope="col">Ảnh Sản Phẩm</th>
                    <th scope="col">Tên Sản Phẩm</th>
                    <th scope="col">Giá Sản Phẩm</th>
                    <th scope="col">Bao Nhiêu Sản Phẩm</th>
                    <th scope="col">Thành Tiền</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            @php
                $total = 0;
            @endphp
            <tbody>
                {{-- @dd($carts) --}}
                @foreach ($carts as $id => $item)
                    @php
                        $total += $item['price_product'] * $item['amount'];
                    @endphp
                    <tr>
                        <th scope="row">{{ $item['serie'] }}</th>
                        <th scope="row"><img src="{{ asset('/storage/'.$item['img_product']) }}" alt="" style="width: 70px;height: 70px;"></th>
                        <td>{{ $item['name_product'] }}</td>
                        <td>{{ number_format($item['price_product']) }} VND</td>
                        <td>
                            <input type="number" value="{{ $item['amount'] }}" min="1" class="amount">
                        </td>
                        <td>
                            {{ number_format($item['price_product'] * $item['amount']) }} VND
                        </td>
                        <td>
                            <a href="#" data-id="{{ $id }}" class="btn btn-primary cart_update">Sửa giỏ hàng</a>
                            <a href="#" data-id="{{ $id }}" class="btn btn-danger cart_delete">Xóa</a>
                            @php
                                $customer_id = session()->get('user_login_id');
                            @endphp
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        @if (!empty(session()->get('user_login_id')&&(session()->get('fee'))))
            <form action="{{ route('us.addBill') }}" method="POST">
                @csrf
                <table border="0px" style="margin-left: auto;margin-right: auto;">
                    <tr>
                        <th scope="col"><input type="text" placeholder="{{ $shippingInfo->email }}" name="shipping_email"></th>
                        <td>
                            @error('shipping_email')
                                <span style="color:red;">{{$message}}</span>
                            @enderror
                        </td>
                    </tr>
                    <tr>
                        <th scope="col"><input type="text" placeholder="{{ $shippingInfo->name_customer }}" name="shipping_name"></th>
                        <td>
                            @error('shipping_name')
                                <span style="color:red;">{{$message}}</span>
                            @enderror
                        </td>
                    </tr>
                    <tr>
                        <th scope="col"><input type="text" placeholder="Địa Chỉ Gửi..." name="shipping_address"></th>
                        <td>
                            @error('shipping_address')
                                <span style="color:red;">{{$message}}</span>
                            @enderror
                        </td>
                    </tr>
                    <tr>
                        <th scope="col"><input type="text" placeholder="{{ $shippingInfo->phone }}" name="shipping_phone"></th>
                        <td>
                            @error('shipping_phone')
                                <span style="color:red;">{{$message}}</span>
                            @enderror
                        </td>
                    </tr>
                    <tr>
                        <th scope="col"><input type="text" placeholder="Chú Thích..." name="shipping_note"></th>
                        <td>
                            @error('shipping_note')
                                <span style="color:red;">{{$message}}</span>
                            @enderror
                        </td>
                    </tr>
                    <tr>
                        <td><button class="btn btn-danger">Thanh Toán Tiền Mặt</button></td> 
                    </tr>
                    <tr>
                        <td>
                            <a class="btn btn-primary m-3" href="{{ route('us.processTransaction') }}">Thanh Toán PayPal</a>
                        </td>
                    </tr>
                </table>
            </form>
        @else
            <h2 style="color: red;text-align: center">Bạn Phải Có Tài Khoản Và Chọn Nơi Vận Chuyển Để Vận Chuyển Hàng !!!</h2>
            <h2 style="text-align: center;"><a href="{{ route('us.userLogin') }}">>>> Nếu Không Có Thì Đăng Ký Tại Đây <<<<</a></h2>
        @endif
        <table border="2px" style="margin-left: auto;margin-right: auto;">
            <tr>
                <td>
                    <h2>Tổng Tiền Sản Phẩm: {{ number_format($total) }} VND</h2>
                </td>
            </tr>
            <tr>
                @if (session('fee'))
                    <td>
                        <h2>
                            <a href="{{ url('/user/del-fee') }}"><i class="fa fa-times"></i></a>
                            Giá Tiền Vận Chuyển:{{ number_format(session('fee'), 0, ',', '.') }} VND
                        </h2>
                    </td>
                @endif
            </tr>
            <tr>
                <td>
                    <h2>Tổng Tất Cả: {{ number_format($total + session('fee')) }} VND</h2>
                </td>
            </tr>
        </table>
    </div>
    @include('cilent.layouts.footer')

    <div class="gototop js-top">
        <a href="#" class="js-gotop"><i class="fa-solid fa-arrow-up"></i></a>
    </div>
    @include('cilent.layouts.jqueryBoostrap')
    <script>
        function cartUpdate(event){
        event.preventDefault();
        let urlUpdateCart=$('.update_cart_url').data('url');
        let id=$(this).data('id');
        let amount=$(this).parents('tr').find('input.amount').val();
        $.ajax({
            type:"GET",
            url:urlUpdateCart,
            data:{id:id,amount:amount},
            dataType:'json',
            success:function(data){
                location.reload();
                if(data.code===200){
                    $('.update_cart_url').html(data.cart)
                    alert('Cập nhập thành công');
                }
            },
            error:function(err){
                console.log(err);
            }
        });
    }


    function cartDelete(event){
        event.preventDefault();
        let urlDelete=$('.delete_cart_url').data('url');
        let id=$(this).data('id');
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type:"GET",
            url:urlDelete,
            data:{id:id},
            success:function(data){
                location.reload();
                if(data.code===200){
                    $('.delete_cart_url').html(data.cart);
                    alert('Đã Xóa Sản Phẩm');
                }
            },
            error:function(err){
                console.log('err', err);
            }
        });
    }
    $(function(){
        $(document).on('click','.cart_update',cartUpdate);
        $(document).on('click','.cart_delete',cartDelete);
    })
    </script>
    {{--chon vung tinh tien ship --}}
    <script>
    $(document).ready(function(){
    $('.choose').on('change',function(){
    var action=$(this).attr('id');
    var ma_id=$(this).val();
    var _token=$('input[name="_token"]').val();
    var result='';
    if(action=='city'){
      result='province';
    }else{
      result='wards';
    }
    $.ajax({
      url:"{{url('/user/select-delivery-home') }}",
      method:"POST",
      data:{action:action,ma_id:ma_id,_token:_token},
      success:function(data){
        $('#' + result).html(data);
      }
    });
  });
})
    </script>
    {{-- tinh tien ship --}}
    <script>
    $(document).ready(function(){
        $('.calculate_delivery').click(function(){
        var matp=$('.city').val();
        var maqh=$('.province').val();
        var xaid=$('.wards').val();
        var _token=$('input[name="_token"]').val();
        if (matp=='' && maqh=='' && xaid=='') {
            alert('Làm ơn chọn để tính phí vận chuyển');
        } else {
            $.ajax({
            url:"{{url('/user/calculate-fee') }}",
            method:"POST",
            data:{matp:matp,maqh:maqh,xaid:xaid,_token:_token},
            success:function(data){
                location.reload();
            }
            });    
        }
        });
    })
    </script>
</body>

</html>
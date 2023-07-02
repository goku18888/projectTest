<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css">
</head>
<body>
    <div class="container" style="background: #222;border-radius: 12px;padding: 15px;">
        <div class="col-md-12">
            <p style="text-align: center;color: #fff;">Đây Là Email Tự Động,Do Khách Hàng Đã Đặt Sản Phẩm !!!</p>
            <div class="row" style="background: deeppink;padding: 15px;">
                <div class="col-md-6" style="text-align: center;color:#fff;font-weight: bold;font-size: 30px;">
                    <h4 style="margin: 0">Công Ty Bán Hàng</h4>
                    <h4 style="margin: 0">Dịch Vụ Bán Hàng,Vận Chuyển</h4>
                </div>
                <div class="col-md-6 logo" style="color: #fff">
                    <p>Khách Hàng <strong style="color: #000;text-decoration: underline;">{{$shipping_array['name_customer']}}</strong></p>
                </div>
                <div class="col-md-12">
                    <p style="color: #fff;font-size: 17px;">Khách Hàng Đã Đặt Dịch Vụ Tại Shop Như Sau:</p>
                    <h4 style="color: #000;text-transform: uppercase;">Thông Tin Đơn Hàng:</h4>
                    <p>Mã đơn hàng: <strong style="text-transform: uppercase;color: #fff">{{ $order->id }}</strong></p>
                    <p>Dịch vụ: <strong style="text-transform: uppercase;color: #fff">Đặt Hàng Trực Tuyến</strong></p>
                    <h4 style="color: #000;text-transform: uppercase;">Thông Tin Người Nhận</h4>
                    <p>Email:
                        @if ($shipping_array['shipping_email']=='')
                            Không Điền
                        @else
                            <span style="color: #fff">{{ $shipping_array['shipping_email'] }}</span>
                        @endif
                    </p>
                    <p>Họ Và Tên Người Gửi:
                        @if ($shipping_array['shipping_name']=='')
                            Không Điền
                        @else
                            <span style="color: #fff">{{ $shipping_array['shipping_name'] }}</span>
                        @endif
                    </p>
                    <p>Địa Chỉ Nhận Hàng:
                        @if ($shipping_array['shipping_address']=='')
                            Không Điền
                        @else
                            <span style="color: #fff">{{ $shipping_array['shipping_address'] }}</span>
                        @endif
                    </p>
                    <p>Số Điện Thoại:
                        @if ($shipping_array['shipping_phone']=='')
                            Không Điền
                        @else
                            <span style="color: #fff">{{ $shipping_array['shipping_phone'] }}</span>
                        @endif
                    </p>
                    <p>Ghi Chú Đơn Hàng:
                        @if ($shipping_array['shipping_note']=='')
                            Không Điền
                        @else
                            <span style="color: #fff">{{ $shipping_array['shipping_note'] }}</span>
                        @endif
                    </p>
                    <p>Hình Thức Thanh Toán: <strong></strong>
                        @if ($shipping_array['status'] == 0)
                            Thanh Toán Bằng Tiền Mặt
                        @else
                            Thanh Toán Bằng Thẻ PayPal
                        @endif
                    </p>
                    <p style="color: #fff;">Nếu Thông Tin Người Nhận Hàng Không Có Thì Chúng
                        Tôi Sẽ Liên Hệ Người Đặt Hàng Để Trao Đổi Thông Tin Về Đơn Hàng</p>
                    <h4 style="color: #000;text-transform:uppercase;">Sản Phẩm Đã Đặt</h4>
                        <table class="table table-striped" style="border: 1px;">
                            <thead>
                                <tr>
                                    <th>Sản Phẩm</th>
                                    <th>Giá Tiền</th>
                                    <th>Số Lượng</th>
                                    <th>Thành Tiền</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $sub_total=0;
                                    $total=0;
                                @endphp
                                @foreach ($cart_array as $cart)
                                    @php
                                        $sub_total=$cart['amount']*$cart['price_product'];
                                        $total+=$sub_total;
                                    @endphp
                                <tr>
                                    <td>{{ $cart['name_product'] }}</td>
                                    <td>{{ $cart['price_product'] }} $</td>
                                    <td>{{ $cart['amount'] }}</td>
                                    <td>{{ $sub_total }}</td>
                                </tr>
                                @endforeach
                                <tr>
                                    <td colspan="4" align="right">Tổng Tiền Thanh Toán:{{ $total }} $</td>
                                </tr>
                            </tbody>
                        </table>
                </div>
                <p style="color: #fff;">Mọi Chi Tiết Liên Hệ Với Chúng Tôi Tại Website: <a href="http://project.test/user/index">Shop</a>,Hoặc Liên Hệ Qua Hotline:0912315465
                .Xin Cảm Ơn Đã Đặt Hàng Của Chúng Tôi.</p>
            </div>
        </div>
    </div>
</body>
</html>
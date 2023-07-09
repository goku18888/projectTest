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
            <p style="text-align: center;color: #fff;">Đây Là Email Tự Động,Thông Báo Đã Có Đơn Vận Chuyển !!!</p>
            <div class="row" style="background: deeppink;padding: 15px;">
                <div class="col-md-6" style="text-align: center;color:#fff;font-weight: bold;font-size: 30px;">
                    <h4 style="margin: 0">Công Ty Bán Hàng</h4>
                    <h4 style="margin: 0">Dịch Vụ Bán Hàng,Vận Chuyển</h4>
                </div>
                {{-- <div class="col-md-6 logo" style="color: #fff">
                    <p>Khách Hàng <strong style="color: #000;text-decoration: underline;">{{$shipping_array['name_customer']}}</strong></p>
                </div> --}}
                <div class="col-md-12">
                    <p style="color: #fff;font-size: 17px;">Khách Hàng Đã Đặt Dịch Vụ Tại Shop Như Sau:</p>
                    <h4 style="color: #000;text-transform: uppercase;">Thông Tin Đơn Hàng:</h4>
                    <p>Mã đơn hàng: <strong style="text-transform: uppercase;color: #fff">{{ $order_id }}</strong></p>
                    <p>Mã Vận Chuyển: <strong style="text-transform: uppercase;color: #fff">{{ $order_value }}</strong></p>
                    <p>Dịch vụ: <strong style="text-transform: uppercase;color: #fff">Vận Chuyển</strong></p>
                    <p style="color: #fff;">Nếu Không Có Người Nào Ra Nhận Hàng Thì Chúng
                        Tôi Sẽ Liên Hệ Người Đặt Hàng Để Trao Đổi Thông Tin Về Đơn Hàng</p>
                </div>
                <p style="color: #fff;">Mọi Chi Tiết Liên Hệ Với Chúng Tôi Tại Website: <a href="http://project.test/user/index">Shop</a>,Hoặc Liên Hệ Qua Hotline:0912315465
                .Xin Cảm Ơn Đã Đặt Hàng Của Chúng Tôi.</p>
            </div>
        </div>
    </div>
</body>
</html>
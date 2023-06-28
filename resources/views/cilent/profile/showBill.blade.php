<!DOCTYPE html>
<html lang="en">

@include('cilent.layouts.header')

<body>
    @include('cilent.layouts.topbar')
    <header id="fh5co-header" class="fh5co-cover fh5co-cover-sm" role="banner" style="background-image:url('images/img_bg_2.jpg');">
        <div class="overlay"></div>
        <div class="container">
            <div class="row">
                <div class="col-md-8 col-md-offset-2 text-center">
                    <div class="display-t">
                        <div class="display-tc animate-box" data-animate-effect="fadeIn">
                            <h1>Product Carts</h1>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <div class="cart" data-url="{{ route('us.deleteCart') }}">
        @if (session()->has("outofstock"))
                            <div class="alert alert-danger">
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                {{ session()->get('outofstock') }}
                            </div>
        @endif
                <table class="table update_cart_url" data-url="{{ route('us.updateCart') }}">
                  <thead>
                     <tr>
                       <th>Mã Hóa Đơn</th>
                       <th>Mã Khách Hàng</th>
                       <th>Tổng Tiền</th>
                       <th>Mua Lúc</th>
                       <th>Trạng Thái Vận Chuyển</th>
                       <th></th>
                       <th>Chi Tiết Đơn Hàng</th>
                     </tr>
                   </thead>
                   <tbody>
                     @foreach ($bill as $id =>$item)
                     <tr>
                       <td>{{$item->id}}</td>
                       <td>{{$item->customer_id}}</td>
                       <td>{{$item->total}}$</td>
                       <td>{{$item->created_at}}</td>
                       <td><p>Trạng thái giao hàng:
                        @if ($item->status == 0)
                            <p>Đơn hàng đang được xử lí</p>
                        @elseif($item->status == 1)
                            <p class="text text-primary">Đang vận chuyển</p>
                        @elseif($item->status == 2)
                            <p class="text text-success">Đã Giao Hàng</p>
                        @else
                            <p class="text text-danger">Bạn Đã Hủy Hàng</p>
                        @endif
                      </p></td>
                      <td>
                        @if ($item->status == 3 || $item->status == 2)

                        @else
                        <button type="button" class="btn btn-danger cancel" data-target_id="{{ $item->id }}" data-toggle="modal" data-target="#exampleModal" data-whatever="@mdo">Hủy Đơn Hàng</button>
                        @endif
                      </td>
                       <td><a href="{{route('us.billDetails',['id'=>$item->id]) }}" class="btn btn-primary">Chi Tiết</a></td>
                       {{-- <td>
                         <a href="{{ route('ad.add') }}">
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
                       </td>
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
                       </td> --}}
                     </tr>
                     @endforeach
                   </tbody>
                </table>
                {{ $bill->links() }}
      </div>
        @include('cilent.layouts.footer')
    <div class="gototop js-top">
		  <a href="#" class="js-gotop"><i class="fa-solid fa-arrow-up"></i></a>
	  </div>
    {{-- Modal --}}
    <div class="modal" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Lý Do Hủy Đơn Hàng</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <form>
              @csrf
              {{-- <div class="form-group">
                <label for="recipient-name" class="col-form-label">Recipient:</label>
                <input type="text" class="form-control" id="recipient-name">
              </div> --}}
              <div class="form-group">
                <label for="message-text" class="col-form-label">Hãy Nêu Lý Do:</label>
                <textarea class="form-control lydohuydon" id="message-text" rows="5" placeholder="Bắt Buộc..."></textarea>
              </div>
            </form>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Hủy</button>
            <button type="button" class="btn btn-success send" onclick="huyDonHang()">Gửi</button>
          </div>
        </div>
      </div>
    </div>
@include('cilent.layouts.jqueryBoostrap')
<script>
  let targetId = null

  function huyDonHang(){
    var order_id=targetId;
    var lydo=$('.lydohuydon').val();
    var status=3;
    var _token=$('input[name="_token"]').val();
    $.ajax({
            type:"POST",
            url:"{{ url('/user/delete-order') }}",
            data:{order_id:order_id,lydo:lydo,status:status,_token:_token},
            success:function(data){
              location.reload();
              alert('Hủy Thành Công');
            },
            error: function(xhr, status, error) {
                console.log(xhr.responseText); // Hiển thị lỗi chi tiết trong console
            }
        });
  }

  //lay id ben button cancel
  $(".cancel").click(function(){
    targetId = $(this).data('target_id');
  });
  $(".send").click(function(){
    console.log('target_id', targetId);
  });

</script>
</body>
</html>
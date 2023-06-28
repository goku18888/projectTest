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
                       <th>ID Bill</th>
                       <th>Products Id</th>
                       <th>Customer Id</th>
                       <th>Total Products</th>
                       <th>Products</th>
                       <th>Total Money</th>
                       <th>Buy At</th>
                       <th colspan="2">Settings</th>
         
                     </tr>
                   </thead>
                   <tbody>
                     @forelse ($bill as $id =>$item)
         
                     <tr>
                       <td>{{$item->id}}</td>
                       <td>{{$item->product_id}}</td>
                       <td>{{$item->customer_id}}</td>
                       <td>{{$item->total_product}}</td>
                       <td>{{$item->product_type}}</td>
                       <td>{{$item->total_money}}</td>
                       <td>{{$item->time_buy}}</td>
                       <td>
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
    
        @include('cilent.layouts.footer')
    
    <div class="gototop js-top">
		<a href="#" class="js-gotop"><i class="fa-solid fa-arrow-up"></i></a>
	</div>
@include('cilent.layouts.jqueryBoostrap')
</body>
</html>
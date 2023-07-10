<!DOCTYPE HTML>
<html>
@include('cilent.layouts.header')

<body>

    <div class="fh5co-loader"></div>

    <div id="page">
        @include('cilent.layouts.topbar')

        <header id="fh5co-header" class="fh5co-cover fh5co-cover-sm" role="banner"
            style="background-image:url(images/img_bg_2.jpg);">
            <div class="overlay"></div>
            <div class="container">
                <div class="row">
                    <div class="col-md-8 col-md-offset-2 text-center">
                        <div class="display-t">
                            <div class="display-tc animate-box" data-animate-effect="fadeIn">
                                <h1>Product Details</h1>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </header>

        <div id="fh5co-product">
            <div class="container">
                <div class="row">
                    <div class="col-md-10 col-md-offset-1 animate-box">
                        <div class="owl-carousel owl-carousel-fullwidth product-carousel">
                            @foreach ($imageProduct as $key=>$item)
                            <div class="item">
                                <div class="active text-center">
                                    <figure>
                                        <img src="/product_images/{{ $item->imgs_product }}">
                                    </figure>
                                </div>
                            </div>
                            @endforeach
                        </div>
                        <div class="row animate-box">
                            <div class="col-md-8 col-md-offset-2 text-center fh5co-heading">
                                <h2>{{$user->name_product}}</h2>
                                {{-- @forelse ($user as $item) --}}
                                <p>
                                    <a href="#" class="btn btn-primary btn-outline btn-lg add_to_cart"
                                        data-url="{{ route('us.addToCart',['id'=>$user->id]) }}">Add to Cart</a>
                                    {{-- <a href="#" class="btn btn-primary btn-outline btn-lg">Compare</a> --}}
                                </p>
                                {{-- @empty
                                <h1 style="margin-left: 350px">This item is not for sale yet !!!</h1>
                                @endforelse --}}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-10 col-md-offset-1">
                        <div class="fh5co-tabs animate-box">
                            <ul class="fh5co-tab-nav">
                                <li class="active"><a href="#" data-tab="1"><span class="icon visible-xs"><i
                                                class="icon-file"></i></span><span class="hidden-xs">Product
                                            Details &amp; Ratings</span></a></li>
                                {{-- <li><a href="#" data-tab="2"><span class="icon visible-xs"><i
                                                class="icon-bar-graph"></i></span><span
                                            class="hidden-xs">Specification</span></a></li> --}}
                                <li><a href="#" data-tab="3"><span class="icon visible-xs"><i
                                                class="icon-star"></i></span><span class="hidden-xs">Feedback &amp;
                                            Ratings</span></a></li>
                            </ul>

                            <!-- Tabs -->
                            <div class="fh5co-tab-content-wrap">
                                <div class="fh5co-tab-content tab-content active" data-tab-content="1">
                                    <div class="col-md-10 col-md-offset-1">
                                        Ratings:
                                        <ul class="list-inline rating" title="Average Rating">
                                            @for ($count = 1; $count <= 5; $count++)
                                                @php
                                                    if ($count<=$rating) {
                                                        $color='color:#ffcc00;';
                                                    } else {
                                                        $color='color:#ccc;';
                                                    }
                                                @endphp
                                                <li title="star rating"
                                                id="{{ $user->id }}-{{ $count }}"
                                                data-index="{{ $count }}"
                                                data-product_id="{{ $user->id }}"
                                                data-rating="{{ $rating }}"
                                                class="rating"
                                                style="cursor: pointer;{{ $color }} font-size: 30px;">
                                                &#9733;
                                                </li>
                                            @endfor
                                        </ul>
                                    <br>@forelse ($pro as $item)
                                        <span class="price">{{ number_format($item->price_product, 0, ',', '.') }} VND</span>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <h2 class="uppercase">Name Product</h2>
                                                <p>{{$item->name_product}}</p>
                                            </div>
                                            <div class="col-md-6">
                                                <h2 class="uppercase">About The Product</h2>
                                                <p>{{$item->depscribe}}</p>
                                            </div>
                                        </div>
                                        @empty
                                        not sale yet
                                        @endforelse
                                    </div>
                                </div>

                                {{-- <div class="fh5co-tab-content tab-content" data-tab-content="2">
                                    <div class="col-md-10 col-md-offset-1">
                                        <h3>Product Specification</h3>
                                        <ul>
                                            <li>Paragraph placeat quis fugiat provident veritatis quia iure a debitis
                                                adipisci dignissimos consectetur magni quas eius</li>
                                            <li>adipisci dignissimos consectetur magni quas eius nobis reprehenderit
                                                soluta eligendi</li>
                                            <li>Veritatis tenetur odio delectus quibusdam officiis est.</li>
                                            <li>Magni quas eius nobis reprehenderit soluta eligendi quo reiciendis
                                                fugit? Veritatis tenetur odio delectus quibusdam officiis est.</li>
                                        </ul>
                                    </div>
                                </div> --}}

                                {{-- display comment --}}
                                <div class="fh5co-tab-content tab-content" data-tab-content="3">
                                    <div class="col-md-10 col-md-offset-1">
                                        <h3>Display Comment</h3>
                                        <div class="feed">
                                            <form>
                                                @csrf
                                                <input type="hidden" name="product_id" class="product_id" value="{{ $user->id }}">
                                                <div id="comment_show" style="overflow: scroll;width: 758px;height: 374px;"></div>
                                            </form>
                                            {{-- comment --}}
                                            <div>
                                                <h5>Leave a comment</h5>
                                                <form>
                                                    @csrf
                                                        <input type="hidden" name="product_id" class="product_id" value="{{ $user->id }}">
                                                        <input type="text" name="customer_name" class="customer_name" placeholder="your name..." value="{{ session()->get('name_customer') }}" style="width: 100%"/><br>
                                                        <textarea name="comment_content" class="comment_content" style="width: 100%" placeholder="type..."></textarea>
                                                        <input type="button" class="btn btn-sm btn-outline-danger send-comment" value="Add Comment"/>
                                                    <div id="notify_comment"></div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                {{-- end comment --}}
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
        @include('cilent.layouts.footer')
    </div>

    <div class="gototop js-top">
        <a href="#" class="js-gotop"><i class="fa-solid fa-arrow-up"></i></a>
    </div>

    @include('cilent.layouts.jqueryBoostrap')
</body>

</html>
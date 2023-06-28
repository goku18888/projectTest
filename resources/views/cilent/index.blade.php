<!DOCTYPE HTML>
<html>
	@include('cilent.layouts.header')
	<body>
	<div class="fh5co-loader"></div>
	
	<div id="page">
	@include('cilent.layouts.topbar')
	<div class="container">
	@if (session()->has("1"))
                            <div class="alert alert-danger">
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                {{ session()->get('1') }}
                            </div>
    @endif
	</div>
	<aside id="fh5co-hero" class="js-fullheight">
		<div class="flexslider js-fullheight">
			<ul class="slides">
		   	<li style="background-image: url('/storage/img/cilent/5.jpg');">
		   		<div class="overlay-gradient"></div>
		   		<div class="container">
		   			<div class="col-md-6 col-md-offset-3 col-md-pull-3 js-fullheight slider-text">
		   				<div class="slider-text-inner">
		   					<div class="desc">
		   						<span class="price">$800</span>
		   						<h2>Samsung Galaxy Z Flip4</h2>
		   						<p>Có lẽ điện thoại gập đã không còn là cái tên quá xa lạ bởi nhiều ông lớn trong ngành sản xuất thiết bị di động đã cho ra mắt khá nhiều sản phẩm có thiết kế tương tự, gần đây nhất thì có sự góp mặt của chiếc flagship đến từ nhà Samsung mang tên Galaxy Z Flip4.</p>
			   					{{-- <p><a href="single.html" class="btn btn-primary btn-outline btn-lg">Purchase Now</a></p> --}}
		   					</div>
		   				</div>
		   			</div>
		   		</div>
		   	</li>
		   	<li style="background-image: url('/storage/img/cilent/6.jpg');">
		   		<div class="container">
		   			<div class="col-md-6 col-md-offset-3 col-md-pull-3 js-fullheight slider-text">
		   				<div class="slider-text-inner">
		   					<div class="desc">
		   						<span class="price">$530</span>
		   						<h2>iPhone 13 Pro Max</h2>
		   						<p>iPhone mới kế thừa thiết kế đặc trưng từ iPhone 12 Pro Max khi sở hữu khung viền vuông vức, mặt lưng kính cùng màn hình tai thỏ tràn viền nằm ở phía trước.</p>
			   					{{-- <p><a href="single.html" class="btn btn-primary btn-outline btn-lg">Purchase Now</a></p> --}}
		   					</div>
		   				</div>
		   			</div>
		   		</div>
		   	</li>
		   	<li style="background-image: url('/storage/img/cilent/7.jpg');">
		   		<div class="container">
		   			<div class="col-md-6 col-md-offset-3 col-md-pull-3 js-fullheight slider-text">
		   				<div class="slider-text-inner">
		   					<div class="desc">
		   						<span class="price">$750</span>
		   						<h2>Samsung Galaxy S22 Ultra</h2>
		   						<p>Galaxy S22 Ultra 5G được kế thừa form thiết kế từ những dòng Note trước đây của hãng đem đến cho bạn có cảm giác vừa mới lạ vừa hoài niệm. Trọng lượng của máy 228 g cho cảm giác cầm nắm đầm tay, khi cầm máy trần thì hơi có cảm giác dễ trượt.</p>
			   					{{-- <p><a href="single.html" class="btn btn-primary btn-outline btn-lg">Purchase Now</a></p> --}}
		   					</div>
		   				</div>
		   			</div>
		   		</div>
		   	</li>
		   	<li style="background-image: url('/storage/img/cilent/8.jpg');">
		   		<div class="container">
		   			<div class="col-md-6 col-md-offset-3 col-md-pull-3 js-fullheight slider-text">
		   				<div class="slider-text-inner">
		   					<div class="desc">
		   						<span class="price">$540</span>
		   						<h2>Samsung Galaxy Z Fold4</h2>
		   						<p>Galaxy Z Fold4 (2022) ra mắt với ngoại hình gần như là không đổi khi so với Galaxy Z Fold3, nếu bạn chỉ nhìn bề ngoài thì bạn sẽ khó lòng phân biệt được 2 sản phẩm này. Máy vẫn sử dụng khung viền Armor Aluminum bền bỉ, mặt kính màn hình phụ là Corning Gorilla Glass Victus+, mặt kính màn hình chính là Ultra Thin Glass.</p>
			   					{{-- <p><a href="single.html" class="btn btn-primary btn-outline btn-lg">Purchase Now</a></p> --}}
		   					</div>
		   				</div>
		   			</div>
		   		</div>
		   	</li>
		  	</ul>
	  	</div>
	</aside>

	<div id="fh5co-services" class="fh5co-bg-section">
		<div class="container">
			<div class="row">
				<div class="col-md-4 col-sm-4 text-center">
					<div class="feature-center animate-box" data-animate-effect="fadeIn">
						<span class="icon">
							<i class="fa-solid fa-credit-card"></i>
						</span>
						<h3>Credit Card</h3>
					</div>
				</div>
				<div class="col-md-4 col-sm-4 text-center">
					<div class="feature-center animate-box" data-animate-effect="fadeIn">
						<span class="icon">
							<i class="fa-solid fa-wallet"></i>
						</span>
						<h3>Save Money</h3>
					</div>
				</div>
				<div class="col-md-4 col-sm-4 text-center">
					<div class="feature-center animate-box" data-animate-effect="fadeIn">
						<span class="icon">
							<i class="fa-solid fa-paper-plane"></i>
						</span>
						<h3>Free Delivery</h3>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div id="fh5co-product">
		<div class="container">
			<div class="row animate-box">
				<div class="col-md-8 col-md-offset-2 text-center fh5co-heading">
					<span>Cool Stuff</span>
					<h2>Products.</h2>
					<p>Dignissimos asperiores vitae velit veniam totam fuga molestias accusamus alias autem provident. Odit ab aliquam dolor eius.</p>
				</div>
			</div>
			<div class="row">
				@forelse ($user as $item)
				<div class="col-md-4 text-center animate-box">
					<div class="product">
						<div class="product-grid" style="background-image:url({{ asset('/storage/'.$item->img_product) }});">
							<div class="inner">
								<p>
									<a href="#" class="icon"><i class="fa-solid fa-cart-shopping add_to_cart" data-url="{{ route('us.addToCart',['id'=>$item->id]) }}"></i></a>
									<a href="{{ route('us.detail',['id'=>$item->id]) }}" class="icon"><i class="fa-solid fa-eye"></i></a>
								</p>
							</div>
						</div>
						<div class="desc">
							<h3><a href="single.html">{{$item->name_product}}</a></h3>
							<span class="price">{{ number_format($item->price_product, 0, ',', '.') }} VND</span>
						</div>
					</div>
				</div>
				@empty
				<h1 style="margin-left: 350px">There is no product like your search,pls type another name !!!</h1>
				@endforelse
			</div>
			{{ $user->links() }}
		</div>
	</div>
	
	{{-- <div id="fh5co-testimonial" class="fh5co-bg-section">
		<div class="container">
			<div class="row animate-box">
				<div class="col-md-8 col-md-offset-2 text-center fh5co-heading">
					<span>Testimony</span>
					<h2>Happy Clients</h2>
				</div>
			</div>
			<div class="row">
				<div class="col-md-10 col-md-offset-1">
					<div class="row animate-box">
						<div class="owl-carousel owl-carousel-fullwidth">
							<div class="item">
								<div class="testimony-slide active text-center">
									<figure>
										<img src="images/person1.jpg" alt="user">
									</figure>
									<span>Jean Doe, via <a href="#" class="twitter">Twitter</a></span>
									<blockquote>
										<p>&ldquo;Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts. Separated they live in Bookmarksgrove right at the coast of the Semantics, a large language ocean.&rdquo;</p>
									</blockquote>
								</div>
							</div>
							<div class="item">
								<div class="testimony-slide active text-center">
									<figure>
										<img src="images/person2.jpg" alt="user">
									</figure>
									<span>John Doe, via <a href="#" class="twitter">Twitter</a></span>
									<blockquote>
										<p>&ldquo;Separated they live in Bookmarksgrove right at the coast of the Semantics, a large language ocean.&rdquo;</p>
									</blockquote>
								</div>
							</div>
							<div class="item">
								<div class="testimony-slide active text-center">
									<figure>
										<img src="images/person3.jpg" alt="user">
									</figure>
									<span>John Doe, via <a href="#" class="twitter">Twitter</a></span>
									<blockquote>
										<p>&ldquo;Far from the countries Vokalia and Consonantia, there live the blind texts. Separated they live in Bookmarksgrove right at the coast of the Semantics, a large language ocean.&rdquo;</p>
									</blockquote>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div> --}}
	

	{{-- <div id="fh5co-counter" class="fh5co-bg fh5co-counter" style="background-image:url(images/img_bg_5.jpg);">
		<div class="container">
			<div class="row">
				<div class="display-t">
					<div class="display-tc">
						<div class="col-md-3 col-sm-6 animate-box">
							<div class="feature-center">
								<span class="icon">
									<i class="icon-eye"></i>
								</span>

								<span class="counter js-counter" data-from="0" data-to="22070" data-speed="5000" data-refresh-interval="50">1</span>
								<span class="counter-label">Creativity Fuel</span>

							</div>
						</div>
						<div class="col-md-3 col-sm-6 animate-box">
							<div class="feature-center">
								<span class="icon">
									<i class="icon-shopping-cart"></i>
								</span>

								<span class="counter js-counter" data-from="0" data-to="450" data-speed="5000" data-refresh-interval="50">1</span>
								<span class="counter-label">Happy Clients</span>
							</div>
						</div>
						<div class="col-md-3 col-sm-6 animate-box">
							<div class="feature-center">
								<span class="icon">
									<i class="icon-shop"></i>
								</span>
								<span class="counter js-counter" data-from="0" data-to="700" data-speed="5000" data-refresh-interval="50">1</span>
								<span class="counter-label">All Products</span>
							</div>
						</div>
						<div class="col-md-3 col-sm-6 animate-box">
							<div class="feature-center">
								<span class="icon">
									<i class="icon-clock"></i>
								</span>

								<span class="counter js-counter" data-from="0" data-to="5605" data-speed="5000" data-refresh-interval="50">1</span>
								<span class="counter-label">Hours Spent</span>

							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div> --}}

	{{-- <div id="fh5co-started">
		<div class="container">
			<div class="row animate-box">
				<div class="col-md-8 col-md-offset-2 text-center fh5co-heading">
					<h2>Newsletter</h2>
					<p>Just stay tune for our latest Product. Now you can subscribe</p>
				</div>
			</div>
			<div class="row animate-box">
				<div class="col-md-8 col-md-offset-2">
					<form class="form-inline">
						<div class="col-md-6 col-sm-6">
							<div class="form-group">
								<label for="email" class="sr-only">Email</label>
								<input type="email" class="form-control" id="email" placeholder="Email">
							</div>
						</div>
						<div class="col-md-6 col-sm-6">
							<button type="submit" class="btn btn-default btn-block">Subscribe</button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div> --}}
	@include('cilent.layouts.footer')
	</div>

	<div class="gototop js-top">
		<a href="#" class="js-gotop"><i class="fa-solid fa-arrow-up"></i></a>
	</div>
	
	@include('cilent.layouts.jqueryBoostrap')

	</body>
</html>


<nav class="fh5co-nav" role="navigation">
    <div class="container">
        <div class="row">
            <div class="col-md-3 col-xs-2">
                <div id="fh5co-logo"><a href="{{ route('us.index') }}">Shop.</a></div>
            </div>
            <div class="col-md-6 col-xs-6 text-center menu-1">
                <ul>
                    <li class="has-dropdown">
                        <a href="product.html">Shop</a>
                        <ul class="dropdown">
                            <li><a href="single.html">Single Shop</a></li>
                        </ul>
                    </li>
                    <li><a href="{{ route('us.about') }}">About</a></li>
                    {{-- <li class="has-dropdown">
                        <a href="services.html">Services</a>
                        <ul class="dropdown">
                            <li><a href="#">Web Design</a></li>
                            <li><a href="#">eCommerce</a></li>
                            <li><a href="#">Branding</a></li>
                            <li><a href="#">API</a></li>
                        </ul>
                    </li> --}}
                    <li><a href="{{ route('us.contact') }}">Contact</a></li>
                    @if (session()->get('user_login_id'))
                    <li class="has-dropdown">
                        <a href="#">**{{ session()->get('name_customer') }}**</a>
                        <ul class="dropdown">
                            <li><a href="{{ route('us.profile') }}"><i class="fa-solid fa-user"></i>
                                    Profile</a></li>
                            <li><a href="{{ route('us.user_logout') }}"><i
                                        class="fa-solid fa-arrow-right-from-bracket"></i> Logout</a></li>
                        </ul>
                    </li>
                    @else
                    <li><a href="{{ route('us.userLogin') }}">Signup<i class="fa-solid fa-user"></i></a></li>
                    @endif
                </ul>
            </div>
            <div class="col-md-2 col-xs-2 text-right hidden-xs ">
                <div class="input-group">
                    <form autocomplete="off">
                        @csrf
                        <input type="search" name="search_index_user" class="form-control bg-light border-0 small"
                            placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2"
                            value="{{ $search }}" id="index_user_keywords">
                        <div id="search_ajax_indexuser"></div>
                    </form>
                </div>
            </div>
            <div class="col-md-1 col-xs-1 text-right">
                <div class="input-group-append"><a href="{{ route('us.showCart') }}" class="cart">
                    <span><i class="fa-solid fa-cart-shopping"></i></span>
                    @if (session('cart'))
                        <span class="badge badge-danger badge-counter">{{ count(session('cart')) }}</span>
                    @else
                    <span class="badge badge-danger badge-counter">0</span>
                    @endif
                    </a>
                </div>
            </div>
        </div>
    </div>
</nav>
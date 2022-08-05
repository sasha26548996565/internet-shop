<header class="header-section">
    <div class="header-top">
        <div class="container">
            <div class="row">
                <div class="col-lg-2 text-center text-lg-left">
                    <!-- logo -->
                    <a href="{{ route('index') }}" class="site-logo">
                        <img src="{{ asset('img/logo.png') }}" alt="">
                    </a>
                </div>
                <div class="col-xl-6 col-lg-5">
                    <form class="header-search-form">
                        <input type="text" placeholder="Search on divisima ....">
                        <button><i class="flaticon-search"></i></button>
                    </form>
                </div>
                <div class="col-xl-4 col-lg-5">
                    <div class="user-panel">
                        <div class="up-item">
                            <i class="flaticon-profile"></i>
                            @guest
                                <a href="{{ route('login') }}">Sign</a> In or <a href="{{ route('register') }}">Create Account</a>
                            @endguest

                            @auth
                                <form action="{{ route('logout') }}" method="POST" style="display: inline-block;">
                                    @csrf

                                    <input type="submit" class="btn btn-link link-dark" style="text-decoration: none;" value="logout">
                                </form>
                            @endauth
                        </div>
                        <div class="up-item">
                            <div class="shopping-card">
                                <i class="flaticon-bag"></i>
                                <span id="totalQuantity">{{ $countProducts }}</span>
                            </div>
                            <a href="{{ route('cart.index') }}">Shopping Cart</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>

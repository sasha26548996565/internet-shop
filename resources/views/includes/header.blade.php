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
                    <form action="{{ route('search') }}" method="GET" class="header-search-form">
                        <input type="text" name="search" value="{{ $_GET['search'] ?? "" }}" required placeholder="Search on divisima ....">
                        <button type="submit"><i class="flaticon-search"></i></button>
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

                                    @role('admin')
                                        <a href="{{ route('admin.index') }}" class="btn btn-link"
                                            style="text-decoration: none;color: #000;">admin</a>
                                    @endrole
                                    <input type="submit" class="btn btn-link" style="text-decoration: none; color: #000;" value="logout">
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

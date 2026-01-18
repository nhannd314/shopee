<header id="site-header" class="">
    <div class="container">
        <div class="top-bar d-flex justify-content-between align-items-center">
            <div class="top-bar-left">
                <span>Siêu thị mini KMax</span>
                <span>
                    <a href="#"><i class="fab fa-facebook"></i></a>
                    <a href="#"><i class="fab fa-tiktok"></i></a>
                </span>
            </div>
            <div class="top-bar-right">
                <a href="#"><i class="far fa-bell"></i> Thông báo</a>
                <a href="#"><i class="far fa-question-circle"></i> Hỗ trợ</a>
                <a href="#" class="">Đăng ký</a>
                <a href="#" class="">Đăng nhập</a>
            </div>
        </div>

        <div class="header-main d-flex justify-content-between align-items-center">
            <div class="logo-wrapper">
                <a href="{{ route('home') }}" class="logo">
                    <img src="{{ asset('img/logo-kmax.png') }}" alt="Siêu thị mini KMax">
                </a>
            </div>

            <div class="search-wrapper d-flex">
                <input type="text" class="search-input" placeholder="Tìm kiếm sản phẩm">
                <button class="btn-search">
                    <i class="fas fa-search"></i>
                </button>
            </div>
            <div class="cart-wrapper">
                <a href="{{ route('cart.index') }}" class="cart-link d-inline-block">
                    <i class="fas fa-cart-shopping"></i>
                    <span class="cart-badge">
                        {{ session('cart') ? collect(session('cart'))->sum('quantity') : 0 }}
                    </span>
                </a>
            </div>
        </div>
        <div class="header-bottom">
            <div class="header-tags text-center">
                {!! \App\Helpers\OptionHelper::getOption('header_tags') !!}
            </div>
        </div>
    </div>
</header>
<div id="header-spacer"></div>

<header id="site-header" class="">
    <div class="container">
        <div class="top-bar d-none d-lg-flex justify-content-between align-items-center">
            <div class="top-bar-left">
                <span>Siêu thị mini KMax</span>
                <span>
                    <a href="{{ settings()->facebook }}"><i class="fab fa-facebook"></i></a>
                    <a href="{{ settings()->tiktok }}"><i class="fab fa-tiktok"></i></a>
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

            <form class="search-wrapper d-flex" method="get" action="{{ route('search') }}">
                <input type="text" name="key" class="search-input" placeholder="Tìm kiếm sản phẩm">
                <button class="btn-search" type="submit">
                    <i class="fas fa-search"></i>
                </button>
            </form>
            <div class="cart-wrapper">
                <a href="{{ route('cart.index') }}" class="cart-link d-inline-block">
                    <i class="fas fa-cart-shopping"></i>
                    <span class="cart-badge">
                        {{ session('cart') ? collect(session('cart'))->sum('quantity') : 0 }}
                    </span>
                </a>
            </div>
        </div>
        <div class="header-bottom d-none d-lg-block">
            <div class="header-tags text-center">
                @php $tags = array_map('trim', explode(',', settings()->search_tags)) @endphp
                @forelse($tags as $tag)
                    <a href="{{ url('/search?key='. $tag) }}">{{ $tag }}</a>
                @empty
                @endforelse
            </div>
        </div>
    </div>
</header>
<div id="header-spacer"></div>

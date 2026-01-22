<footer>
    <div class="footer-top">
        <div class="container">
            <div class="row">
                <div class="col-md-3 col-sm-6">
                    <div class="widget">
                        <p>
                            <img src="{{ asset('img/logo-kmax-red.png') }}" alt="Logo siêu thị KMax" class="logo" style="max-width: 150px">
                        </p>
                        <!--<p>
                            Siêu thị mini - cửa hàng tiện ích KMax<br>
                            Số giấy phép DKKD: ...<br>
                            Cấp ngày ... tại ...<br>
                            Địa chỉ: Thạch An, Kim Tân, Thanh Hóa (đối diện nhà máy giày Thạch Định)<br>
                            Hotline: <a href="tel:0979198880">097-919-8880</a> | <a href="tel:0888112626">0888-11-2626</a><br>
                            Facebook: <a href="https://www.facebook.com/sieuthikmax" target="_blank" rel="nofollow">Siêu thị KMax</a><br>
                            Website: <a href="https://www.kmax.com.vn" target="_blank" rel="nofollow">https://kmax.com.vn</a>
                        </p>-->
                        <p>{!! settings()->footer_text !!}</p>
                    </div>
                </div>

                @for ($i=1;$i<4;$i++)
                    <div class="col-md-3 col-sm-6">
                        <div class="widget">
                            @php
                                $menuKey = "footer_menu_{$i}";
                                $footer_menu = settings()->$menuKey
                            @endphp
                            <h4 class="title">{{ $footer_menu['menu_title'] }}</h4>
                            <ul class="footer-links">

                                @foreach ($footer_menu['items'] as $item)
                                    <li><a href="{{ $item['link'] }}">{{ $item['text'] }}</a></li>
                                @endforeach

                            </ul>
                        </div>
                    </div>
                @endfor

            </div>
        </div>
    </div>
    <div class="footer-bottom">
        <div class="container">
            <div class="wrapper">
                <div class="row align-items-center">
                    <div class="col">
                        <img src="{{ asset('img/bo-cong-thuong.png') }}" alt="Đã đăng ký Bộ Công thương" style="max-width: 100px" />
                    </div>
                    <div class="col text-right copyright">
                        © 2026 - Bản quyền thuộc về KMax
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>

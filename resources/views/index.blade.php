@extends('layouts.app')

@section('content')
    <div class="container">
        {{-- Banner & Flash Sale ở đây --}}
        <x-slide />
        <div class="main-section list-categories">
            <h3 class="main-title">DANH MỤC</h3>
            <div class="grid-board">
                @foreach ($categories as $category)
                    <a href="{{ route('category', $category) }}" class="item">{{ $category->name }}</a>
                @endforeach
            </div>
        </div>

        <x-products-best-seller limit="30" />
        <x-products-sale-off limit="30" />

        @foreach($productGroups as $group)
            <x-products-by-category
                :cat="implode(',', $group->category_ids)"
                limit="30"
                :title="$group->title"
            />
        @endforeach

    </div>
    <div class="benefit-wrapper">
        <div class="container">
            <div class="row gx-5">
                <div class="col-md-3 col-sm-6">
                    <div class="benefit-item">
                        <img src="{{ asset('img/hang-chat-luong.png') }}" alt="Hàng chất lượng">
                        <h4 class="title">Hàng chất lượng</h4>
                        <p>Sản phẩm của KMax được nhập khẩu từ các công ty lớn, có thương hiệu, có nguồn gốc rõ ràng, có hóa đơn chứng từ đầy đủ</p>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6">
                    <div class="benefit-item">
                        <img src="{{ asset('img/mien-phi-giao-hang.png') }}" alt="Miễn phí giao hàng">
                        <h4 class="title">Miễn phí giao hàng</h4>
                        <p>Miễn phí giao hàng với mọi đơn hàng trong bán kính 2km, và đơn hàng từ 300k trong vòng bán kính 10km</p>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6">
                    <div class="benefit-item">
                        <img src="{{ asset('img/doi-tra-mien-phi.png') }}" alt="Đổi trả miễn phí không cần lý do">
                        <h4 class="title">Đổi trả miễn phí</h4>
                        <p>Đổi trả miễn phí trong vòng 3 ngày không cần lý do, miễn sản phẩm còn nguyên bao bì</p>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6">
                    <div class="benefit-item">
                        <img src="{{ asset('img/tich-diem-doi-qua.png') }}" alt="Quà tặng & trúng thưởng">
                        <h4 class="title">Quà tặng & trúng thưởng</h4>
                        <p>Cơ hội nhận quà tặng hoặc tham gia bốc thăm trúng thưởng với giá trị giải thưởng cực lớn</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

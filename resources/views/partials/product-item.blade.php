<div class="item col-6 col-md-2 d-flex align-items-stretch">
    <div class="wrapper product-wrapper d-flex flex-column">
        <a href="{{ route('product', $product) }}">
            <div class="img-wrapper">
                <img src="{{ $product->featured_image }}" alt="{{ $product->name }}">
                @if ($product->sale_percent)
                    <span class="sale-badge">-{{ $product->sale_percent }}%</span>
                @endif
            </div>
            <h3 class="title">{{ $product->name }}</h3>
            <div class="price">
                <span class="sale">{{ $product->formatted_price }}</span>
                <span class="regular">{{ $product->formatted_regular_price }}</span>
            </div>
        </a>
        <div class="text-center mt-auto">
            <a class="add-to-cart btn btn-primary" href="javascript:void(0)" data-id="{{ $product->id }}"
            data-url="{{ route('cart.add') }}">
                <i class="fa-solid fa-cart-plus"></i> Thêm vào giỏ
            </a>
        </div>
    </div>
</div>

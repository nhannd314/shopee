<div class="pb-3">

    @foreach($cart as $id => $details)
        <div class="cart-item row align-items-center mb-3 cart-item-{{ $id }}">
            <div class="col">
                <a href="{{ route('product', $details['slug']) }}" target="_blank" class="d-flex align-items-center">
                    <img src="{{ $details['image'] }}" width="80" class="rounded me-3 d-none d-lg-block" alt="{{ $details['name'] }}">
                    <span>{{ $details['name'] }}</span>
                </a>
            </div>

            <div class="col-auto text-right">
                <span>{{ number_format($details['price']) }}đ</span>
            </div>

            <div class="col-auto">

                @include('partials.product-quantity')

            </div>

            <div class="col-auto text-right" style="min-width: 90px">
                <span class="subtotal fw-bold text-danger">{{ number_format($details['price'] * $details['quantity']) }}đ</span>
            </div>

            <div class="col-auto text-right">
                <a href="javascript:void(0)"
                   class="text-decoration-underline remove-from-cart"
                   data-id="{{ $id }}">xóa</a>
            </div>
        </div>
    @endforeach

</div>
<div class="d-flex justify-content-between mb-2">
    <span>Tạm tính:</span>
    <span class="total-price fw-bold">{{ number_format($total) }}đ</span>
</div>
<div class="d-flex justify-content-between mb-3">
    <span>Phí vận chuyển:</span>
    <span class="text-success">Miễn phí</span>
</div>
<hr>
<div class="d-flex justify-content-between">
    <span class="h5">Tổng cộng:</span>
    <span class="total-price h5 fw-bold text-danger">{{ number_format($total) }}đ</span>
</div>

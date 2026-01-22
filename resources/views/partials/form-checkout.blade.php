@if (session('error'))
    <p class="text-danger">{{ session('error') }}</p>
@endif
<form action="{{ route('checkout') }}" method="POST" id="checkout-form">
    @csrf
    <div class="mb-3">
        <label class="form-label small fw-bold">Họ và tên *</label>
        <input type="text" name="customer_name" class="form-control" required>
    </div>

    <div class="mb-3">
        <label class="form-label small fw-bold">Số điện thoại *</label>
        <input type="tel" name="phone" class="form-control" required>
    </div>

    <div class="mb-3">
        <label class="form-label small fw-bold">Địa chỉ giao hàng *</label>
        <textarea name="shipping_address" class="form-control" rows="3" required></textarea>
    </div>

    <div class="mb-4">
        <label class="form-label small fw-bold">Ghi chú đơn hàng</label>
        <textarea name="note" class="form-control" rows="3"></textarea>
    </div>

    <button type="submit" class="btn btn-danger btn-lg w-100 py-3 fw-bold">
        ĐẶT HÀNG
    </button>
</form>

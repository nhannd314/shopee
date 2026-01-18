@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="main-section">
            <h3 class="main-title">Giỏ hàng của bạn</h3>

            @if(empty($cart))
                <div class="mb-4">
                    <i class="fas fa-shopping-basket fa-4x text-muted mb-3"></i>
                    <p>Giỏ hàng đang trống!</p>
                    <a href="/" class="btn btn-primary">Tiếp tục mua sắm</a>
                </div>
            @else
                <div class="row">
                    <div class="col-lg-7">
                        <div class="table-responsive main-section">
                            <table class="table align-middle">
                                <thead>
                                <tr>
                                    <th>Sản phẩm</th>
                                    <th>Giá</th>
                                    <th>Số lượng</th>
                                    <th>Thành tiền</th>
                                    <th></th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($cart as $id => $details)
                                    <tr data-id="{{ $id }}">
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <img src="{{ $details['image'] }}" width="60" class="rounded me-3">
                                                <span class="fw-bold text-truncate" style="max-width: 200px;">{{ $details['name'] }}</span>
                                            </div>
                                        </td>
                                        <td>{{ number_format($details['price']) }}đ</td>
                                        <td>
                                            <div class="input-group" style="width: 120px;">
                                                <button class="btn btn-sm btn-outline-secondary update-cart" data-type="minus">-</button>
                                                <input type="number" class="form-control form-control-sm text-center qty-input" value="{{ $details['quantity'] }}" readonly>
                                                <button class="btn btn-sm btn-outline-secondary update-cart" data-type="plus">+</button>
                                            </div>
                                        </td>
                                        <td class="subtotal">{{ number_format($details['price'] * $details['quantity']) }}đ</td>
                                        <td>
                                            <button class="btn btn-sm btn-link text-danger remove-from-cart"><i class="fas fa-trash"></i></button>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            <div class="d-flex justify-content-between mb-2">
                                <span>Tạm tính:</span>
                                <span class="total-price fw-bold">{{ number_format($total) }}đ</span>
                            </div>
                            <div class="d-flex justify-content-between mb-3">
                                <span>Phí vận chuyển:</span>
                                <span class="text-success">Miễn phí</span>
                            </div>
                            <hr>
                            <div class="d-flex justify-content-between mb-4">
                                <span class="h5">Tổng cộng:</span>
                                <span class="h5 total-price text-danger">{{ number_format($total) }}đ</span>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-5">
                        <div class="main-section">
                            <h5 class="card-title mb-4">Thông tin đặt hàng</h5>
                            <form action="{{ route('checkout') }}" method="POST" id="checkout-form">
                                @csrf
                                <div class="mb-3">
                                    <label class="form-label small fw-bold">Họ và tên *</label>
                                    <input type="text" name="full_name" class="form-control" placeholder="Nguyễn Văn A" required>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label small fw-bold">Số điện thoại *</label>
                                    <input type="tel" name="phone" class="form-control" placeholder="0901234567" required>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label small fw-bold">Địa chỉ giao hàng *</label>
                                    <textarea name="address" class="form-control" rows="2" placeholder="Số nhà, tên đường, phường/xã..." required></textarea>
                                </div>

                                <div class="mb-4">
                                    <label class="form-label small fw-bold">Ghi chú đơn hàng</label>
                                    <textarea name="note" class="form-control" rows="2" placeholder="Yêu cầu đặc biệt về giao hàng..."></textarea>
                                </div>

                                <button type="submit" class="btn btn-danger btn-lg w-100 py-3 fw-bold">
                                    ĐẶT HÀNG
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            @endif

        </div>
    </div>
@endsection

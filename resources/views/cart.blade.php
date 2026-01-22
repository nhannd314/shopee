@extends('layouts.app')

@section('content')
    <div class="container">
        <x-breadcrumb :items="$breadcrumb" />
        @if(empty($cart))
            <div class="p-5 text-center main-section">
                <i class="fas fa-shopping-basket fa-4x text-muted mb-3"></i>
                <p>Giỏ hàng đang trống!</p>
                <a href="/" class="btn btn-primary">Tiếp tục mua sắm</a>
            </div>
        @else
            <div class="row">
                <div class="col-lg-8">
                    <div class="main-section">
                        <h1 class="main-title">Giỏ hàng của bạn</h1>
                        <div class="p-3">@include('partials.cart-table')</div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="main-section">
                        <h4 class="main-title">Thông tin đặt hàng</h4>
                        <div class="p-3">@include('partials.form-checkout')</div>
                    </div>
                </div>
            </div>
        @endif
    </div>
@endsection

@section('scripts')
    @vite(['resources/js/cart.js'])
@endsection

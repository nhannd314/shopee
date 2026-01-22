@extends('layouts.app')

@section('content')
    <div class="container single-product product-wrapper">

        <x-breadcrumb :items="$breadcrumb" />

        <div class="row">
            {{-- Khối ảnh Gallery (Bên trái) --}}
            <div class="col-md-5">
                <div class="main-image border mb-2">
                    <img src="{{ $product->featured_image }}" class="img-fluid w-100" id="current-img"
                         alt="{{ $product->name }}">
                </div>
                <div class="thumb-images d-flex gap-2">
                    @foreach($product->getMedia('products_gallery') as $media)
                        <img src="{{ $media->getUrl() }}"
                             class="img-thumbnail"
                             style="width: 80px; cursor: pointer"
                             onclick="document.getElementById('current-img').src='{{ $media->getUrl() }}'"
                             alt="{{ $product->name }}">
                    @endforeach
                </div>
            </div>

            {{-- Khối thông tin (Bên phải) --}}
            <div class="col-md-7">
                <h1 class="h2">{{ $product->name }}</h1>
                <div class="price-box py-3 border-bottom border-top my-3">
                    <span class="text-danger h3 fw-bold">{{ $product->formatted_price }}</span>
                    @if($product->sale_price)
                        <del class="text-muted ms-2">{{ $product->formatted_regular_price }}</del>
                    @endif
                </div>

                <div class="short-description my-4">
                    {!! $product->description !!}
                </div>

                <div class="d-flex align-items-center my-3">
                    <div class="me-5 text-nowrap">Số lượng</div>

                    @include('partials.product-quantity')

                </div>
                <button class="btn btn-primary add-to-cart" id="add-to-cart" data-id="{{ $product->id }}"
                data-url="{{ route('cart.add') }}">
                    <i class="fas fa-cart-plus"></i> THÊM VÀO GIỎ
                </button>
            </div>
        </div>

    </div>
@endsection

@section('scripts')
    @vite(['resources/js/product.js'])
@endsection

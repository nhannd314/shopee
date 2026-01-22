@extends('layouts.app')

@section('content')
    <div class="container">

        {{-- Banner & Flash Sale ở đây --}}
        <x-slide />

        <x-breadcrumb :items="$breadcrumb" />

        <div class="main-section products">
            <h1 class="main-title">{{ $category->name }}</h1>
            <div class="row g-custom">
                @forelse($products as $product)
                    @include('partials.product-item')
                @empty
                    <p>Chưa có sản phẩm.</p>
                @endforelse
            </div>
            <div class="d-flex justify-content-center">
                {{ $products->links() }}
            </div>
        </div>
    </div>
@endsection

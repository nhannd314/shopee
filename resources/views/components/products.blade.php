<div class="main-section products">
    <h2 class="main-title">{{ $title }}</h2>
    <div class="row g-custom">
        @forelse($products as $product)
            @include('partials.product-item')
        @empty

        @endforelse
    </div>
</div>

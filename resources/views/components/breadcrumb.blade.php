<nav aria-label="breadcrumb" class="py-3">
    <ol class="breadcrumb mb-0">
        {{-- Luôn có mục Trang chủ mặc định --}}
        <li class="breadcrumb-item">
            <a href="{{ url('/') }}" class="text-decoration-none">Trang chủ</a>
        </li>

        @foreach($items as $item)
            @if ($loop->last)
                {{-- Mục cuối cùng là trang hiện tại (Active) --}}
                <li class="breadcrumb-item active" aria-current="page">
                    {{ $item['label'] }}
                </li>
            @else
                {{-- Các mục trung gian --}}
                <li class="breadcrumb-item">
                    <a href="{{ $item['url'] }}" class="text-decoration-none">
                        {{ $item['label'] }}
                    </a>
                </li>
            @endif
        @endforeach
    </ol>
</nav>

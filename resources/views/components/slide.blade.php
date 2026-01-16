@php
    $slides = \App\Models\Slide::orderBy('order', 'asc')->get();
@endphp

<div id="mainSlide" class="carousel slide mb-3" data-bs-ride="carousel">
    <div class="carousel-indicators">
        @foreach($slides as $index => $slide)
            <button type="button" data-bs-target="#mainSlide" data-bs-slide-to="{{ $index }}" class="{{ $index == 0 ? 'active' : '' }}" aria-current="true"></button>
        @endforeach
    </div>
    <div class="carousel-inner">
        @foreach($slides as $index => $slide)
            <div class="carousel-item{{ $index == 0 ? ' active' : '' }}">
                <img src="{{ $slide->getFirstMediaUrl('slides_image') }}" class="d-block w-100" alt="slider 1">
            </div>
        @endforeach
    </div>
    <button class="carousel-control-prev" type="button" data-bs-target="#mainSlide" data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Previous</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#mainSlide" data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Next</span>
    </button>
</div>

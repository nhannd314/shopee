@extends('layouts.app')

@section('content')
    <div class="container">
        {{-- Banner & Flash Sale ở đây --}}
        <x-slide />
        <div class="main-section list-categories">
            <h3 class="main-title">DANH MỤC</h3>
            <div class="grid-board">
                @foreach ($categories as $category)
                    <a href="{{ route('category', $category) }}" class="item">{{ $category->name }}</a>
                @endforeach
            </div>
        </div>

        <x-products-best-seller limit="30" />
        <x-products-sale-off limit="30" />

        @foreach($categoryGroups as $group)
            <x-products-by-category
                :cat="implode(',', $group->category_ids)"
                limit="30"
                :title="$group->title"
            />
        @endforeach

    </div>

    @include('partials.benefit')

@endsection

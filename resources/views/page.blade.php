@extends('layouts.app')

@section('content')
    <div class="container">
        {{-- Banner & Flash Sale ở đây --}}
        <x-slide />

        <x-breadcrumb :items="$breadcrumb" />

        <div class="main-section list-categories">
            <h3 class="main-title">{{ $page->title }}</h3>
            <div class="p-3">
                {!! $page->content !!}
            </div>
        </div>
    </div>

    @include('partials.benefit')

@endsection

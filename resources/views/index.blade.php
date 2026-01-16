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
    </div>
@endsection

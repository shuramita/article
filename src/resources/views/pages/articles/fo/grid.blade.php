@extends('layouts.front')

@section('content')
    @include('block.slider.farmer')
    @include('pages.articles.partial.category-info')
    @include('modules.article.grid')
@endsection
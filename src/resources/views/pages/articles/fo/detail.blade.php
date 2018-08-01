@extends('layouts.front')

@section('content')
    <section class="article-detail">
        @include('pages.articles.partial.category-info')
        @include('pages.articles.partial.single')
    </section>
@endsection
@extends('Admin::layouts.app')

@section('content')
    <section name="module" js="article" >
        <div class="row">
            <div class="col-md-12">
                @include('Article::pages.articles.bo.toolbar')
            </div>

        </div>
        <div class="row">
            <div class="col">
                <table class="table table table-striped">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>title</th>
                        <th>Category</th>
                        <th>Description</th>
                        <th>Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($articles as $article)
                        @include('Article::pages.articles.bo.list-single')
                    @endforeach
                    </tbody>
                </table>

                <div class="pagination">
                    {{$articles->links()}}
                </div>
            </div>

        </div>
    </section>
    <link href="{{ asset('css/article/article.css') }}" rel="stylesheet">
    <!-- Scripts -->
    <script src="{{ asset('js/article/article.js') }}" defer></script>
@endsection
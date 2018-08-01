@extends('Admin::layouts.app')

@section('content')
    <section name="module" js="category" >
        <div class="row">
            <div class="col-md-12">
                @include('Article::pages.categories.bo.toolbar')
            </div>

        </div>
        <div class="row">
            <div class="col-md-12">
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
                    @foreach($categories as $category)
                        @include('Article::pages.categories.bo.list-single')
                    @endforeach
                    </tbody>
                </table>

                <div class="pagination">
                    {{$categories->links()}}
                </div>
            </div>

        </div>
    </section>
    <link href="{{ asset('css/article/category.css') }}" rel="stylesheet">
    <!-- Scripts -->
    <script src="{{ asset('js/article/category.js') }}" defer></script>
@endsection
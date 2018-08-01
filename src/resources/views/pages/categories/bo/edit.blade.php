@extends('Admin::layouts.app')

@section('content')
    <section class="category" name="module" js="category" >
        <div class="">
            <div class="header">
                @isset($category)
                    <h1>Edit Category</h1>
                @else
                    <h1>Add new Category</h1>
                @endisset
            </div>

            <div class="form">
                <div class="row">
                    <div class="col-md-8 col-sm-12">
                        <div class="col-md-4 col-sm-12"></div>
                        <input type="hidden" name="category_id" id="categoryID" @isset($category) value="{{$category->id or ''}}" @endisset/>
                        <div class="form-group">
                            <label for="categoryName">{{__('Category name')}}</label>
                            <input type="text" class="form-control" name="category_name" id="categoryName" aria-describedby="categoryName" placeholder="{{__('Name of category')}}" @isset($category) value="{{$category->name or ''}}" @endisset>
                            <small id="categoryName" class="form-text text-muted">Enter name of category that will use for display in category list.</small>
                        </div>
                        <div class="form-group">
                            <label for="categoryCategory">{{__('Parent Category')}}</label>
                            @if(isset($category))
                                @include('Article::controls.category-droplist',['cat_selected'=>$category->parent,'content_type'=>'category'])
                            @else
                                @include('Article::controls.category-droplist',['content_type'=>'category'])
                            @endif
                            <small id="categoryName" class="form-text text-muted">Select parent category that will use for display in category list.</small>
                        </div>
                        <div class="form-group">
                            <label for="categoryDescription">{{__('Category Description')}}</label>
                            <textarea type="text" rows="3" class="form-control" name="category_description" id="categoryDescription" aria-describedby="categoryDescription" placeholder="{{__('Description for category')}}">@isset($category) {{$category->description or ''}} @endisset</textarea>
                        </div>
                        <div class="actions">
                            @if(isset($category))
                                <span class="btn btn-primary button blue" id="updateCategory"> <i class="fa fa-floppy-o" aria-hidden="true"></i> {{__('Update category')}}</span>
                            @else

                                <span class="btn btn-primary button blue" id="saveCategory"> <i class="fa fa-floppy-o" aria-hidden="true"></i> {{__('Save category')}}</span>
                            @endif

                        </div>
                    </div>
                    {{--<div class="col-md-4 col-sm-12">--}}
                        {{--<div class="form-group">--}}
                            {{--<label for="category-name">{{__('Category Photos')}}</label>--}}
                            {{--@isset($category)--}}
                                {{--@include('Article::controls.photo',['content'=>$category])--}}
                            {{--@else--}}
                                {{--@include('Article::controls.photo')--}}
                            {{--@endisset--}}
                        {{--</div>--}}
                    {{--</div>--}}
                </div>
            </div>


        </div>
    </section>
    <link href="{{ asset('css/article/category.css') }}" rel="stylesheet">
    <!-- Scripts -->
    <script src="{{ asset('js/article/category.js') }}" defer></script>

@endsection
@extends('Admin::layouts.app')

@section('content')
    <section class="article" name="module" js="article" >
        <div class="">
            <div class="header">
                @isset($article)
                    <h1>Edit Article</h1>
                @else
                    <h1>Add new Article</h1>
                @endisset
            </div>

            <div class="form">
                <div class="row">
                    <div class="col-md-8 col-sm-12">
                        <div class="col-md-4 col-sm-12"></div>
                        <input type="hidden" name="article_id" id="articleID" @isset($article) value="{{$article->id or ''}}" @endisset/>
                        <div class="form-group">
                            <label for="articleName">{{__('Article title')}}</label>
                            <input type="text" class="form-control" name="article_name" id="articleName" aria-describedby="articleName" placeholder="{{__('Name of article')}}" @isset($article) value="{{$article->title or ''}}" @endisset>
                            <small id="articleName" class="form-text text-muted">Enter name of article that will use for display in article list.</small>
                        </div>
                        <div class="form-group">
                            <label for="articleCategory">{{__('Article Category')}}</label>
                            @if(isset($article))
                                @include('Article::controls.category-droplist',['cat_selected'=>$article->category_id,'content_type'=>'article'])
                            @else
                                @include('Article::controls.category-droplist',['content_type'=>'article'])
                            @endif
                            <small id="articleName" class="form-text text-muted">Enter name of article that will use for display in article list.</small>
                        </div>
                        <div class="form-group">
                            <label for="articleDescription">{{__('Article Description')}}</label>
                            <textarea type="text" rows="3" class="form-control" name="article_description" id="articleDescription" aria-describedby="articleDescription" placeholder="{{__('Description for article')}}">@isset($article) {{$article->description or ''}} @endisset</textarea>
                        </div>
                        <div class="form-group">
                            <label for="articleBody">{{__('Article Content')}}</label>
                            @include('Article::controls.editor.toolbar')
                            @include('Article::controls.editor.images')
                            <div id="articleBody">
                                @isset($article)  {!! $article->body !!} @endisset
                            </div>
                        </div>
                        <div class="actions">
                            @if(isset($article))
                                <span class="btn btn-primary button blue" id="updateArticle"> <i class="fa fa-floppy-o" aria-hidden="true"></i> {{__('Update article')}}</span>
                            @else

                                <span class="btn btn-primary button blue" id="saveArticle"> <i class="fa fa-floppy-o" aria-hidden="true"></i> {{__('Save article')}}</span>
                            @endif

                        </div>
                    </div>
                    <div class="col-md-4 col-sm-12">
                        <div class="form-group">
                            <label for="article-name">{{__('Article Photos')}}</label>
                            @isset($article)
                            @include('Article::controls.photo',['content'=>$article])
                            @else
                            @include('Article::controls.photo')
                            @endisset
                        </div>
                    </div>
                </div>
            </div>


        </div>
    </section>
    <link href="{{ asset('css/article/article.css') }}" rel="stylesheet">
    <!-- Scripts -->
    <script src="{{ asset('js/article/article.js') }}" defer></script>

@endsection
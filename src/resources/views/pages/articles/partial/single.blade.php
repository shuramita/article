<div class="container">
    <h1>{{$article->title}}@auth <a href="{{route('admin_edit_article',['id'=>$article->id])}}"><i class="fa fa-pencil" aria-hidden="true"></i></a> @endauth</h1>
    <div class="body">
        {!! $article->body !!}
    </div>
</div>
<div class="col-md-4 col-sm-6 col-xs-12">
    <div class="slide">
        <div class="image-container">
            <a class="article-image" href="{{route('article_detail',['slug'=>$article->slug,'locale'=>App()->getLocale()!=config('app.fallback_locale')?App()->getLocale():''])}}">
                @if(isset($article->photos))
                    @php $photo = json_decode($article->photos)[0]@endphp
                    <img class="img-responsive" src="{{asset('/'.$photo->origin->uri)}}" alt="{{$article->title}}" />
                @else
                    <img class="img-responsive" src="{{asset('/images/wagon-feed-logo.png')}}" alt="{{__("Wagon Feed")}}" />
                @endif
            </a>
        </div>
        <div class="content">
            <div class="title">
                <a class="title" href="{{route('article_detail',['slug'=>$article->slug,'locale'=>App()->getLocale()!=config('app.fallback_locale')?App()->getLocale():''])}}" title="{{$article->title}}">{{$article->title}}</a>
            </div>
            <div class="category">
                <span>{{__('Category')}}</span>: <a class="category">{{$article->category_name}}</a>
            </div>
        </div>
    </div>
</div>

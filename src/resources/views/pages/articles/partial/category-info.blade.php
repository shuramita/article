@if(isset($article))
    @if(isset($article->photos) && trim($article->photos) != "")
        @php $photo = json_decode($article->photos)[0];@endphp
        <div class="banner article-banner" style="background-image: url('{{asset($photo->origin->uri)}}')">
            <div class="container">
                <div class="content">
                    <a >{{ __($article->description) }} </a>
                </div>

            </div>
        </div>
    @endif
@elseif(isset($category))
        @if(isset($category->photo) && trim($category->photo) != "")
            @php $photo = json_decode($category->photo)[0];@endphp
            <div class="banner category-banner" style="background-image: url('{{asset($photo->origin->uri)}}')">
                <div class="container">
                    <div class="content">
                        <a >{{ __($category->name) }} </a>
                    </div>

                </div>
            </div>
        @endif
    @else
@endif
@if(isset($content->photos))
    @php $photo = json_decode($content->photos)[0]@endphp
    <img class="img-responsive" src="{{asset('/'.$photo->small->uri)}}"  @isset($content->name) alt="{{$content->name }}" @endisset @isset($content->title) alt="{{$content->title }}" @endisset />
@else
    <img class="img-responsive" src="{{asset('/images/wagon-feed-logo.png')}}" alt="{{__("Wagon Feed")}}" />
@endif
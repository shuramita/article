@if(isset($categories))
<select class="form-control" id="{{$content_type}}Category">
    <option value="0">Choose...</option>
    @foreach( $categories as $category)
        <option value="{{$category->id}}" @if(isset($cat_selected) && $cat_selected == $category->id) selected @endif>{{$category->name}}</option>
    @endforeach
</select>
@endif
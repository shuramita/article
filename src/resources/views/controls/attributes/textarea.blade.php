<div class="form-group">
    <label for="{{$attribute->var_name}}">{{__($attribute->title)}}</label>
    <textarea type="text" rows="5" class="form-control" name="{{$attribute->var_name}}" id="{{$attribute->var_name}}">{{$attribute->value or ''}}</textarea>
</div>s
<tr>
    <td width="30%">
        <label for="{{$attribute->var_name}}">{{__($attribute->title)}}</label>
        <small id="{{$attribute->var_name}}Described" class="form-text text-muted">{{__($attribute->description)}}</small>
    </td>
    <td width="60%">
        <div class="form-group">
        <input class="form-control" type="text" name="{{$attribute->var_name}}" id="{{$attribute->var_name}}" aria-describedby="{{$attribute->var_name}}Described" placeholder="" value="{{$attribute->value or ''}}">
        </div>
    </td>
    <td width="10%">
        {{$attribute->unit or ''}}
    </td>
</tr>

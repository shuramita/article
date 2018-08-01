<section name="module" js="attribute">
    @isset($attributes)
        {{--use this for handle control data--}}
        <input id="{{$id or 'attrControl'}}" type="hidden" data-value="{{json_encode($attributes)}}"/>
                <table class="table table-hover">
                        <tbody>
                                <thead>
                                <tr>
                                        <th scope="col">{{__('Name')}}</th>
                                        <th scope="col">{{__('Value')}}</th>
                                        <th scope="col">{{__('Unit')}}</th>
                                </tr>
                                </thead>
                                @foreach($attributes as $attr)
                                        @if($attr->type == 'text')
                                                @include('controls.attributes.'.$attr->type,['attribute'=>$attr])
                                        @endif
                                @endforeach
                        </tbody>
                </table>
                @foreach($attributes as $attr)
                        @if($attr->type == 'textarea')
                                @include('controls.attributes.'.$attr->type,['attribute'=>$attr])
                        @endif
                @endforeach
    @endisset
</section>

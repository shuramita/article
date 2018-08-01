@isset($attributes)
    <div>
        <!-- Nav tabs -->
        <ul class="nav nav-tabs" role="tablist">
            @php
                $groups = [
                    '1'=>"Chỉ Tiêu",
                    '2'=>"Thành phần nguyên liệu Chính"
                ];
                $group_display = [];
            @endphp
            <li role="presentation" class="active">
                <a href="#attr_1" aria-controls="attr_1" role="tab" data-toggle="tab">{{__($groups[1])}}</a>
            </li>
            <li role="presentation" class="">
                <a href="#attr_2" aria-controls="attr_2" role="tab" data-toggle="tab">{{__($groups[2])}}</a>
            </li>
        </ul>

        <!-- Tab panes -->
        <div class="tab-content">
            <div role="tabpanel" class="tab-pane active" id="attr_1">
                <table class="table table-striped">
                    <tr>
                        <th>{{__("TT")}}</th>
                        <th>{{__('Chỉ Tiêu')}}</th>
                        <th>{{__('DVT')}}</th>
                        <th>{{__('Mức Chất Lượng')}}</th>
                    </tr>
                @php $index = 1; @endphp
                @foreach($attributes as $attribute)
                    @if($attribute->attr_group == 1)
                            <tr>
                                <td>{{__($index)}}</td>
                                <td>{{__($attribute->title)}}</td>
                                <td>{{__($attribute->unit)}}</td>
                                <td>{{__($attribute->value)}}</td>
                            </tr>
                            @php $index += 1; @endphp
                    @endif

                @endforeach
                </table>
            </div>
            <div role="tabpanel" class="tab-pane" id="attr_2">
                @foreach($attributes as $attribute)
                    @if($attribute->attr_group == 2)
                        <p>
                            {!! nl2br($attribute->value) !!}
                        </p>
                    @endif
                @endforeach
            </div>
        </div>

    </div>
@endisset
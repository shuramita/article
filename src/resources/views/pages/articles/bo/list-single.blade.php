<tr class="row-data">
    <th scope="row">{{$article->id}}</th>
    <td><a href="{{route('admin_edit_article',['id'=>$article->id])}}"> {{$article->title}} </a> </td>
    <td>{{$article->category_name}}</td>
    <th scope="row">{{$article->description}}</th>
    <th scope="row">
        <div class="dropdown">
            <button class="btn btn-info btn-sm dropdown-toggle" type="button" data-toggle="dropdown">Actions
                <span class="caret"></span></button>
            <ul class="dropdown-menu dropdown-menu-right">
                <a class="dropdown-item" href="{{route('admin_edit_article',['id'=>$article->id])}}" >Edit</a>
                <a class="dropdown-item delete_article" href="#" data-id="{{$article->id}}">Delete</a>
            </ul>
        </div>
    </th>
</tr>

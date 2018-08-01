<tr class="row-data">
    <th scope="row">{{$category->id}}</th>
    <td><a href="{{route('admin_edit_category',['id'=>$category->id])}}"> {{$category->name}} </a> </td>
    <td>{{$category->name}}</td>
    <th scope="row">{{$category->description}}</th>
    <th scope="row">
        <div class="dropdown">
            <button class="btn btn-info btn-sm dropdown-toggle" data-toggle="dropdown">Actions
                <span class="caret"></span></button>
            <div class="dropdown-menu dropdown-menu-right">
                <a class="dropdown-item" href="{{route('admin_edit_category',['id'=>$category->id])}}" >Edit</a>
                <a class="dropdown-item delete_category" href="#"  data-id="{{$category->id}}">Delete</a>
            </div>
        </div>
    </th>
</tr>

<div class="box">
    <div class="box-title">Custom Boxes <a href="{{URL::route('admincp-custom-boxes-add')}}">Add New Box</a> </div>

    <div class="box-content">
        <table class="table table-striped">
            <thead>
            <tr>
                <th>Title</th>
				<th>Style</th>
                <th>Created</th>
                <th>Active</th>
                <th>Action</th>
            </tr>
            </thead>

            <tbody>
                @foreach($lists as $box)
                    <tr>
                        <td>{{$box->title}}</td>
                        <td>{{$box->style_boxheader}}</a> </td>
                        <td>{{$box->created_at}}</td>
                        <td>
                            {{($box->active == 1) ? 'Yes' : 'No'}}
                        </td>
                        <td>
                            <a href="{{URL::route('admincp-custom-boxes-edit', ['slug' => $box->slug])}}">Edit</a>
                            <a href="{{URL::route('admincp-custom-boxes-delete', ['slug' => $box->slug])}}">Delete</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

    </div>
</div>
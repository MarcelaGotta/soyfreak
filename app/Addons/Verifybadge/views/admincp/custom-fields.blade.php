<div class="box">
    <div class="box-title">Request Form Custom Fields <a href="{{URL::route('verifybadge-custom-fields-add')}}">Add More Custom Field</a> </div>
    <div class="box-content">
        <ul class="nav nav-tabs">
            <li class="{{($type == 'user-form') ? 'active' : null}}"><a href="{{URL::route('verifybadge-custom-fields')}}?type=user-form">Users fields</a></li>
            <li class="{{($type == 'page-form') ? 'active' : null}}"><a href="{{URL::route('verifybadge-custom-fields')}}?type=page-form">Pages Fields</a></li>

        </ul>

        <table class="table table-striped">
            <thead>
            <tr>
                <th>Name</th>
                <th>Description</th>
                <th>Field type</th>
                <th>Action</th>
            </tr>
            </thead>

            <tbody>
            @foreach($fields as $field)
            <tr>
                <td>{{$field->name}}</td>
                <td>{{$field->description}}</td>
                <td>{{$field->field_type}}</td>
                <td>
                    <a href="{{URL::route('verifybadge-custom-fields-delete', ['id' => $field->id])}}">Delete</a>
                    <a href="{{URL::route('verifybadge-custom-fields-edit', ['id' => $field->id])}}">Edit</a>
                </td>
            </tr>
            @endforeach
            </tbody>
        </table>

    </div>
</div>
<div class="box">
    <div class="box-title">Verify Requests</div>
    <div class="box-content">
        <ul class="nav nav-tabs">
            <li class="{{($type == 'all') ? 'active' : null}}"><a href="{{URL::route('verifybadge-requests')}}?type=all">All</a></li>
            <li class="{{($type == 'user') ? 'active' : null}}"><a href="{{URL::route('verifybadge-requests')}}?type=user">Users</a></li>
            <li class="{{($type == 'page') ? 'active' : null}}"><a href="{{URL::route('verifybadge-requests')}}?type=page">Pages</a></li>

        </ul>

        <table class="table table-striped">
            <thead>
            <tr>
                <th style="width: 10%">Type</th>
                <th style="width: 70%">Information</th>

                <th style="width: 20%">Action</th>
            </tr>
            </thead>

            <tbody>
                @foreach($requests as $request)
                    <tr>
                        <td>{{$request->type}}</td>
                        <td>
                            @foreach($request->listsFields($request->type.'-form') as $field)
                                <li><strong>{{$field->name}}:</strong> {{$request->fieldValue($field->id)}}</li>
                            @endforeach
                        </td>
                        <td>
                            <a href="{{URL::route('verifybadge-request-approve', ['id' => $request->id])}}">Approve</a>
                            <a href="{{URL::route('verifybadge-request-reject', ['id' => $request->id])}}">Reject</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
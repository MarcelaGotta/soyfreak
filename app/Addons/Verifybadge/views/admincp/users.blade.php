<div class="box">
    <div class="box-title">User Lists</div>
    <div class="box-content">
        <form action="" method="get">
            <input name="term" type="text" class="form-control" placeholder="Search for users by fullname or username or email address"/>
            <br/>
            <button class="btn btn-primary btm-sm">Search</button><br/><br/>
        </form>
        <table class="table table-bordered">
            <thead>
            <tr>
                <th style="width: 3%">Avatar</th>
                <th style="width: 10%">Fullname</th>
                <th style="width: 10%">Username</th>
                <th style="width: 10%">Date Joined</th>

                <th style="width: 5%">Actions</th>
            </tr>
            </thead>
            <tbody>
            @foreach($users as $user)
            <tr>
                <td><img style="width: 30px" src="{{$user->present()->getAvatar(30)}}"/> </td>
                <td>{{$user->present()->fullName()}}</td>
                <td>{{$user->username}}</td>
                <td>{{$user->created_at}}</td>

                <td>
                    @if ($user->verified == 1)
                        <a href="{{URL::route('verifybadge-award', ['which' => 'unverify', 'type' => 'user', 'id' => $user->id])}}">UnVerify</a>
                    @else
                        <a href="{{URL::route('verifybadge-award', ['which' => 'verify', 'type' => 'user', 'id' => $user->id])}}">Verify</a>
                    @endif
                </td>
            </tr>
            @endforeach
            </tbody>
        </table>

        {{$users->links()}}
    </div>
</div>
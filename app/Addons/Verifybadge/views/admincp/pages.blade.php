<div class="box">
    <div class="box-title">Pages List</div>

    <div class="box-content">

        <form action="" method="get">
            <input name="term" type="text" class="form-control" placeholder="Search for pages by title"/>
            <br/>
            <button class="btn btn-primary btm-sm">Search</button><br/><br/>
        </form>

        <table class="table table-bordered">
            <thead>
            <tr>
                <th style="width: 40%">Title</th>
                <th style="width: 30%">Description</th>
                <th style="">By</th>
                <th>Likes</th>
                <th>Action</th>
            </tr>
            </thead>
            <tbody>
            @foreach($pages as $page)
            <tr>
                <td><a href="{{$page->present()->url()}}">{{$page->title}}</a> </td>
                <td>{{$page->description}}</td>
                <td><a href="{{$page->user->present()->url()}}">{{$page->user->fullname}}</a> </td>
                <td>{{$page->countLikes()}}</td>
                <td>
                    @if ($page->verified == 1)
                    <a href="{{URL::route('verifybadge-award', ['which' => 'unverify', 'type' => 'page', 'id' => $page->id])}}">UnVerify</a>
                    @else
                    <a href="{{URL::route('verifybadge-award', ['which' => 'verify', 'type' => 'page', 'id' => $page->id])}}">Verify</a>
                    @endif
                </td>
            </tr>
            @endforeach
            </tbody>
        </table>

        {{$pages->links()}}
    </div>
</div>
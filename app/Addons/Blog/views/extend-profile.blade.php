<li>
    <a href="{{$profileUser->present()->url('blogs')}}">
        {{app('App\\Addons\\Blog\\Classes\\BlogRepository')->countMine($profileUser->id)}}
        {{trans('blog::global.blogs')}}
    </a>
</li>
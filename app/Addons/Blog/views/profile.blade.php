<div class="box">
    <div class="box-title">{{trans('blog::global.blogs')}}</div>
    <div class="box-content">
        @foreach($blogs as $blog)
            {{Theme::section('blog::display', ['blog' => $blog])}}
        @endforeach

        {{$blogs->links()}}
    </div>
</div>
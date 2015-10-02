@if($blog->isGood())
<div class="media blog">
    <div class="media-object pull-left">
        <a href="{{$blog->user->present()->url()}}">
            <img src="{{$blog->user->present()->getAvatar(50)}}"/>
        </a>
    </div>
    <div class="media-body">
        <h5 class="media-heading"><a href="{{$blog->url()}}">{{$blog->title}}</a></h5>

            <span class="blog-time-info">
                {{trans('blog::global.posted-on')}} {{\Carbon\Carbon::instance($blog->created_at)->toFormattedDateString()}} {{trans('blog::global.by')}} <a href="{{$blog->user->present()->url()}}">{{$blog->user->fullname}}</a>
                @if($blog->category)
                    {{trans('blog::global.in')}}
                    <a href="{{URL::route('blogs')}}?category={{$blog->category->id}}">{{$blog->category->title}}</a>
                @endif
            </span>

        <p class="content">
            {{$blog->stripped()}} <a href="{{$blog->url()}}">{{trans('blog::global.read-more')}}</a>


        </p>
    </div>
</div>
@else
    <?php $blog->deleteIt();?>
@endif
@if($blog and $activity->user)
<a href="{{$blog->url()}}" data-ajaxify="true" class="activity">
    <div class="media">
        <div class="media-object pull-left"><img src="{{$blog->user->present()->getAvatar(50)}}"/> </div>
        <div class="media-body">
            <h5>{{trans('blog::global.user-added-new-blog', [
                'user' => $blog->user->present()->fullName(),
                'name' => $blog->title
                ])}}</h5>

            <span class="post-time"> <i class="icon ion-ios7-time-outline"></i> <span title="{{$activity->time()}}">{{$activity->created_at}}</span></span>
        </div>
    </div>
</a>
@else
<?php $activity->deleteIt()?>
@endif

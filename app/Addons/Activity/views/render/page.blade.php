@if($activity->page and $activity->user)
<a href="{{$activity->page->present()->url()}}" data-ajaxify="true" class="activity">
    <div class="media">
        <div class="media-object pull-left"><img src="{{$activity->user->present()->getAvatar(50)}}"/> </div>
        <div class="media-body">
            <h5>{{trans('activity::global.created-a-page', [
                'user' => $activity->user->present()->fullName(),
                'name' => $activity->page->title
                ])}}</h5>

            <span class="post-time"> <i class="icon ion-ios7-time-outline"></i> <span title="{{$activity->time()}}">{{$activity->created_at}}</span></span>
        </div>
    </div>
</a>
@else
<?php $activity->deleteIt()?>
@endif
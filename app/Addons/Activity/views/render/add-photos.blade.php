@if ($activity->album and $activity->user)

<a href="{{$activity->user->present()->url('album/'.$activity->album->slug)}}" data-ajaxify="true" class="activity">
    <div class="media">
        <div class="media-object pull-left"><img src="{{$activity->user->present()->getAvatar(50)}}"/> </div>
        <div class="media-body">
            <h5>{{trans('activity::global.added-photos', [
                'user' => $activity->user->present()->fullName(),
                'count' => $count
                ])}}</h5>

            <span class="post-time"> <i class="icon ion-ios7-time-outline"></i> <span title="{{$activity->time()}}">{{$activity->created_at}}</span></span>
        </div>
    </div>
</a>

@else
<?php $activity->deleteIt()?>
@endif
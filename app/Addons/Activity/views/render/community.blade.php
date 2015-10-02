@if($activity->community and $activity->user)
<a href="{{$activity->community->present()->url()}}" data-ajaxify="true" class="activity">
    <div class="media">
        <div class="media-object pull-left"><img src="{{$activity->user->present()->getAvatar(50)}}"/> </div>
        <div class="media-body">
            <h5>{{trans('activity::global.created-a-community', [
                'user' => $activity->user->present()->fullName(),
                'name' => $activity->community->title
                ])}}</h5>

            <span class="post-time"> <i class="icon ion-ios7-time-outline"></i> <span title="{{$activity->time()}}">{{$activity->created_at}}</span></span>
        </div>
    </div>
</a>
@else
    <?php $activity->deleteIt()?>
@endif


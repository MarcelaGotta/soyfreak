@if ($activity->post and $activity->user)
<a href="{{URL::route('post-page', ['id' => $activity->post->id])}}" data-ajaxify="true" class="activity">
    <div class="media">
        <div class="media-object pull-left"><img src="{{$activity->user->present()->getAvatar(50)}}"/> </div>
        <div class="media-body">
            <h5>{{trans('activity::global.update-status', [
                'gen' => ($activity->user->genre == 'male') ? trans('activity::global.his') : trans('activity::global.her')
                ])}}</h5>

            <span class="post-time"> <i class="icon ion-ios7-time-outline"></i> <span title="{{$activity->time()}}">{{$activity->created_at}}</span></span>
        </div>
    </div>
</a>
@else
<?php $activity->deleteIt()?>
@endif
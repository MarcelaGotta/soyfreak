<?php
    $link = null;
    $title = null;

    $delete = false;

    if (!$activity->user) $delete = true;
    if ($activity->user) {
        $userid = \Auth::user()->id;
        switch($activity->type) {
            case 'like-photo':
                if (!$activity->photo or !$activity->photo->user) {
                    $delete = true;
                } else {
                    $link = Image::url($activity->photo->path, 'original');
                    if ($activity->photo->user_id == $userid) {
                        $title = trans('activity::global.like-his-photo', [
                            'user' => $activity->user->present()->fullName()
                        ]);
                    } else {
                        $title = trans('activity::global.like-some-photo', [
                            'name' => $activity->photo->user->present()->fullName(),
                            'user' => $activity->user->present()->fullName()
                        ]);
                    }
                }
                break;
            case 'like-game':
                if ($activity->game) {
                    $link = $activity->game->present()->url();
                    $title = trans('activity::global.liked', [
                        'user' => $activity->user->present()->fullName(),
                        'name' => $activity->game->title]);
                } else {
                    $delete = true;
                }
                break;
            case 'like-page':
                if ($activity->page) {
                    $link = $activity->page->present()->url();
                    $title = trans('activity::global.liked', [
                        'user' => $activity->user->present()->fullName(),
                        'name' => $activity->page->title]);
                } else
                {
                    $delete = true;
                }
                break;
            case 'like-post':
                if ($activity->post and $activity->post->user) {
                    $link = URL::route('post-page', ['id' => $activity->post->id]);
                    if ($activity->post->user_id == $userid) {
                        $title = trans('activity::global.like-his-post', [
                            'user' => $activity->user->present()->fullName()
                        ]);
                    } else {
                        $title = trans('activity::global.like-some-post', [
                            'user' => $activity->user->present()->fullName(),
                            'name' => $activity->post->user->present()->fullName()]);
                    }
                } else {
                    $delete = true;
                }
                break;
        }
    }

?>

@if ($delete)
<?php $activity->deleteIt()?>
@else
<a {{($activity->type == 'like-photo') ? 'class="preview-image" rel="album"' : null}} href="{{$link}}"  class="activity">
<div class="media">
    <div class="media-object pull-left"><img src="{{$activity->user->present()->getAvatar(50)}}"/> </div>
    <div class="media-body">
        <h5>{{$title}}</h5>

        <span class="post-time"> <i class="icon ion-ios7-time-outline"></i> <span title="{{$activity->time()}}">{{$activity->created_at}}</span></span>
    </div>
</div>
</a>
@endif
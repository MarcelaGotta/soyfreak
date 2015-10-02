<?php $lists = app('App\\Addons\\Activity\\Classes\\ActivityRepository')->lists('all', \Config::get('activities-per-page', 10))?>

@if(count($lists))

<div class="box side-actvitiy-container">
    <div class="box-title">
        {{trans('activity::global.activities')}}
        <a data-ajaxify="true" href="{{URL::route('activity')}}" class="pull-right">{{trans('activity::global.view-all')}}</a>
    </div>
    <div data-realtime="{{Config::get('enable-realtime-activity', true)}}" data-offset="{{\Config::get('activities-per-page', 10)}}" class="box-content side-activity-list">
        @foreach($lists as $list)
        {{Theme::section($list->views, array_merge(['activity' => $list], perfectUnserialize($list->view_data)))}}
        @endforeach
    </div>
</div>
@endif
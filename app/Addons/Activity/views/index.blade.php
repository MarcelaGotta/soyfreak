<div class="container page-content clearfix">

    <div class="left-column">

        <div class="box">
            <div class="box-title">{{trans('activity::global.activities')}}</div>


            <div class="box-content main-activities-stream">
                <ul class="nav nav-tabs">
                    <li class="{{($type == 'all') ? 'active' : null}}"><a href="{{URL::route('activity')}}?type=all">{{trans('activity::global.all')}}</a></li>
                    <li class="{{($type == 'me') ? 'active' : null}}"><a href="{{URL::route('activity')}}?type=me">{{trans('activity::global.mine')}}</a></li>
                    <li class="{{($type == 'friends') ? 'active' : null}}"><a href="{{URL::route('activity')}}?type=friends">{{trans('activity::global.friends')}}</a></li>
                </ul>

                @if(!count($lists))

                    <div style="margin-top:20px" class="alert alert-info">{{trans('activity::global.no-activity')}}</div>
                @endif
                @foreach($lists as $list)
                {{Theme::section($list->views, array_merge(['activity' => $list], perfectUnserialize($list->view_data)))}}
                @endforeach
            </div>
        </div>

    </div>

    <div class="right-column">
        {{Theme::section('user.side-info')}}
        {{Theme::widget()->get('user-activities')}}
    </div>
</div>
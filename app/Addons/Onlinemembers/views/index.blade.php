<div class="container page-content clearfix">

    <div class="left-column">
        <div class="box">
            <div class="box-title">{{trans('onlinemembers::global.online-members')}}</div>
            <div class="box-content">
                <ul class="nav nav-tabs">
                    <li class="{{($gender == 'all') ? 'active' : null}}"><a href="{{URL::route('online-members')}}?gender=all">{{trans('onlinemembers::global.all')}}</a></li>
                    <li class="{{($gender == 'Gamer') ? 'active' : null}}"><a href="{{URL::route('online-members')}}?gender=Gamer">{{trans('onlinemembers::global.Gamer')}}</a></li>
                    <li class="{{($gender == 'Otaku') ? 'active' : null}}"><a href="{{URL::route('online-members')}}?gender=Otaku">{{trans('onlinemembers::global.Otaku')}}</a></li>
                    <li class="{{($gender == 'Seriéfilo') ? 'active' : null}}"><a href="{{URL::route('online-members')}}?gender=Seriéfilo">{{trans('onlinemembers::global.Seriefilo')}}</a></li>
                    <li class="{{($gender == 'Bibliófilo') ? 'active' : null}}"><a href="{{URL::route('online-members')}}?gender=Bibliófilo">{{trans('onlinemembers::global.Bibliofilo')}}</a></li>
                    <li class="{{($gender == 'Cinéfilo') ? 'active' : null}}"><a href="{{URL::route('online-members')}}?gender=Cinéfilo">{{trans('onlinemembers::global.Cinefilo')}}</a></li>
                </ul>

                @if (!count($users))
                <div class="alert alert-danger">{{trans('onlinemembers::global.no-member')}}</div>
                @endif
                @foreach($users as $user)
                {{Theme::section('user.display', ['user' => $user])}}
                @endforeach

                {{$users->appends(['gender' => Input::get('gender')])->links()}}
            </div>
        </div>
    </div>

    <div class="right-column">


        {{Theme::widget()->get('user-search')}}
    </div>
</div>
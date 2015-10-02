@if($page->isOwner() or $page->present()->isAdmin() or $page->present()->isEditor())
    @if($page->verified != 1)
        <li>
            <a  href="{{$page->present()->url('verify/request')}}">
                <i class="icon ion-checkmark-circled"></i> <span>{{trans('verifybadge::global.verify-request-form')}}</span>
            </a>
        </li>
    @endif
@endif
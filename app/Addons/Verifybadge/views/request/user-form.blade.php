<div class="box">
    <div class="box-title">{{trans('verifybadge::global.get-verified-form')}}</div>
    <div class="box-content">
        {{Theme::section('verifybadge::request.form', ['type' => 'user', 'typeId' => Auth::user()->id])}}
    </div>
</div>
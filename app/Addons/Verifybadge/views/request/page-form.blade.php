<div class="box">
    <div class="box-title">{{trans('verifybadge::global.get-verified-form')}}</div>
    <div class="box-content">
        {{Theme::section('verifybadge::request.form', ['type' => 'page', 'typeId' => $page->id])}}
    </div>
</div>
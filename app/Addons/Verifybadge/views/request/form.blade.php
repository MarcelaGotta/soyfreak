<form class="form-horizontal" action="{{URL::route('verifybadge-send-request')}}" method="post">
    <input type="hidden" name="val[type]" value="{{$type}}"/>
    <input type="hidden" name="val[type_id]" value="{{$typeId}}"/>

    @if(Session::has('successmessage'))
        <div class="alert alert-success">{{Session::get('successmessage')}}</div>
    @endif

    @if(Session::has('errormessage'))
    <div class="alert alert-danger">{{Session::get('errormessage')}}</div>
    @endif

    <div class="alert alert-info">
        {{trans('verifybadge::global.verify-form-note')}}
    </div>

    <?php $fieldsRepository = app('App\\Repositories\\CustomFieldRepository'); $fields = $fieldsRepository->listAll($type.'-form');?>

    @foreach($fields as $field)
    <div class="form-group">
        <label class="col-sm-4 control-label">{{trans($field->name)}}</label>
        <div class="col-sm-6 ">

            @if($field->field_type == 'text')
            <input type="text" class="form-control"  name="val[info][{{$field->id}}]"/>
            @elseif($field->field_type == 'textarea')
            <textarea class="form-control" name="val[info][{{$field->id}}]"></textarea>
            @elseif($field->field_type == 'selection')
            <select class="form-control" name="val[info][{{$field->id}}]">
                <?php $options = unserialize($field->data)?>
                @foreach($options as $option)
                @if($option != '')
                <option  value="{{$option}}">{{$option}}</option>
                @endif
                @endforeach
            </select>
            @endif
            <p class="help-block">{{trans($field->description)}}</p>
        </div>

    </div>
    @endforeach
    <div class="divider"></div>
    <div class="form-group">
        <div class="col-sm-offset-2 col-sm-10">
            <button type="submit" class="btn btn-sm btn-danger">{{trans('verifybadge::global.send-request')}}</button>

        </div>
    </div>
</form>
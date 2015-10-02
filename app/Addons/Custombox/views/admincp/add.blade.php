<div class="box">
    <div class="box-title">Add Normal Custom Box</div>
    <div class="box-content">
	
        <ul class="nav nav-tabs">
          <li class=""><a href="{{URL::route('admincp-custom-boxes-add')}}">Box Normal</a></li>
          <li class=""><a href="{{URL::route('admincp-custom-boxes-add-special')}}">Box Special</a></li>
        </ul>	

        @if (!empty($message))
        <div class="alert alert-danger">{{$message}}</div>
        @endif
		<br><br>
        <form class="form-horizontal" action="" method="post">

            <div class="form-group">
                <label class="col-sm-4">Headline</label>
                <div class="col-sm-7">
                    <input type="text" value="{{Input::get('val.headline')}}" class="form-control" placeholder="" name="val[headline]"/>
                </div>
            </div>
			
            <div class="form-group">
                <label class="col-sm-4">Title</label>
                <div class="col-sm-7">
                    <input type="text" value="{{Input::get('val.title')}}" class="form-control" placeholder="Box title" name="val[title]"/>
                </div>
            </div>

            <div class="form-group">
                <label class="col-sm-4">Box Access</label>
                <div class="col-sm-7">
                    <select id="custom-field-type" class="form-control" name="val[privacy]">
                        <option value="0">Public</option>
                        <option value="1">Only Members</option>
                        <option value="2">Admins</option>
                    </select>
                </div>
            </div>
			
            <div class="form-group">
                <label class="col-sm-4">Add Likes</label>
                <div class="col-sm-7">
                    <select id="custom-field-type" class="form-control" name="val[likes]">
                        <option value="1">Yes</option>
                        <option value="0">No</option>
                    </select>
                </div>
            </div>

            <div class="form-group">
                <label class="col-sm-4">Active</label>
                <div class="col-sm-7">
                    <select id="custom-field-type" class="form-control" name="val[active]">
                        <option value="1">Yes</option>
                        <option value="0">No</option>
                    </select>
                </div>
            </div>
			
            <div class="form-group">
                <label class="col-sm-4 hidden">Style of Boxheader</label>
                <div class="col-sm-7">
					<input type="hidden" value="normal" class="form-control" placeholder="normal" name="val[style_boxheader]"/>
                </div>
            </div>
						
            <div class="form-group">
                <label class="col-sm-4">Content</label>
                <div class="col-sm-7">
                    <textarea name="val[content]" class="form-control pane-editor" placeholder="Box content">{{Input::get('val.content')}}</textarea>
                </div>
            </div>
			
            <div class="form-group">
                <label class="col-sm-4">Box footer</label>
                <div class="col-sm-7">
					<input type="text" value="{{Input::get('val.footer')}}" class="form-control" placeholder="" name="val[footer]"/>
					<p class="help-block">leave empty for no footer</p>
                </div>
            </div>
			
            <div class="body-header">
                <input class="btn btn-danger no-radius" type="submit" value="Submit"/>
            </div>

        </form>
    </div>
</div>
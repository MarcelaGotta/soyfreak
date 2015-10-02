@if($box->style_boxheader == 'special')
<div class="box">
    <div class="box-title">Edit Special Box with Image.header or color</div>
    <div class="box-content">
        @if (!empty($message))
        <div class="alert alert-danger">{{$message}}</div>
        @endif
		<br><br>
        <form class="form-horizontal" action="" method="post">

            <div class="form-group">
                <label class="col-sm-4">Headline</label>
                <div class="col-sm-7">
                    <input type="text" value="{{$box->headline}}" class="form-control" placeholder="" name="val[headline]"/>
                </div>
            </div>
			
            <div class="form-group">
                <label class="col-sm-4">Title</label>
                <div class="col-sm-7">
                    <input type="text" value="{{$box->title}}" class="form-control" placeholder="Box title" name="val[title]"/>
                </div>
            </div>

            <div class="form-group">
                <label class="col-sm-4">Box Access</label>
                <div class="col-sm-7">
                    <select id="custom-field-type" class="form-control" name="val[privacy]">
                        <option {{($box->privacy == 0) ? 'selected' : null}} value="0">Public</option>
                        <option {{($box->privacy == 1) ? 'selected' : null}} value="1">Only Members</option>
                        <option {{($box->privacy == 2) ? 'selected' : null}} value="2">Admins</option>
                    </select>
                </div>
            </div>


            <div class="form-group">
                <label class="col-sm-4">Add Likes</label>
                <div class="col-sm-7">
                    <select id="custom-field-type" class="form-control" name="val[likes]">
                        <option {{($box->show_likes == 1) ? 'selected' : null}} value="1">Yes</option>
                        <option {{($box->show_likes == 0) ? 'selected' : null}} value="0">No</option>
                    </select>
                </div>
            </div>

            <div class="form-group">
                <label class="col-sm-4">Active</label>
                <div class="col-sm-7">
                    <select id="custom-field-type" class="form-control" name="val[active]">
                        <option {{($box->active == 1) ? 'selected' : null}} value="1">Yes</option>
                        <option {{($box->active == 0) ? 'selected' : null}} value="0">No</option>
                    </select>
                </div>
            </div>

            <div class="form-group">
                <label class="col-sm-4 hidden">Style of Boxheader</label>
                <div class="col-sm-7">
					<input type="hidden" value="special" class="form-control" placeholder="special" name="val[style_boxheader]"/>
                </div>
            </div>

            <div class="form-group">
                <label class="col-sm-4">Color of Boxheader</label>
                <div class="col-sm-7">
                    <select id="custom-field-type" class="form-control" name="val[headercol]">
                        <option {{($box->headercol == 'lightblue') ? 'selected' : null}} value="lightblue">lightblue</option>
                        <option  {{($box->headercol == 'lightred') ? 'selected' : null}} value="lightred">lightred</option>
                        <option {{($box->headercol == 'sand') ? 'selected' : null}} value="sand">sand</option>
                        <option {{($box->headercol == 'lighgreen') ? 'selected' : null}} value="lighgreen">lighgreen</option>
                    </select>
                </div>
            </div>			
			
            <div class="form-group">
                <label class="col-sm-4">Image for Header</label>
                <div class="col-sm-7">
					<input type="text" value="{{$box->headerimg}}" class="form-control" placeholder="imagename.jpg" name="val[headerimg]"/>
					<p class="help-block">upload your images to ..App/Addons/Custombox/assets/images/..<br>leave empty for colorblock with headline</p>
                </div>
            </div>

			<div class="form-group">
                <label class="col-sm-4">Type of HeaderIcon</label>
                <div class="col-sm-7">
                    <select id="custom-field-type" class="form-control" name="val[icontype]">
                        <option {{($box->icontype == 'heart') ? 'selected' : null}} value="heart">heart</option>
                        <option {{($box->icontype == 'thumbsup') ? 'selected' : null}} value="thumbsup">thumbsup</option>
                        <option {{($box->icontype == 'information') ? 'selected' : null}} value="information">information</option>
                        <option {{($box->icontype == 'help') ? 'selected' : null}} value="help">help</option>
                        <option {{($box->icontype == 'alert') ? 'selected' : null}} value="alert">alert</option>
                        <option {{($box->icontype == 'upload') ? 'selected' : null}} value="upload">upload</option>
                        <option {{($box->icontype == 'star') ? 'selected' : null}} value="star">star</option>
                        <option {{($box->icontype == 'speakerphone') ? 'selected' : null}} value="speakerphone">speakerphone</option>
                        <option {{($box->icontype == 'ios7-telephone') ? 'selected' : null}} value="ios7-telephone">telephone</option>
                        <option {{($box->icontype == 'volume-medium') ? 'selected' : null}} value="volume-medium">volume-medium</option>
                        <option {{($box->icontype == 'social-facebook') ? 'selected' : null}} value="social-facebook">facebook</option>
                    </select>
                </div>
            </div>
			
            <div class="form-group">
                <label class="col-sm-4">Content</label>
                <div class="col-sm-7">
                    <textarea name="val[content]" class="form-control pane-editor" placeholder="Page content">{{$box->content}}</textarea>
                </div>
            </div>
			
            <div class="form-group">
                <label class="col-sm-4">Box footer</label>
                <div class="col-sm-7">
					<input type="text" value="{{$box->footer}}" class="form-control" placeholder="" name="val[footer]"/>
					<p class="help-block">leave empty for no footer</p>
                </div>
            </div>


            <div class="body-header">
                <input class="btn btn-danger no-radius" type="submit" value="Submit"/>
            </div>

        </form>
    </div>
</div>
@else
<div class="box">
    <div class="box-title">Edit Box Normal</div>
    <div class="box-content">
        @if (!empty($message))
        <div class="alert alert-danger">{{$message}}</div>
        @endif
		<br><br>
        <form class="form-horizontal" action="" method="post">

            <div class="form-group">
                <label class="col-sm-4">Headline</label>
                <div class="col-sm-7">
                    <input type="text" value="{{$box->headline}}" class="form-control" placeholder="" name="val[headline]"/>
                </div>
            </div>
			
            <div class="form-group">
                <label class="col-sm-4">Title</label>
                <div class="col-sm-7">
                    <input type="text" value="{{$box->title}}" class="form-control" placeholder="Box title" name="val[title]"/>
                </div>
            </div>

            <div class="form-group">
                <label class="col-sm-4">Box Access</label>
                <div class="col-sm-7">
                    <select id="custom-field-type" class="form-control" name="val[privacy]">
                        <option {{($box->privacy == 0) ? 'selected' : null}} value="0">Public</option>
                        <option {{($box->privacy == 1) ? 'selected' : null}} value="1">Only Members</option>
                        <option {{($box->privacy == 2) ? 'selected' : null}} value="2">Admins</option>
                    </select>
                </div>
            </div>


            <div class="form-group">
                <label class="col-sm-4">Add Likes</label>
                <div class="col-sm-7">
                    <select id="custom-field-type" class="form-control" name="val[likes]">
                        <option {{($box->show_likes == 1) ? 'selected' : null}} value="1">Yes</option>
                        <option {{($box->show_likes == 0) ? 'selected' : null}} value="0">No</option>
                    </select>
                </div>
            </div>

            <div class="form-group">
                <label class="col-sm-4">Active</label>
                <div class="col-sm-7">
                    <select id="custom-field-type" class="form-control" name="val[active]">
                        <option {{($box->active == 1) ? 'selected' : null}} value="1">Yes</option>
                        <option {{($box->active == 0) ? 'selected' : null}} value="0">No</option>
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
                    <textarea name="val[content]" class="form-control pane-editor" placeholder="Page content">{{$box->content}}</textarea>
                </div>
            </div>
			
            <div class="form-group">
                <label class="col-sm-4">Box footer</label>
                <div class="col-sm-7">
					<input type="text" value="{{$box->footer}}" class="form-control" placeholder="" name="val[footer]"/>
					<p class="help-block">leave empty for no footer</p>
                </div>
            </div>


            <div class="body-header">
                <input class="btn btn-danger no-radius" type="submit" value="Submit"/>
            </div>

        </form>
    </div>
</div>

@endif
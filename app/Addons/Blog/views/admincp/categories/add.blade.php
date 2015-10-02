<div class="box">
    <div class="box-title">Add New Blog Category</div>
    <div class="box-content">

        @if($message)
            <div class="alert alert-danger">{{$message}}</div>
        @endif
        <form action="" method="post" class="form-horizontal">
            <div class="form-group">
                <label class="col-sm-4">Title</label>
                <div class="col-sm-7">
                    <input type="text" value="{{Input::get('title')}}" class="form-control" placeholder="Page title" name="title"/>
                </div>
            </div>

            <div class="body-header">
                <input class="btn btn-danger no-radius" type="submit" value="Add Category"/>
            </div>
        </form>
    </div>
</div>
<div class="box">
    <div class="box-title">{{trans('blog::global.add-new-blog')}}</div>
    <div class="box-content" style="padding: 20px 50px">

        @if($message)
        <div class="alert alert-danger">{{$message}}</div>
        @endif
        <form action="" method="post">
            <div class="form-group">
                <label >{{trans('blog::global.title')}}</label>
                <input type="text" class="form-control" name="val[title]" placeholder="{{trans('blog::global.title')}}">
            </div>

            <div class="form-group">
                <label >{{trans('blog::global.post')}}</label>
                <textarea style="height: 300px  " class="editor" name="val[post]" placeholder="{{trans('blog::global.post')}}"></textarea>
            </div>

            <div class="form-group">
                <label >{{trans('blog::global.category')}}</label>
                <select class="form-control" name="val[category]">
                    @foreach(app('App\\Addons\\Blog\\Classes\\BlogCategoryRepository')->getList() as $category)
                    <option value="{{$category->id}}">{{$category->title}}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label >{{trans('blog::global.tags')}}</label>
                <input type="text" class="form-control" name="val[tags]" placeholder="{{trans('blog::global.tags')}}">
                <p class="help-block">{{trans('blog::global.tags-info')}}</p>
            </div>

            <hr/>
            <div class="form-group">
                <label >{{trans('blog::global.privacy')}}</label>
                <select class="form-control" name="val[privacy]">
                    <option value="0">{{trans('blog::global.public')}}</option>
                    <option value="1">{{trans('blog::global.personal')}}</option>
                    <option value="2">{{trans('blog::global.friends')}}</option>
                </select>
            </div>

            <div class="form-group">
                <label >{{trans('blog::global.allow-comments')}}</label><br/>
                <select name="val[comment]">
                    <option value="1">{{trans('global.yes')}}</option>
                    <option value="0">{{trans('global.no')}}</option>
                </select>
            </div>

            <div class="form-group">
                <label >{{trans('blog::global.allow-likes')}}</label> <br/>
                <select name="val[like]">
                    <option value="1">{{trans('global.yes')}}</option>
                    <option value="0">{{trans('global.no')}}</option>
                </select>
            </div>

            <div class="form-group">
                <label >{{trans('blog::global.status')}}</label> <br/>
                <select name="val[status]">
                    <option value="1">{{trans('blog::global.published')}}</option>
                    <option value="0">{{trans('blog::global.unpublished')}}</option>
                </select>
            </div>

            <hr/>

            <div class="form-group">
                <button class="btn btn-danger">{{trans('blog::global.submit')}}</button>
            </div>
        </form>
    </div>
</div>
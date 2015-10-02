<div class="box">
    <div class="box-title">{{trans('blog::global.edit-blog')}}</div>
    <div class="box-content" style="padding: 20px 50px">
        @if($message)
        <div class="alert alert-danger">{{$message}}</div>
        @endif
        <form action="" method="post">
            <div class="form-group">
                <label >{{trans('blog::global.title')}}</label>
                <input value="{{$blog->title}}" type="text" class="form-control" name="val[title]" placeholder="{{trans('blog::global.title')}}">
            </div>

            <div class="form-group">
                <label >{{trans('blog::global.post')}}</label>
                <textarea style="height: 300px  " class="blog-editor" name="val[post]" placeholder="{{trans('blog::global.post')}}">{{$blog->content}}</textarea>
            </div>

            <div class="form-group">
                <label >{{trans('blog::global.category')}}</label>
                <select class="form-control" name="val[category]">
                    @foreach(app('App\\Addons\\Blog\\Classes\\BlogCategoryRepository')->getList() as $category)
                    <option {{($blog->category_id == $category->id) ? 'selected' : null}} value="{{$category->id}}">{{$category->title}}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label >{{trans('blog::global.tags')}}</label>
                <input value="{{$blog->tags}}" type="text" class="form-control" name="val[tags]" placeholder="{{trans('blog::global.tags')}}">
                <p class="help-block">{{trans('blog::global.tags-info')}}</p>
            </div>

            <hr/>
            <div class="form-group">
                <label >{{trans('blog::global.privacy')}}</label>
                <select class="form-control" name="val[privacy]">
                    <option {{($blog->privacy == 0) ? 'selected' : null}} value="0">{{trans('blog::global.public')}}</option>
                    <option {{($blog->privacy == 1) ? 'selected' : null}} value="1">{{trans('blog::global.personal')}}</option>
                    <option {{($blog->privacy == 2) ? 'selected' : null}} value="2">{{trans('blog::global.friends')}}</option>
                </select>
            </div>

            <div class="form-group">
                <label >{{trans('blog::global.allow-comments')}}</label><br/>
                <select name="val[comment]">
                    <option {{($blog->show_comments == 1) ? 'selected' : null}} value="1">{{trans('global.yes')}}</option>
                    <option {{($blog->show_comments == 0) ? 'selected' : null}} value="0">{{trans('global.no')}}</option>
                </select>
            </div>

            <div class="form-group">
                <label >{{trans('blog::global.allow-likes')}}</label> <br/>
                <select name="val[like]">
                    <option {{($blog->show_likes == 1) ? 'selected' : null}} value="1">{{trans('global.yes')}}</option>
                    <option {{($blog->show_likes == 0) ? 'selected' : null}} value="0">{{trans('global.no')}}</option>
                </select>
            </div>

            <div class="form-group">
                <label >{{trans('blog::global.status')}}</label> <br/>
                <select name="val[status]">
                    <option {{($blog->status == 1) ? 'selected' : null}} value="1">{{trans('blog::global.published')}}</option>
                    <option {{($blog->status == 0) ? 'selected' : null}} value="0">{{trans('blog::global.unpublished')}}</option>
                </select>
            </div>

            <hr/>

            <div class="form-group">
                <button class="btn btn-success">{{trans('global.save')}}</button>

            </div>
        </form>
    </div>
</div>
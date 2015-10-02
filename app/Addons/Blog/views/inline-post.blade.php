@if($post->content_type == 'add-blog')
    <?php $details = $post->present()->getAutoPost();?>

        <div class="media blog-in-post">
            <div class="media-object pull-left">
                <i class="icon ion-clipboard"></i>
            </div>
            <div class="media-body">
                <?php $blog = app('App\\Addons\\Blog\\Classes\\BlogRepository')->findById($details['blog_id'])?>
                @if($blog)
                <a data-ajaxify="true" href="{{$post->user->present()->url()}}">{{$post->user->fullname}}</a> {{trans('blog::global.added-new-blog')}} : <a href="{{$blog->url()}}" data-ajaxify="true">{{$blog->title}}</a>
                @else
                    <div class="blog-error">{{trans('blog::global.blog-has-removed')}}</div>
                @endif
            </div>
        </div>

@endif
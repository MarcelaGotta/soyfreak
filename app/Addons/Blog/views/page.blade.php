<div class="container page-content">
    <div class="box" style="margin-top: 20px">
        <div class="box-title">

            {{$blog->title}}

            @if($blog->isOwner())
                <a class="pull-right" href="{{$blog->url('edit')}}">{{trans('blog::global.edit-blog')}}</a>
            @endif

        </div>
        <div class="box-content">
            {{$blog->content}}
        </div>
    </div>

    <div class="box clearfix" style="margin-top: 20px">

        <div class="left-column" style="min-height: 0;border-right: solid 1px #F1F1F1">
            <ul class="blog-share-list">
                <li><a href="javascript:void(0)" onclick="return window.open(
                             'http://www.facebook.com/sharer.php?u={{$blog->url()}}'
                             , 'targetWindow', 'width=600,height=400')"
                        ><i style="display: inline-block;width: 15%;text-align: center" class="icon ion-social-facebook"></i> {{trans('post.share-on-facebook')}}</a> </li>

                <li><a href="javascript:void(0)" onclick="return window.open(
                             'http://twitter.com/share?url={{$blog->url()}}'
                             , 'targetWindow', 'toolbar=no,location=no,status=no,scrollbar=yes,resizable=no,width=600,height=400')"
                        ><i style="display: inline-block;width: 15%;text-align: center" class="icon ion-social-twitter"></i> {{trans('post.share-on-twitter')}}</a> </li>

                <li><a href="javascript:void(0)" onclick="return window.open(
                             'https://plus.google.com/share?url={{$blog->url()}}'
                             , 'targetWindow', 'toolbar=no,location=no,status=no,scrollbar=yes,resizable=no,width=600,height=400')"
                        ><i style="display: inline-block;width: 15%;text-align: center" class="icon ion-social-googleplus"></i> {{trans('post.share-on-g+')}}</a> </li>


                <li><a href="javascript:void(0)" onclick="return window.open(
                             'http://www.linkedin.com/shareArticle?mini=true&url={{$blog->url()}}'
                             , 'targetWindow', 'toolbar=no,location=no,status=no,scrollbar=yes,resizable=no,width=600,height=400')"
                        ><i style="display: inline-block;width: 15%;text-align: center" class="icon ion-social-linkedin-outline"></i> {{trans('post.share-on-linkedin')}}</a> </li>

            </ul>

            @if($blog->show_comments)
            <div class="box-title" style="margin: 0">({{$blog->countComments()}}) {{trans('comment.comments')}}</div>
            <div style="padding-top: 20px;margin-top: 0" class="post-replies" id="blog-post-replies" data-limit="10" data-offset="0" data-type="blog" data-type-id="{{$blog->id}}">
                @if(Auth::check())

                {{Theme::section('comment.form', ['typeId' => $blog->id, 'type' => 'blog'])}}
                @endif

                @if($blog->countComments() > 10)
                <a href="" class="load-more-comment" data-target="#blog-post-replies"><i class="icon ion-more"></i> View more comments <img class="indicator" src="{{Theme::asset()->img('theme/images/loading.gif')}}"/></a>
                @endif
                <div id="blog-{{$blog->id}}-reply-lists" class="replies-list">

                    @foreach($blog->comments->take(10)->reverse() as $comment)

                    {{Theme::section('comment.display', ['comment' => $comment])}}

                    @endforeach
                </div>


            </div>
            @endif

        </div>
        <div class="right-column" style="min-height: 0">
            @if($blog->show_likes)
                <?php $hasLike = $blog->hasLiked()?>

                <a  data-is-login="{{Auth::check()}}" data-status="{{($hasLike) ? '1' : 0}}" class="btn btn-default btn-xs like-button" data-like="{{trans('like.like')}}" data-unlike="{{trans('like.unlike')}}" data-id="{{$blog->id}}" data-type="blog" href=""><i class="icon ion-ios7-heart"></i> <span>{{($hasLike) ? trans('like.unlike') : trans('like.like')}}</span></a>

                <div class="page-like">
                    <i class="icon ion-thumbsup"></i> <span class="post-like-count-{{$blog->id}}">{{$blog->countLikes()}}</span> {{trans('like.likes')}}
                </div>

                @if(Auth::check())
                <?php $friendsLikes = $blog->friendsLiked()?>
                @if(count($friendsLikes) > 0)
                <div class="box">
                    <div class="box-title">{{trans('user.friend-like-this')}}</div>
                    <div class="box-content">
                        <div class="user-tile-list">

                            @foreach($friendsLikes as $like)

                            <a data-ajaxify="true" href="{{$like->user->present()->url()}}"><img src="{{$like->user->present()->getAvatar(100)}}"/> </a>

                            @endforeach

                        </div>
                    </div>
                </div>
                @endif

                @endif

                @if($blog->countLikes() > 0)
                <div class="box">
                    <div class="box-title">{{trans('user.people-like-this')}}</div>
                    <div class="box-content">
                        <div class="user-tile-list">
                            @foreach($blog->likes->take(12) as $like)

                            <a data-ajaxify="true" href="{{$like->user->present()->url()}}"><img src="{{$like->user->present()->getAvatar(100)}}"/> </a>

                            @endforeach
                        </div>
                    </div>
                </div>
                @endif
            @endif
        </div>

    </div>
</div>
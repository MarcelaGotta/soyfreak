@if($post->privacy == 1 or $post->privacy == 2 or $post->privacy == 3 or $post->privacy == 4)
<li><a href="javascript:void(0)" title="{{trans('post.share-on-facebook')}}" onclick="return window.open(
                             'http://www.facebook.com/sharer.php?u={{route('post-page', ['id' => $post->id])}}'
                             , 'targetWindow', 'width=600,height=400')"
        ><i style="display: inline-block;width: 15%;text-align: center" class="icon ion-social-facebook"></i> </a> </li>

<li><a href="javascript:void(0)" title="{{trans('post.share-on-twitter')}}" onclick="return window.open(
                             'http://twitter.com/share?url={{route('post-page', ['id' => $post->id])}}'
                             , 'targetWindow', 'toolbar=no,location=no,status=no,scrollbar=yes,resizable=no,width=600,height=400')"
        ><i style="display: inline-block;width: 15%;text-align: center" class="icon ion-social-twitter"></i> </a> </li>

<li><a href="javascript:void(0)" title="{{trans('post.share-on-g+')}}" onclick="return window.open(
                             'https://plus.google.com/share?url={{route('post-page', ['id' => $post->id])}}'
                             , 'targetWindow', 'toolbar=no,location=no,status=no,scrollbar=yes,resizable=no,width=600,height=400')"
        ><i style="display: inline-block;width: 15%;text-align: center" class="icon ion-social-googleplus"></i> </a> </li>


<li><a href="javascript:void(0)" title="{{trans('post.share-on-linkedin')}}" onclick="return window.open(
                             'http://www.linkedin.com/shareArticle?mini=true&url={{route('post-page', ['id' => $post->id])}}'
                             , 'targetWindow', 'toolbar=no,location=no,status=no,scrollbar=yes,resizable=no,width=600,height=400')"
        ><i style="display: inline-block;width: 15%;text-align: center" class="icon ion-social-linkedin-outline"></i> </a> </li>

@endif
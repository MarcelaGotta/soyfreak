@if($message->present()->canView())

    @if($message->senderUser->id == $user->id)
    <div class="message pull-right">

            <span class="content">
                {{$message->present()->text()}}
            @if($message->image)
                <div >
                    <a class="preview-image" rel="message-{{$message->id}}" href="{{Image::url($message->image, 600)}}">
                        <img style="max-width: 80%;margin-bottom: 10px;margin-top:10px" src="{{Image::url($message->image, 100)}}">
                    </a>
                </div>
            @endif

                <span class="post-time chatbox-time"><i class="icon ion-ios7-time-outline"></i>

                    <span title="{{$message->present()->time()}}">{{formatDTime($message->created_at)}}</span>
                </span>
            </span>
        <span class="arrow-right"></span>
    </div>
    @else
    <div class="media media-message">
        <div class="media-object pull-left"><img src="{{$message->senderUser->present()->getAvatar(30)}}"/> </div>
        <div class="media-body">
            <span class="arrow-left"></span>
                <span class="content">
                    {{$message->present()->text()}}
                    @if($message->image)
                        <div >
                            <a class="preview-image" rel="message-{{$message->id}}" href="{{Image::url($message->image, 600)}}">
                                <img style="max-width: 80%;margin-bottom: 10px;margin-top:10px" src="{{Image::url($message->image, 100)}}">
                            </a>
                        </div>
                    @endif

                    <span class="post-time chatbox-time"><i class="icon ion-ios7-time-outline"></i>

                        <span title="{{$message->present()->time()}}">{{formatDTime($message->created_at)}}</span>
                    </span>
                </span>

        </div>
    </div>
    @endif
@endif
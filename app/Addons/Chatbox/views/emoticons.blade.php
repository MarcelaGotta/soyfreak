@foreach(Theme::option()->get('emoticons') as $code => $details)
<a title="{{$details['title']}}" data-target="#post-textarea" style="display: inline-block;margin: 5px" href="" data-code="{{$code}}" class="chatbox-emoticon-selector"><img src="{{$details['image']}}"/> </a>
@endforeach
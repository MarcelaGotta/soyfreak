@foreach($messages->reverse() as $message)
    @if ($message->present()->canView())
        {{Theme::section('chatbox::format-message', ['message' => $message, 'user' => $user])}}
    @endif
@endforeach
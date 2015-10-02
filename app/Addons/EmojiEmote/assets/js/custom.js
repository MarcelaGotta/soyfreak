$(document).ready(function(){
    $('textarea#post-textarea').emojiarea({button: '#emoji', wysiwyg: false});
    $('input#message-textarea').emojiarea({button: '#emoji-message', wysiwyg: false});

    $('a[id*="emoji-comment"]').click(function() {
        var target = $(this).data('target');
        $("textarea#" + target +"-reply-textarea").emojiarea({button: $(this), wysiwyg: false});
    });
});
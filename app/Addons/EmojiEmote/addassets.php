<?php

// Check if emoji is enabled from Admin CP
if (\Config::get('enable-emoji', 1)) {
    Theme::asset()->add('emojiemote-css', 'emojiemote::css/jquery.emojiarea.css');
    Theme::asset()->add('jquery-js', 'emojiemote::js/jquery.emojiarea.js');
    Theme::asset()->add('pack-js', 'emojiemote::js/packs/basic/emojis.js');
    Theme::asset()->add('custom-js', 'emojiemote::js/custom.js');
}

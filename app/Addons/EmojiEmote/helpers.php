<?php

/**
 * With this function you can transform emote file name in title for <img> tag
 * @param  string $string Emote name
 * @return string         Return formatted title
 */
if ( ! function_exists('format_title'))
{
	function format_title($string)
	{
	    return (strpos($string, '_') == false) ? ucfirst($string) : ucfirst(str_replace('_', ' ', $string));
	}
}
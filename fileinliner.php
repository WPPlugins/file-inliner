<?php
/*
Plugin Name: File Inliner
Plugin URI: http://www.idiap.ch/~pabbet/personal-projects/wordpress-file-inliner-plugin/
Description: This plugin displays the content of a file
Version: 1.2.0
Author: Philip Abbet
Author URI: http://www.idiap.ch/~pabbet


Copyright 2008 Philip Abbet (email : philip_dot_abbet_at_gmail_dot_com)

This program is free software; you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation; either version 2 of the License, or
any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program; if not, write to the Free Software
Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA  02111-1307  USA
*/


function outputfile($matches)
{
    // matches content:
    //  0: the full [file ...]...[/file] tag
    //  1: ' lang="..."'
    //  2: the language
    //  3: ' start="..."'
    //  4: the start
    //  5: ' end="..."'
    //  6: the end
    //  7: ' link="..."'
    //  8: link: 'on' or 'off'
    //  9: ' style="..."'
    // 10: the CSS style
    // 11: ' preserveformat="..."'
    // 12: preserveformat: 'on' or 'off'
    // 13: the file path

	$lang = $matches[2];
    $start = ($matches[3] != null) ? intval($matches[4]) : 1;
    $end = ($matches[5] != null) ? intval($matches[6]) : -1;
    $link = $matches[8];
    $style = $matches[10];
    $preserve_format = $matches[12];
	$file = $matches[13];

    $result = '';

	if (($link != null) and ($link == 'on'))
		$result .= '<div><a href="' . get_option('home') . '/' . $file . '" style="float: right; margin-right: 5px;">Download</a>';

	if ($preserve_format != 'off')
	{
		$result .= '<pre';

		if ($lang != null)
			$result .= ' lang="' . $lang . '"';
	}
	else
	{
		$result .= '<div';
	}

	if ($style != null)
		$result .= ' style="' . $style . '"';

    $result .= '>';

    if ($file != null)
    {
        if (($start > 0) || ($end > $start))
        {
            $content = file_get_contents($file);
            $content_array = preg_split("/\\n/", $content);
            
            for ($c = 0; $c < count($content_array); $c++)
            {
                if ($c + 1 >= $start)
                {
					if ($preserve_format != 'off')
                	    $result .= $content_array[$c] . "\n";
                	else
                	    $result .= '<p>' . $content_array[$c] . '</p>';
                }
                
                if ($c + 1 == $end)
                    break;
            }
        }
		else if ($preserve_format == 'off')
		{
            $content = file_get_contents($file);
            $content_array = preg_split("/\\n/", $content);
            
            for ($c = 0; $c < count($content_array); $c++)
           	    $result .= '<p>' . $content_array[$c] . '</p>\n';
		}
        else
        {
            $result .= file_get_contents($file);
        }
    }

 	if ($preserve_format != 'off')
		$result .= '</pre>';
	else
		$result .= '</div>';

	if (($link != null) and ($link == 'on'))
		$result .= '</div>';

	return $result;
}


function inline_file($content)
{
	$content = preg_replace_callback('/\[file(\s*lang="([^"]*)")?(\s*start="([^"]*)")?(\s*end="([^"]*)")?(\s*link="([^"]*)")?(\s*style="([^"]*)")?(\s*preserveformat="([^"]*)")?\]((.|\n)*?)\[\/file\]/', 'outputfile', $content);
	$content = preg_replace('/\[file off((.|\n)*?)\[\/file\]/', '[file$1[/file]', $content);
	return $content;
}

add_filter('the_content', 'inline_file', 0);
?>

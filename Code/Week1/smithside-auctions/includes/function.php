<?php

/** 
 * LoadContent
 * Load the content
 * @param $default 
 */

function loadContent($where, $default=''){
    // get the content from the url
    // sanitize it for security reasons
    
    $content = filter_input(INPUT_GET, $where, FILTER_SANITIZE_STRING);
    $default = filter_var($default, FILTER_SANITIZE_STRING);
    // the there wasn't anything on the url, then use the default

    $content = (empty($content)) ? $default : $content;
    
    // if we have contnet, then get it and pass it back
    if($content){
        // sanitize the data to prevent hacking
        $html = include 'content/' . $content . '.php';
        return $html;
    }
}
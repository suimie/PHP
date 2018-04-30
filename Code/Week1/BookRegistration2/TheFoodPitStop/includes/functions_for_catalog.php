<?php

/** 
 * LoadContent
 * Load the content
 * @param $default 
 */
function load_catalog_product_div($where, $default=''){
    // get the content from the url
    // sanitize it for security reasons
    
    $content = filter_input(INPUT_GET, $where, FILTER_SANITIZE_STRING);
    $default = filter_var($default, FILTER_SANITIZE_STRING);
    // the there wasn't anything on the url, then use the default

    $content = (empty($content)) ? $default : $content;
    
    // if we have contnet, then get it and pass it back
    if($content){
        $html = include 'contents/' . $content . '.php';
        return $html;
    }
}

function get_array_from_url($which){
    $sidebar_which = filter_input(INPUT_GET, $which, FILTER_SANITIZE_STRING);
    
    $sidebar_which_arr = explode(" ", $sidebar_which); 
   
   return $sidebar_which_arr;
}

function get_url_from_array($arr){
    $urlstr = "";
    foreach($arr as $item){
        if($item !== "")
            if($urlstr !== "")
                $urlstr .= "+";
            $urlstr .= $item;
    }
    
    return $urlstr;
}

function get_count_2d_array($arr){
    $count = 0;
    if ($arr == null)   return 0;
    
    foreach($arr as $item){
        $count++;
    }
    
    return $count;
}
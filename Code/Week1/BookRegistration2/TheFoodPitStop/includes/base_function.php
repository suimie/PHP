<?php
session_start();
include('database.php');
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
        $html = include 'contents/' . $content . '.php';
        return $html;
    }
}

/** 
 * logging
 * Write message on log filename with date of today <yyyymmdd.txt>
 * The logging data format is <yyyymmdd_hh:mm:ss message>
 * @param $message 
 */
function logging($message){
    $filename = "Log/" . date("Ymd") . ".txt";
    $myfile = fopen($filename, "a") or die("Unable to open file!");
    fwrite($myfile, date("Ymd_H:i:s ") . $message . "\n");
}

/** 
 * active_menu
 * Get Active or UnActive on navigation bar
 * @param $where 
 */
function active_menu($where){
    $content = filter_input(INPUT_GET, 'content', FILTER_SANITIZE_STRING);
    
    if($where === 'home' && empty($content))    return 'active';
    else if ($where === $content)    return 'active';
    else return '';
}

/** 
 * cart_image
 * Get Shopping cart image depends on the state
 * @param $where 
 */
function cart_image($where){
    $content = filter_input(INPUT_GET, 'content', FILTER_SANITIZE_STRING);
    
    if ($where === $content)    return 'assets/img/cart2.png';
    else    return 'assets/img/cart2_gray.png';
}


/** 
 * get_product_image_src
 * Get Full Path of the image using category, product_id and img_type
 * @param $category, $product_id,  $img_type
 */
<<<<<<< HEAD
function logging($message){
    $filename = "Log/" . date("Ymd") . ".txt";
    $myfile = fopen($filename, "a") or die("Unable to open file!");
    fwrite($myfile, date("Ymd_H:i:s ") . $message);
}

function test_input($data) {
            $data = trim($data);
            $data = stripslashes($data);
            $data = htmlspecialchars($data);
            return $data;
        }
=======
function get_product_image_src($category, $product_id, $img_type){
    logging("images/" . $category . "/" . $product_id . "." . $img_type);
    return "../images/" . $category . "/" . $product_id . "." . $img_type;
}
>>>>>>> f71a7f3ffc2ad06edc9193b128e9c84667fc1b7c

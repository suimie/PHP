<?php

/* 
 * init.php
 * 
 * Contact class file
 * 
 * @version 1.2 2018-04-19
 * @package Smithside Auctions
 * @copyright (c) 2018, Smithside auctions
 * @license GNU General Public Licence
 * @since Since Release 1.0
 * @author Suim Park
 */

/** 
 * Auto load the class files
 * @param string $class_name
 */

function __autoload($class_name){
    try{
        $class_file = 'includes/2classes/' . strtolower($class_name) . '.php';
        if (is_file($class_file)) {
            require_once $class_file;
        }else {
            throw new Exception("Unable to load class $clas_name is file $class_file.");
        }
    } catch (Exception $ex) {
        echo 'Exception caugh: ' , $e->getMessage(). "\n";
    }   
}

// include required files
require_once 'includes/function.php';


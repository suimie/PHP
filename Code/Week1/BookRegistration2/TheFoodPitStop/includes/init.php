<?php

/* 
 * init.php
 * 
 * Contact class file
 * 
 * @version 1.0 2018-04-19
 * @package The Food Pit Stop
 * @copyright (c) 2018, Anita Mirshahi, Suim Park, Valini Rangasamy
 * @license 
 * @since Release 1.0
 */

/** 
 * Auto load the class files
 * @param string $class_name
 */

function __autoload($class_name){
    require_once 'includes/classes/' . strtolower($class_name) . '.php';
}

// include required files
require_once 'includes/base_function.php';

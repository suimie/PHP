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
    require_once $_SERVER['DOCUMENT_ROOT'].'/ThePitStop_PHP/includes/classes/' . strtolower($class_name) . '.php';
}

// include required files
require_once $_SERVER['DOCUMENT_ROOT'].'/ThePitStop_PHP/includes/function_base.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/ThePitStop_PHP/includes/functions_for_catalog.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/ThePitStop_PHP/includes/database.php';

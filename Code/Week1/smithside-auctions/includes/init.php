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
    require_once 'includes/classes/' . strtolower($class_name) . '.php';
}

// include required files
require_once 'includes/function.php';


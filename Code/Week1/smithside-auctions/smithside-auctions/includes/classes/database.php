<?php

/* 
 * database.php
 * 
 * Smithside Auctions Database
 * 
 * @author Suim Park
 */

class Database{
    // create the properties for the user name, password, database name, and host name
    
    /**
     * User Name to contact smithside database
     * @var string $user_name
     */    
    private static $user_name = 'root';
    
    /**
     * Password to contact smithside database
     * @var string $user_password
     */    
    private static $user_password = '';
    
    /**
     * Database name
     * @var string $database_name
     */  
    private static $database_name = 'smithside';
    
    /**
     * Hostname for  the server
     * @var string $host_name
     */  
    private static $host_name = 'localhost';
    
    /**
     * Database connection to hold the actual connection
     * @var Mysqli $connection
     */
    private static $connection = null;
    
    /**
     * Get the database connection
     * getConnection function
     * @return Mysqli
     */
    
    // because the method is static method, use self::@property_name construction
    public static function getConnection()
    {
        if (!self::$connection){
            self::$connection = 
                    new mysqli(self::$host_name, self::$user_name, 
                            self::$user_password, self::$database_name);

            // if there is an error, print the error and end the program
            if(self::$connection->connect_error){
                die('Connect Error: ' . self::$connection->connect_error);
            }
        }
        
        return self::$connection;
    }
    
    private function __construct() {
    }
}
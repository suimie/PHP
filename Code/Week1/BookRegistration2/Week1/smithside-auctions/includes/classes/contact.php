<?php

/* 
 * contact.php
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

class Contact{
    /**
     * First Name
     * @var string
     */
    protected $first_name;
    /**
     * Last Name
     * @var string
     */
    protected $last_name;
    /**
     * Position in the company.
     * @var string
     */
    protected $position;
    /**
     * Email
     * @var string
     */
    protected $email;
    /**
     * Phone number, formatted in string
     * @var string
     */
    protected $phone;
    
    /** 
     * Initialize the Contact with first name, last name, position
     * email, and phone
     * @param array
     */
    function __construct($input = false){
        if (is_array($input)) {
            foreach ($input as $key=>$val){
                // Note the $key insted of key.
                // This will give the value in $key instead of 'key' itself
                $this->$key = $val;
            }
        }
    }
    /**
     * contactName function concatenates the first and the last names
     * @return string
     */
    public function contactName(){
        $contact_name = $this->first_name . ' ' . $this->last_name;
        
        return $contact_name;
    }
    
    public function getLastName(){
        return $this->last_name;
    }
    
    public function getFirstName(){
        return $this->first_name;
    }
    
    public function getPosition(){
        return $this->position;
    }
    
    public function getEmail(){
        return $this->email;
    }
    
    public function getPhone(){
        return $this->phone;
    }
}
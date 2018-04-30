<?php

/**
 * Product Class
 * 
 * Main content
 * 
 * @version 1.0 2018-04-19
 * @package The Food Pit Stop
 * @copyright (c) 2018, Anita Mirshahi, Suim Park, Valini Rangasamy
 * @license 
 * @since Release 1.0
 * 
 */

class Product {
    public $Id;
    public $PId;
    public $Name;
    public $BrandId;
    public $Brand;
    public $CategoryId;
    public $Category;
    public $Price;
    public $QtyOnHand;
    public $Description1;
    public $Description2;
    public $ImageType;
    
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
     * get_product_image_src
     * Get Full Path of the image using category, product_id and img_type
     * 
     */
    public function get_product_image_src(){
        //logging("images/" . $CategoryId . "/" . $PId . "." . $ImageType);
        return "images/" . $CategoryId . "/" . $PId . "." . $ImageType;
    }

}

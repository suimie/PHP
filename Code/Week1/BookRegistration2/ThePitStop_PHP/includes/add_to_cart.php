<?php
/**
 * add_to_cart.php
 * 
 * add product to cart
 * 
 * @version 1.0 2018-04-19
 * @package The Food Pit Stop
 * @copyright (c) 2018, Anita Mirshahi, Suim Park, Valini Rangasamy
 * @license 
 * @since Release 1.0
 */
require_once $_SERVER['DOCUMENT_ROOT'].'/ThePitStop_PHP/init.php';

// get the product id
$pid = isset($_GET['pid']) ? $_GET['pid'] : "";
$quantity = isset($_GET['quantity']) ? $_GET['quantity'] : 1;
$page = isset($_GET['page']) ? $_GET['page'] : 1;

// make quantity a minimum of 1
$quantity = $quantity <= 0 ? 1 : $quantity;

// add new item on array
$cart_items[$pid] = array(
    'quantity' => $quantity
);

// read
$cookie = isset($_COOKIE['pitstop_cart_items_cookie']) ? $_COOKIE['pitstop_cart_items_cookie'] : "";
$cookie = stripslashes($cookie);
$saved_cart_items = json_decode($cookie, true);

// if $saved_cart_items is null, prevent null error
if (!$saved_cart_items) {
    $saved_cart_items = array();
}

// check if the item is in the array, if it is, do not add
if (array_key_exists($pid, $saved_cart_items)) {
    
    logging($saved_cart_items[$pid]);
    $oldQty = $saved_cart_items[$pid]['quantity'];
    $quantity = ($oldQty > 5) ? $oldQty : ($quantity += $oldQty);
    
    // remove the item from the array
    unset($saved_cart_items[$pid]);

    // delete cookie value
    setcookie("pitstop_cart_items_cookie", "", time()-3600);

    // add the item with updated quantity
    $saved_cart_items[$pid]=array(
        'quantity'=>$quantity
    );

    // enter new value
    $json = json_encode($saved_cart_items, true);
    setcookie("pitstop_cart_items_cookie", $json, time() + (86400 * 30), '/'); // 86400 = 1 day
    $_COOKIE['pitstop_cart_items_cookie']=$json;
     
    // redirect to product list and tell the user it was added to cart
    header('Location: ../index.php?content=shopping_cart&pid=' . $pid . '&action=exists');
}

// else, add the item to the array
else {
    // if cart has contents
    if (count($saved_cart_items) > 0) {
        foreach ($saved_cart_items as $key => $value) {
            // add old item to array, it will prevent duplicate keys
            $cart_items[$key] = array(
                'quantity' => $value['quantity']
            );
        }
    }

    // put item to cookie
    $json = json_encode($cart_items, true);
    setcookie("pitstop_cart_items_cookie", $json, time() + (86400 * 30), '/'); // 86400 = 1 day
    $_COOKIE['pitstop_cart_items_cookie'] = $json;

    // redirect to product list and tell the user it was added to cart
    header('Location: ../index.php?content=shopping_cart&pid=' . $pid . '&action=added');
}
die();



<?php
/**
 * shopping_cart.php
 * 
 * content for the shopping cart page
 * 
 * @version 1.0 2018-04-19
 * @package The Food Pit Stop
 * @copyright (c) 2018, Anita Mirshahi, Suim Park, Valini Rangasamy
 * @license 
 * @since Release 1.0
 */
?>
<main class="page shopping-cart-page">
    <section class="clean-block clean-cart dark" style="background-color:rgba(184,156,132,0.28);">
        <div class="container">
            <div class="block-heading" style="margin-top:-38px;">
                <h1 style="color:#608e3a;">Shopping Cart</h1>
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc quam urna, dignissim nec auctor in, mattis vitae leo.</p>
            </div>
            <div class="content">
                <div class="row no-gutters">
                    <div class="col-md-12 col-lg-8">
                        <div class="items">
                            <?php
                            // read items in the cart
                            $cookie = isset($_COOKIE['pitstop_cart_items_cookie']) ? $_COOKIE['pitstop_cart_items_cookie'] : "";
                            $cookie = stripslashes($cookie);
                            $saved_cart_items = json_decode($cookie, true);
                            $total = 0;
                            $sub_total = 0;

                            // to prevent null value
                            //$saved_cart_items=$saved_cart_items== null ? array() : $saved_cart_items;
                            if(is_array($saved_cart_items) && count($saved_cart_items) > 0) :
                            $ids = array();
                            foreach($saved_cart_items as $id=>$name){
                                array_push($ids, $id);
                            }
                            $products_list_from_db = get_product_detail($ids);
                            $item_count = 0;
                            
                            if (is_array($products_list_from_db)):
                            foreach ($products_list_from_db as $product) :
                              $quantity = $saved_cart_items[$product['pId']]['quantity'];
                              
                            ?>
                            <div class="product">
                                <div class="row justify-content-center align-items-center">
                                    <div class="col-md-3">
                                        <div class="product-image"><img class="img-fluid d-block mx-auto image" src="<?php echo get_product_image_src($product['CategoryId'], $product['pId'], $product['imageType']); ?>"></div>
                                    </div>
                                    <div class="col-md-5 product-info"><a href="index.php?content=product_detail" class="product-name" style="color:#608e3a;"><br><?php echo $product['description1']; ?><br><br></a>
                                        <div class="product-specs">
                                            <div><span>Made by:&nbsp;</span><span class="value"><?php echo $product['brand']; ?></span></div>
                                            <div></div>
                                            <div></div>
                                        </div>
                                    </div>
                                    <div class="col-6 col-md-2 quantity"><label class="d-none d-md-block" for="quantity">Quantity</label>
                                        <!--<a href="#" class="product-name" style="color:#608e3a;"><i class="fa fa-trash fa-2x" aria-hidden="true"></i></a>-->
                                        <input type="number" value="<?php echo $quantity; ?>" id="number" class="form-control quantity-input" min="1" max="5" onchange="change_quantity('<?php echo $product['pId']; ?>',this.value);">
                                        
                                    </div>
                                    <div class="col-6 col-md-2 price"><span style="color:#608e3a;">$<?php echo $product['price']; ?></span>
                                        <br/><br /><a href="includes/remove_from_cart.php?pid=<?php echo $product['pId']; ?>" class="btn btn-default" style="padding:5px;color:#608e3a;font-size:14px;font-family:sans-serif;font-style: normal;border: 1px solid #608e3a;"><span>Delete</span></a>
                                    </div>
                                </div>
                            </div>
                            <?php 
                            $sub_total=$product['price'] * $quantity;
                            $total += $sub_total;
                            $item_count++;
                            endforeach; endif;
                            else : ?>
                                <div class="product">
                                    <h1>Shopping Cart is Empty!</h1>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="col-md-12 col-lg-4">
                        <div class="summary" style="background-color:rgba(184,156,132,0.16);">
                            <h3 style="color:#608e3a;">Summary</h3>
                            <h4 style="border-top:1px solid #608e3a;"><span class="text">Subtotal</span><span class="price">$<?php echo $total; ?></span></h4>
                            <h4><span class="text">Taxes</span><span class="price">$0</span></h4>
                            <h4></h4>
                            <h4>
                                <span class="text" style="color:#608e3a;">Total</span>
                                <span class="price">$<?php echo $total; ?></span>
                            </h4>
                            <button onclick="location.href='index.php?content=payment&amount=<?php echo $total; ?>'" class="btn btn-primary btn-block btn-lg" type="button" style="background-color:#608e3a;box-shadow:0 0 0 .2rem #608e3a;border-color:#608e3a;">Checkout</button></div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>
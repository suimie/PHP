


<?php
/**
 * index.php
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
if (isset($_GET['action']) && $_GET['action'] == 'logout'){
    unset($_SESSION); 
    session_destroy();
}else if(isset($_GET['login']) && $_GET['login'] == 'succ'){
    session_start();
}
require_once $_SERVER['DOCUMENT_ROOT'].'/ThePitStop_PHP/init.php';
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Home | The Food Pit Stop</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Montserrat:400,400i,700,700i,600,600i">
        <link rel="stylesheet" href="assets/fonts/font-awesome.min.css">
        <link rel="stylesheet" href="assets/fonts/simple-line-icons.min.css">
        <link rel="stylesheet" href="assets/css/Bold-BS4-Cards-with-Hover-Effect-115.css">
        <link rel="stylesheet" href="assets/css/Bold-BS4-Cards-with-Hover-Effect-115.css">
        <link rel="stylesheet" href="assets/css/Bold-BS4-Footer-Big-Logo.css">
        <link rel="stylesheet" href="assets/css/Carousel-Hero.css">
        <link rel="stylesheet" href="assets/css/Hover-Product.css">
        <link rel="stylesheet" href="assets/css/Hover-Product.css">
        <link rel="stylesheet" href="assets/css/Pretty-Search-Form.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/aos/2.1.1/aos.css">
        <link rel="stylesheet" href="assets/css/Navigation-Clean.css">
        <link rel="stylesheet" href="assets/css/Navigation-e-commerce.css">
        <link rel="stylesheet" href="assets/css/Search-Field-With-Icon.css">    
        <!--<script type="text/javascript" src="scripts/functions_for_catalog.js"></script>-->
        <script>
        function click_checkbox(category_count, brand_count){
            var categories = "";
            for(var i=1; i <= category_count; i++){
                var ckb = document.getElementById("formCheck-"+i);

                if (ckb.checked == true){
                    if (categories !== "")
                        categories += "+";
                    categories+=document.getElementById("formCheck-"+i).title;
                }
            }

            var brands = "";
            for(var i=category_count+1; i <= brand_count; i++){
                var ckb = document.getElementById("formCheck-"+i);

                if (ckb.checked == true){
                    if (brands !== "")
                        brands += "+";
                    brands += document.getElementById("formCheck-"+i).title;
                }
            }

            window.alert("Category:" + categories + ", Brand:" + brands);



            var xhttp = new XMLHttpRequest();
            xhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    document.getElementById("filter_list").innerHTML = this.responseText;
                }
            };
            //xhttp.open("GET", "../index.php?content=catalog_page&category=&brand=&page=2", true);
            xhttp.open("GET", "contents/catalog_sidebar_filter_div.php?content=catalog_page&category=" + categories +"&brand=" + brands + "&page=1", true);

            xhttp.send();

        //    sleep(1000);

            var xhttp = new XMLHttpRequest();
            xhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    document.getElementById("product_list").innerHTML = this.responseText;
                }
            };
            //xhttp.open("GET", "../index.php?content=catalog_page&category=&brand=&page=2", true);
            xhttp.open("GET", "contents/catalog_products_div.php?content=catalog_page&category=" + categories +"&brand=" + brands + "&page=1", true);

            xhttp.send();
        }
        
        function change_quantity(pid, quantity) {
            window.location.href = "includes/update_quantity.php?pid=" + pid + "&quantity=" + quantity;
        }
        
        
        function search_item(){
            var search_key_str = document.getElementById("search_key").value;
            window.location.href = 'index.php?content=catalog_page&page=1&category=&brand=&searchkey=' + search_key_str;
        }
        
        function procee_keyup(e){
            if (e.keyCode == 13) {
                var key_value = document.getElementById("search_key").value;
                window.location.href = 'index.php?content=catalog_page&page=1&category=&brand=&searchkey=' + key_value;
                
                return false;
            }
            return true;
        }
        </script>

    </head>

    <body>
        <?php
        // put your code here
        ?>
    <nav class="navbar navbar-light navbar-expand-lg fixed-top bg-white clean-navbar" style="/*height:120px;*/">
        <div class="container"><a class="navbar-brand logo" href="index.php?content=home">THE FOOD PIT STOP</a><button class="navbar-toggler" data-toggle="collapse" data-target="#navcol-1"><span class="navbar-toggler-icon"><span class="sr-only">Toggle navigation</span></span></button>
            <div class="collapse navbar-collapse"
                id="navcol-1">
                <ul class="nav navbar-nav ml-auto">
                    <li class="nav-item" role="presentation"><a class="nav-link <?php echo active_menu('home'); ?>" href="index.php?content=home">Home</a></li>
                    <li class="nav-item"><a class="nav-link <?php echo active_menu('catalog_page'); ?>" href="index.php?content=catalog_page&category=&brand=&page=1">PRODUCTS</a>
                    <!--
                    <li class="dropdown"><a class="dropdown-toggle nav-link dropdown-toggle" data-toggle="dropdown" aria-expanded="false" href="index.php?content=catalog_page">PRODUCTS</a>
                        <div class="dropdown-menu" role="menu"><a class="dropdown-item" role="presentation" href="catalog-page.html">First Item</a><a class="dropdown-item" role="presentation" href="#">Second Item</a><a class="dropdown-item" role="presentation" href="#">Third Item</a></div>
                    -->
                    </li>
                    <?php 
                    if (isset($_SESSION['username'])) : ?>
                    <li class="nav-item" role="presentation"><a id="sign_in_out" class="nav-link <?php echo active_menu('login'); ?>" href="index.php?content=login&login=fail">
                            SIGN OUT
                    <?php else : ?>
                    <li class="nav-item" role="presentation"><a id="sign_in_out" class="nav-link <?php echo active_menu('login'); ?>" href="index.php?content=login&action=login">
                            SIGN IN                        
                    <?php endif; ?>
                        </a></li>
                    <li class="nav-item" role="presentation"><a class="nav-link <?php echo active_menu('about_us'); ?>" href="index.php?content=about_us">About Us</a></li>
                    <li class="nav-item" role="presentation"><a class="nav-link <?php echo active_menu('contact_us'); ?>" href="index.php?content=contact_us">Contact Us</a></li>
                </ul><span class="navbar-text" style="padding-right:12px;"><a href="#" style="font-weight:600;line-height:19.2px;">EN|</a><a href="#" style="line-height:19.2px;font-weight:600;">FR</a></span>
                <span class="navbar-text">
                    <a href="index.php?content=shopping_cart">
                        <img src="<?php echo cart_image('shopping_cart'); ?>" onmouseover="this.src='assets/img/cart2.png';" onmouseout="this.src='<?php echo cart_image('shopping_cart'); ?>';" width="40px" height="40px">
                    </a>
                </span>
                <span class="navbar-text" style="font-family:Montserrat, sans-serif;padding-bottom:14px;font-weight:bold;color:red">
                <?php
                    // count items in the cart
                    $cookie = isset($_COOKIE['pitstop_cart_items_cookie']) ? $_COOKIE['pitstop_cart_items_cookie'] : "";
                    if ($cookie == "")  $cart_count = 0;
                    else{
                        $cookie = stripslashes($cookie); 
                        $saved_cart_items = json_decode($cookie, true);
                        $cart_count = count($saved_cart_items);
                    }
                    echo $cart_count;
                ?>
                </span>
            </div>
        </div>
    </nav>
    <form class="search-form" style="margin-top:100px;">
        <div class="input-group">
            <div class="input-group-prepend"><span class="input-group-text"><i class="fa fa-search"></i></span></div><input id="search_key" class="form-control" type="text" placeholder="I am looking for.." style="margin-right:5px;border-right:1px solid #b4c1cb" onkeypress="return procee_keyup(event);">
            <div class="input-group-append"><button class="btn btn-light" type="button" onclick="search_item();">Search </button></div>
        </div>
    </form>
        
        <!-- start : main area -->
    <?php
                loadContent('content', 'home');
    ?>
        <!-- end : main area -->

    <footer id="myFooter" style="background-color:#608e3a;">
        <div class="container-fluid">
            <div class="row text-center">
                <div class="col-12 col-sm-6 col-md-3">
                    <h1 class="logo" style="margin-top:30px;"><a href="#">&nbsp;LOGO&nbsp;</a></h1>
                    <p class="mb-1" style="color:rgb(210,210,210);"><i class="fa fa-map-marker fa-fw"></i>&nbsp;Main Road - Tamarin - Canada</p>
                    <p class="mb-1" style="color:rgb(210,210,210);"><i class="fa fa-phone fa-fw"></i>&nbsp;+1 800 137 56 78</p>
                    <p class="mb-1"><i class="fa fa-envelope fa-fw"></i>&nbsp;<a href="mailto:contact@company.com" class="text-dark" style="color:rgb(210,210,210);">contact@company.com</a></p>
                </div>
                <div class="col-12 col-sm-6 col-md-2">
                    <h5>Get started</h5>
                    <ul>
                        <li><a href="#">Home</a></li>
                        <li><a href="#">Downloads<br></a></li>
                        <li><a href="#">Sign Up</a></li>
                        <li><a href="#">Other Links</a></li>
                    </ul>
                </div>
                <div class="col-12 col-sm-6 col-md-2">
                    <h5>Our Company</h5>
                    <ul>
                        <li><a href="#">About Us</a></li>
                        <li><a href="#">Company Information<br></a></li>
                        <li><a href="#">Reviews</a></li>
                        <li><a href="#">Contacts</a></li>
                    </ul>
                </div>
                <div class="col-sm-6 col-md-2">
                    <h5>Support</h5>
                    <ul>
                        <li><a href="#">FAQ</a></li>
                        <li><a href="#">Help Desk<br></a></li>
                        <li><a href="#">Forums</a></li>
                        <li><a href="#">External Links</a></li>
                    </ul>
                </div>
                <div class="col-md-3 social-networks">
                    <div></div><a href="#" class="facebook"><i class="fa fa-facebook"></i></a><a href="#" class="twitter"><i class="fa fa-twitter"></i></a><a href="#" class="google"><i class="fa fa-google-plus"></i></a><a href="#" class="linkedin"><i class="fa fa-linkedin"></i></a>
                    <button
                        class="btn btn-primary" type="button" style="margin-top:20px;background-color:rgba(235,227,221,0.47);">Contact us</button>
                </div>
            </div>
            <div class="row footer-copyright" style="background-color:#608e3a;">
                <div class="col" style="background-color:#608e3a;">
                    <p>© 2016 Copyright Text ~ Designed By&nbsp;<a href="#">MySelf</a></p>
                </div>
            </div>
        </div>
    </footer>
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
    <script src="assets/js/Hover-Product.js"></script>
    <script src="assets/js/theme.js"></script>
    <script src="assets/js/bs-animation.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/aos/2.1.1/aos.js"></script>
</body>

</html>

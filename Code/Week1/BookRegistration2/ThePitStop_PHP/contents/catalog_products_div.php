<?php
/**
 * catalog_products_div.php
 * 
 * content for the catalog page
 * 
 * @version 1.0 2018-04-19
 * @package The Food Pit Stop
 * @copyright (c) 2018, Anita Mirshahi, Suim Park, Valini Rangasamy
 * @license 
 * @since Release 1.0
 */
/*
function logging2($message){
    $filename = "../Log/" . date("Ymd") . ".txt";
    $myfile = fopen($filename, "a") or die("Unable to open file!");
    fwrite($myfile, date("Ymd_H:i:s ") . $message . "\n");
}

function get_array_from_url2($which){
    $sidebar_which = filter_input(INPUT_GET, $which, FILTER_SANITIZE_STRING);
    
    $ip = "123.456.789.000"; // some IP address
    $sidebar_which_arr = explode("+", $sidebar_which); 
   
   return $sidebar_which_arr;
}
//require_once 'includes/init.php';
function get_products($categoryarr, $brandarr){
    $host = 'localhost';
    $user = 'root';
    $pw = '';
    $dbName = 'pitstop';
    $conn = new mysqli($host, $user, $pw, $dbName);

//    $conn = connect_db();
    if($conn === null){
        return null;
    }
    
    $sql = "SELECT * from products ";
    if (count($categoryarr) > 0 || count($brandarr) >0){
        $category_where = "";
        foreach($categoryarr as $category){
            logging2(__FILE__ . ":" . __LINE__ . $category);
            if($category_where != "")
                $category_where .= " AND ";
            
            $category_where .= "category = '" . $category . "'";
        }
        
        $brand_where = "";
        foreach($brandarr as $brand){
            if ($brand == "")   continue;
            
            logging2(__FILE__ . ":" . __LINE__ . $brand);
            if($brand_where != "")
                $brand_where .= " AND ";
            
            $brand_where .= "brand = '" . $brand . "'";
        }
        
        logging2(__FILE__ . ":" . __LINE__ . $category_where);        
        logging2(__FILE__ . ":" . __LINE__ . $brand_where);
        if ($category_where != "" and $brand_where != "")
            $sql .= "WHERE " . $category_where . " AND " . $brand_where;
        else if ($category_where != ""){
            logging2(__FILE__ . ":" . __LINE__ . $category_where); 
            $sql .= "WHERE " . $category_where;
        }else
            $sql .= "WHERE " . $brand_where;
    }
    
    logging2(__FILE__ . ":" . __LINE__ . $sql);
    $result = $conn->query($sql);
    
    //disconnect_db($conn);
    $conn->close();
    
    if ($result->num_rows > 0) {
        // output data of each row
        $rows = array();
        while($row = $result->fetch_assoc()) {
            $rows[] = $row;
        }
        return $rows;
    } 
        
    return null;
}*/
require_once $_SERVER['DOCUMENT_ROOT'].'/ThePitStop_PHP/init.php';
?>

<div class="products">
    <div class="row no-gutters">
        <?php
        //$category_str_url = filter_input(INPUT_GET, 'category', FILTER_SANITIZE_STRING);
        //$brand_str_url = filter_input(INPUT_GET, 'brand', FILTER_SANITIZE_STRING);

        if (isset($_GET['searchkey'])){
            $search_url = $_GET['searchkey'];
            $search_array = explode(" ", $search_url);
            
            $products_list_from_db = get_products_with_searchkey($search_array);
            
            $linkstr = 'index.php?content=catalog_page&searchkey=' . $search_url;
        }else{
            $category_array_url = get_array_from_url('category');   // categoryId array from split url
            $brand_array_url = get_array_from_url('brand');         // brandId array from split url

            $current_page = filter_input(INPUT_GET, 'page', FILTER_SANITIZE_STRING);
            $category_str_url = get_url_from_array($category_array_url);
            $brand_str_url = get_url_from_array($brand_array_url);
        
            $linkstr = 'index.php?content=catalog_page&category=' . $category_str_url . '&brand=' . $brand_str_url;

            $products_list_from_db = get_products($category_array_url, $brand_array_url);

        }
        $total_no_products = 0;
        if ($products_list_from_db != null) :
            $total_no_products = count($products_list_from_db);
        foreach ($products_list_from_db as $p_c => $product) :
        ?>
            <?php
            if ($p_c < (($current_page * 9) - 9))
                continue;
            else if ($p_c > (($current_page * 9) - 1))
                break;
            ?>
            <div class="col-12 col-md-6 col-lg-4">
                <div class="clean-product-item">
                    <div class="image"><a href="index.php?content=product_detail&pid=<?php echo $product['pId']; ?>&quantity=1"><img class="img-fluid d-block mx-auto" src="<?php echo get_product_image_src($product['CategoryId'], $product['pId'], $product['imageType']); ?>"></a></div>
                    <div class="product-name"><a href="includes/add_to_cart.php?pid=<?php echo $product['pId']; ?>&quantity=1"><?php echo $product['description1']; ?></a></div>
                    <div class="about">
                        <div class="rating"><img src="assets/img/star.svg"><img src="assets/img/star.svg"><img src="assets/img/star.svg"><img src="assets/img/star-half-empty.svg"><img src="assets/img/star-empty.svg"></div>
                        <div class="price">
                            <h3>$<?php echo $product['price']; ?></h3>
                        </div>
                    </div>
                </div>
            </div>

        <?php endforeach; endif; ?>

    </div>
    <nav>
        <ul class="pagination">
            <?php
            
            if ($total_no_products > 9) :
                ?>
                <li class="page-item <?php if ($current_page == 1) echo 'disabled'; ?>"><a class="page-link" aria-label="Previous" <?php if ($current_page > 1) : ?>
                                                                                               href="<?php echo $linkstr ?>&page=<?php echo $current_page - 1; ?>"
                                                                                           <?php endif; ?>>
                        <span aria-hidden="true">«</span></a></li>
                <?php
                    $pages = (($total_no_products % 9) == 0) ? ($total_no_products / 9) : ($total_no_products / 9) + 1;
                    for ($i = 1; $i <= $pages; $i++) :
                ?>
                    <li class="page-item <?php echo ($i == $current_page) ? 'active' : ''; ?>"><a class="page-link" href="<?php echo $linkstr ?>&page=<?php echo $i; ?>"><?php echo $i; ?></a></li>
                <?php endfor; ?>
                <li class="page-item <?php if ($current_page == $pages) echo 'disabled'; ?>"><a class="page-link" aria-label="Next" <?php if ($current_page < $pages) : ?>
                                                                                                    href="<?php echo $linkstr ?>&page=<?php echo $current_page + 1; ?>"
                                                                                                <?php endif; ?>>
                        <span aria-hidden="true">»</span></a></li>
            <?php endif; ?>
        </ul>
    </nav>
</div>
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
require_once $_SERVER['DOCUMENT_ROOT'].'/ThePitStop_PHP/init.php';
?>
<div class="filter-item">
    <h3>Categories</h3>
    <?php
    $checkbox_counter = 1;
    $categories = get_categories();     // array with pair of {categoryId, category} from db
    $category_array = get_array_from_url('category');   // categoryId array from split url
    $brands = get_brands2($category_array);  // array with pair of {brandId, brand} from db
    $brand_array = get_array_from_url('brand');   // categoryId array from split url
    if (get_count_2d_array($categories) > 0) :
    foreach ($categories as $category) :
        ?>
        <div class="form-check"><input class="form-check-input" type="checkbox" title="<?php echo $category['categoryId']; ?>"
            <?php
            if (in_array($category['categoryId'], $category_array)){
            //if ($selected_category === $category['category']) {
                echo "checked='checked'";
            }
            ?> 
            id="formCheck-<?php echo $checkbox_counter; ?>"  onclick="click_checkbox(<?php echo get_count_2d_array($categories); ?>, <?php echo get_count_2d_array($brands); ?>)"><label class="form-check-label" id="labelCheck-<?php echo $checkbox_counter; ?>" for="formCheck-<?php echo $checkbox_counter; ?>"><?php echo $category['category'] ?></label></div>

        <?php
        $checkbox_counter++;
    endforeach;
    endif;
    ?>

</div>
<div class="filter-item">
    <h3>Brands</h3>
    <?php
    if (get_count_2d_array($brands) > 0) :
    foreach ($brands as $brand) :
        ?>
        <div class="form-check"><input class="form-check-input" type="checkbox" title="<?php echo $brand['brandId']; ?>"
            <?php
            if (in_array($brand['brandId'], $brand_array)){
                echo "checked='checked'";
            }
            ?> 
            id="formCheck-<?php echo $checkbox_counter; ?>" onclick="click_checkbox(<?php echo get_count_2d_array($categories); ?>, <?php echo get_count_2d_array($brands); ?>)"><label class="form-check-label" id="labelCheck-<?php echo $checkbox_counter; ?>" for="labelCheck-<?php echo $checkbox_counter; ?>"><?php echo $brand['brand'] ?></label></div>
            <?php
            $checkbox_counter++;
            endforeach;
            endif;
            ?>
</div>

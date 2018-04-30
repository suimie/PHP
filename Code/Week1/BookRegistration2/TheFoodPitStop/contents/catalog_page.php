<?php
/**
 * catalog_page.php
 * 
 * content for the catalog page
 * 
 * @version 1.0 2018-04-19
 * @package The Food Pit Stop
 * @copyright (c) 2018, Anita Mirshahi, Suim Park, Valini Rangasamy
 * @license 
 * @since Release 1.0
 */
?>

<main class="page catalog-page">
    <section class="clean-block clean-catalog dark" style="background-color:rgba(184,156,132,0.28);">
        <div class="container">
            <div class="block-heading" style="margin-top:-38px;">
                <h1 style="color:#608e3a;">Products Page</h1>                    
                <?php
                $selected_category = filter_input(INPUT_GET, 'category', FILTER_SANITIZE_STRING);
                $selected_brand = filter_input(INPUT_GET, 'brand', FILTER_SANITIZE_STRING);
                $current_page = filter_input(INPUT_GET, 'page', FILTER_SANITIZE_STRING);
                ?>
                    <!--<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc quam urna, dignissim nec auctor in, mattis vitae leo.</p>-->
            </div>
            <div class="content">
                <div class="row">
                    <div class="col-md-3">
                        <div class="d-none d-md-block">
                            <div class="filters" id="filter_list">
                            <!-- fillers -->
                            <?php include 'catalog_sidebar_filter_div.php'; ?>
                            </div>
                        </div>
                    </div>
                    <!-- product rows -->
                    <div class="col-md-9" id="product_list">
                        <?php include 'catalog_products_div.php'; ?>
                    </div>                        
                    <!-- product rows -->
                </div>
            </div>
        </div>
    </section>
</main>

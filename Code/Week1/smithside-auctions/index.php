<?php
/**
 * index.php
 * 
 * Main content
 * 
 * @version 1.2 2018-04-16
 * @package Smithside Auction SP
 * @copyright (c) 2018, Suim Park
 * @license GNU General Public License
 * @since since Release 1.0
 */

require_once 'includes/init.php';
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <title>Home | Smithside Auctions 2018</title>
        <link href="css/main.css" rel="stylesheet" type="text/css" />
    </head>

    <body>
        <div id="container">

            <div id="header">
                <a href="index.html">
                    <img src="images/banner.jpg"  alt="Smithside Auctions" />
                </a> 
            </div><!-- end header -->

            <div id="navigation">
                <h3 class="element-invisible">Menu</h3>
                <ul class="mainnav">
                    <li><a href='index.php?content=categories'>Lot Categories</a></li>
                    <li><a href="index.php?content=about">About Us</a></li>
                    <li><a href="index.php?content=home">Home</a></li>
                </ul>
                <div class="clearfloat"></div>
            </div><!-- end navigation -->

            <div class="message">
                <?php 
                    $conn = Database::getConnection(); 
                    if ($result = $conn->query('select database()')){
                        $row = $result->fetch_array(MYSQLI_NUM);
                        echo '<p>*** Using Database ' . $row[0] . ' ***</p>';
                    }
                ?>
            </div><!-- end message -->	

            <div class="sidebar">
                <?php 

                loadContent('sidebar', '');
                //include 'content/' . 'catnav.php';
                ?>
            </div><!-- end sidebar -->
            

            <div class="content">
                <?php
                    loadContent('content', 'home');
                ?>

            </div><!-- end content -->

            <div class="clearfloat"></div>

            <div id="footer">
                <p>&copy; <?php echo date('Y') ?> Your Initials Smithside Auctions</p>
            </div><!-- end footer -->

        </div><!-- end container -->
    </body>
</html>

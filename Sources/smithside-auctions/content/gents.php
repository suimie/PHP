<?php
/**
 * gents.php
 * 
 * content for the about page
 * 
 * @version 1.2 2018-04-16
 * @package Smithside Auction SP
 * @copyright (c) 2018, Suim Park
 * @license GNU General Public License
 * @since since Release 1.0
 */
?>

<?php
    // get the lot information
$lots = array();
$lots[0]['lot_number'] = '1';
$lots[0]['image'] = 'naval-19-173.jpg';
$lots[0]['name'] = "naval officer's formal tailcoat, 1840s";
$lots[0]['description'] = 'Black wool broadcloth, double breast front, missing 3 of 18 raised round gold buttons  
                        crossed cannon barrels "Ordnance Corps" text, silver sequin  tinsel embroidered emblem 
                        on each square cut tail, quilted black silk lining, very good;';
$lots[0]['price'] = 5700;

$lots[1]['lot_number'] = '2';
$lots[1]['image'] = 'gents-striped-8-26.jpg';
$lots[1]['name'] = 'striped cotton tailcoat, america, 1835-1845';
$lots[1]['description'] = "Orange and white pin-striped twill cotton, double breasted, turn down collar, waist seam, 
                        self-fabric buttons, inside single button pockets in each tail, (soiled, faded, cuff edges
                         frayed) good.";
$lots[1]['price'] = 20700;

$lots[2]['lot_number'] = '3';
$lots[2]['image'] = 'gents-black-8-27.jpg';
$lots[2]['name'] = 'black broadcloth tailcoat, 1830-1845';
$lots[2]['description'] = 'Fine thin wool broadcloth, double breasted, notched collar, horizontal front and side waist seam,
                         slim long sleeves with notched cuffs, curved tails, black silk satin lining quilted in diamond pattern,
                          padded and quilted chest, black silk covered buttons, (buttons worn) excellent.';
$lots[2]['price'] = 3450;

$counter = 0;
?>
<h1>Product Category: Gents</h1>

<ul class="ulfancy">

        <li class="row<?php echo $counter % 2; ?>">					
                <div class="list-photo"><a href="images/<?php echo $lots[$counter]['image']; ?>">
                        <img src="images/thumbnails/<?php echo $lots[$counter]['image']; ?>"  alt="" /></a>
                </div>			
                <div class="list-description">
                        <h2><?php echo ucwords($lots[$counter]['name']); ?></h2>
                        <p><?php echo htmlspecialchars($lots[$counter]['description']); ?> </p>
                        <p><strong>Lot:</strong> #<?php echo $lots[$counter]['lot_number']; ?> 
                        <strong>Price:</strong>$<?php echo number_format($lots[$counter]['price'], 2); ?></p>
                        <?php
                        // increment the counter
                        $counter++;
                        ?>
                </div>			
                <div class="clearfloat"></div>
        </li>

        <li class="row<?php echo $counter % 2; ?>">
                <div class="list-photo"><a href="images/<?php echo $lots[$counter]['image']; ?>">
                        <img src="images/thumbnails/<?php echo $lots[$counter]['image']; ?>"  alt="" /></a>
                </div>
                <div class="list-description">
                        <h2><?php echo ucwords($lots[$counter]['name']); ?></h2>
                        <p><?php echo htmlspecialchars($lots[$counter]['description']); ?></p>
                        <p><strong>Lot:</strong> #<?php echo $lots[$counter]['lot_number']; ?> 
                        <strong>Price:</strong>$<?php echo number_format($lots[$counter]['price'], 2); ?></p>
                        <?php
                        // increment the counter
                        $counter++;
                        ?>                </div>
                <div class="clearfloat"></div>
        </li>

        <li class="row<?php echo $counter % 2; ?>">				
                <div class="list-photo"><a href="images/<?php echo $lots[$counter]['image']; ?>">
                        <img src="images/thumbnails/<?php echo $lots[$counter]['image']; ?>"  alt="" /></a>
                </div>
                <div class="list-description">
                        <h2><?php echo ucwords($lots[$counter]['name']); ?></h2>
                        <p><?php echo htmlspecialchars($lots[$counter]['description']); ?></p>
                        <p><strong>Lot:</strong> #<?php echo $lots[$counter]['lot_number']; ?>
                        <strong>Price:</strong> $<?php echo number_format($lots[$counter]['price'], 2); ?></p>
                        <?php
                        // increment the counter
                        $counter++;
                        ?>                </div>
                <div class="clearfloat"></div>
        </li>

</ul>

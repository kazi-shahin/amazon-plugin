<?php
/**
 * Created by PhpStorm.
 * User: Dell
 * Date: 12/18/2017
 * Time: 6:19 PM
 */
include 'header.php'; ?>
<?php $AMAZON_PRODUCT = new amazon_search(AWS_ACCESS_KEY, AWS_SECRET_KEY, ASSOCIATIVE_ID); ?>
<!--Content START -->
<div class="col-lg-9 col-sm-6">
    <?php 
    	$productID = isset($_GET['id']) && trim($_GET['id']) ? trim($_GET['id']) : 'B01LBHSBUG';
		$AMAZON_PRODUCT->get_single_product($productID);
     ?>
</div>
<!--Content END -->
<?php 
$categories = $AMAZON_PRODUCT->getCategories();
include 'sidebar.php'; ?>
<?php include 'footer.php'; ?>
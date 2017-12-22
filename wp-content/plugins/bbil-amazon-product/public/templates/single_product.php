<?php
/**
 * Created by PhpStorm.
 * User: Dell
 * Date: 12/18/2017
 * Time: 6:19 PM
 */
get_header();

$productID = isset($_GET['id']) && trim($_GET['id']) ? trim($_GET['id']) : 'B01LBHSBUG';
$AMAZON_PRODUCT = new amazon_search(AWS_ACCESS_KEY, AWS_SECRET_KEY, ASSOCIATIVE_ID);
$AMAZON_PRODUCT->get_single_product($productID); 
?>
<?php get_footer();
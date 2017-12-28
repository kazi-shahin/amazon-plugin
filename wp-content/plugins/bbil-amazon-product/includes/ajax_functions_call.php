<?php 

class ajax_functions {
	function __construct() {

		// Load more products
		add_action('wp_ajax_loadMoreProducts', array( $this, 'bbil_loadMoreProducts_ajax_handler'));
		add_action('wp_ajax_nopriv_loadMoreProducts', array( $this, 'bbil_loadMoreProducts_ajax_handler'));

		// Search products
		add_action('wp_ajax_searchProduct', array( $this, 'bbil_searchProduct_ajax_handler' ));
		add_action('wp_ajax_nopriv_searchProduct', array( $this, 'bbil_searchProduct_ajax_handler' ));

		// Search products by category
		add_action('wp_ajax_searchProductByCategory', array( $this, 'bbil_searchProductByCategory_ajax_handler' ));
		add_action('wp_ajax_nopriv_searchProductByCategory', array( $this, 'bbil_searchProductByCategory_ajax_handler' ));
	}

	function bbil_loadMoreProducts_ajax_handler() {
		$args = [];
		$args['SearchIndex'] = isset($_POST['SearchIndex']) ? $_POST['SearchIndex'] : 'All';
		$args['ItemPage'] = isset($_POST['ItemPage']) ? $_POST['ItemPage'] : 2; // $args['ItemPage'] = 9;
		$args['Keywords'] = isset($_POST['Keywords']) ? $_POST['Keywords'] : '';
		$args['MinPercentageOff'] = isset($_POST['MinPercentageOff']) ? $_POST['MinPercentageOff'] : 0;

		if ($args['Keywords']) {
			$AMAZON_PRODUCT = new amazon_search(AWS_ACCESS_KEY, AWS_SECRET_KEY, ASSOCIATIVE_ID);
		    echo $AMAZON_PRODUCT->loadMoreProducts($args);
		}
		// echo "<br>".json_encode($args);
		wp_die();
	}

	function bbil_searchProduct_ajax_handler() {
		$data = [];
		$args = ['SearchIndex' => 'All'];
		$args['MinPercentageOff'] = isset($_POST['MinPercentageOff']) ? $_POST['MinPercentageOff'] : '0';
		$args['Keywords'] = isset($_POST['Keywords']) ? $_POST['Keywords'] : false;
		$args['ItemPage'] = 1; // load first page

		if ($args['Keywords']) {
			$AMAZON_PRODUCT = new amazon_search(AWS_ACCESS_KEY, AWS_SECRET_KEY, ASSOCIATIVE_ID);
	    	$data['products'] = $AMAZON_PRODUCT->loadMoreProducts($args);
	    	$data['Keywords'] = $args['Keywords'];
	    	$data['MinPercentageOff'] = $args['MinPercentageOff'];
	    	$data['maxPages'] = $AMAZON_PRODUCT->get_total_pages();

	    	echo json_encode($data);
		} else { echo "name empty"; }

		wp_die();
	}

	function bbil_searchProductByCategory_ajax_handler() {
		$data = [];
		$args = [];
		$args['SearchIndex'] = isset($_POST['SearchIndex']) ? $_POST['SearchIndex'] : 'All';
		$args['MinPercentageOff'] = isset($_POST['MinPercentageOff']) ? $_POST['MinPercentageOff'] : '0';
		$args['Keywords'] = isset($_POST['Keywords']) ? $_POST['Keywords'] : false;
		$args['ItemPage'] = 1; // load first page

		if ($args['Keywords']) {
			$AMAZON_PRODUCT = new amazon_search(AWS_ACCESS_KEY, AWS_SECRET_KEY, ASSOCIATIVE_ID);
	    	$data['products'] = $AMAZON_PRODUCT->loadMoreProducts($args);
	    	if (!$data['products']) { $data['products'] = '<br><h1 class="text-center text-danger"> Nothing found </h1>'; }
	    	$data['SearchIndex'] = $args['SearchIndex'];
	    	$data['Keywords'] = $args['Keywords'];
	    	$data['MinPercentageOff'] = $args['MinPercentageOff'];
	    	$data['maxPages'] = $AMAZON_PRODUCT->get_total_pages();

	    	echo json_encode($data);
		} else { echo "name empty"; }

		wp_die();
	}
}
$var = new ajax_functions();
<?php 
/**
* Amazon search
*/
class amazon_search extends amazon {
	public $parsed_xml;

	function __construct($ACCESS_KEY,$SECRET_KEY,$ASSOCIATED_TAG) {
		parent::__construct($ACCESS_KEY,$SECRET_KEY,$ASSOCIATED_TAG);
	}
	public function get_search_form($value='') {
		include 'search_form.php';
	}
	public function getProductsArray() {
	    $items = [];
	    $counter = 0;
	    if ($this->parsed_xml['Items']['Item']) {
		    foreach ($this->parsed_xml['Items']['Item'] as $value) {
		        if ($counter == 0) $data['product'] = $value;
		        $items[$counter]['ASIN'] 		= @$value['ASIN'];
		        $items[$counter]['Image'] 		= @$value['MediumImage']['URL']; // LargeImage
		        $items[$counter]['Review'] 		= @$value['CustomerReviews'];
		        $items[$counter]['Title'] 		= @$value['ItemAttributes']['Title'];
		        $items[$counter]['Artist'] 		= @$value['ItemAttributes']['Artist'];
		        $items[$counter]['Binding'] 	= @$value['ItemAttributes']['Binding'];
		        $items[$counter]['Brand'] 		= @$value['ItemAttributes']['Brand'];
		        $items[$counter]['Studio'] 		= @$value['ItemAttributes']['Studio'];
		        $items[$counter]['OldPrice'] 	= @$value['ItemAttributes']['ListPrice']['FormattedPrice'];
		        $items[$counter]['Language'] 	= @$value['ItemAttributes']['Languages']['Language'][0]['Name'];
		        $items[$counter]['NewPrice'] 	= @$value['OfferSummary']['LowestNewPrice']['FormattedPrice'];
		        $items[$counter]['NewPrice'] 	= @$value['OfferSummary']['LowestNewPrice']['FormattedPrice'];
		        $counter++;
		    }
		    $data['items'] = $items;
		    // echo "<pre>". print_r($items, true) ."</pre><hr><hr>";
		    return $data;
	    }
	    return false;
	}
	protected function getProductArray() {
	    $items = [];
	    $counter = 0;
	    $item = $this->parsed_xml['Items']['Item'];
	    
	    $items[$counter]['ASIN'] 		= $item['ASIN'];
	    $items[$counter]['Image'] 		= @$item['LargeImage']['URL'];
	    $items[$counter]['Title'] 		= @$item['ItemAttributes']['Title'];
	    $items[$counter]['Binding'] 	= @$item['ItemAttributes']['Binding'];
	    $items[$counter]['Studio'] 		= @$item['ItemAttributes']['Studio'];
	    $items[$counter]['OldPrice'] 	= @$item['ItemAttributes']['ListPrice']['FormattedPrice'];
	    $items[$counter]['Language'] 	= @$item['ItemAttributes']['Language']['Name'];
	    $items[$counter]['NewPrice'] 	= @$item['OfferSummary']['LowestNewPrice']['FormattedPrice'];
	    // echo "<pre>". print_r($items, true) ."</pre><hr><hr>";
	    
	    $data['items'] = $items;
	    return $data;
	}
	// Render data
	public function getProductHtml($products='') {
		$html= '';
	    if ($products) {
	    	// echo "<pre>". print_r($products, true) ."</pre>"; exit();
	        foreach ($products as $product) {
	            $html .= '<div id="'. $product['ASIN'] .'" class="grid-item col-sm-4">
			            <div class="product-item">
			                <div class="author_logo">
			                    <a href="'. site_url('/single-product/?id='.$product['ASIN']) .'">
			                        <img class="img-responsive" src="'.plugin_dir_url(__FILE__).'../../public/images/amazon.png">
			                    </a>
			                </div>

			                <div class="product-img"> <img class="img-responsive" src="'. $product['Image'] .'"> </div>

			                <div class="product-info">
			                    <div class="product-description"> <p>'. $product['Title'] .'</p> </div>';
			                    if ( $product['Review'] && $product['Review']['HasReviews']) {
				                    $html .= '<div class="review dropdown">
				                        <a href="javascript:;" data-target="#m-target-1" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" role="button" aria-expanded="false">
				                            <span> <i class="fa fa-angle-down" aria-hidden="true"></i> </span>
				                            <span>Review</span>
				                        </a>

				                        <div class="dropdown-menu review-dropdown" aria-labelledby="dLabel">
				                            <iframe src="'. $product['Review']['IFrameURL'] .'" frameborder="0"></iframe>
				                        </div>
				                    </div>';
			                    }

			                    $html .= '<div class="product-price">
			                        <div> <p><b>List Price</b></p> <p class="line-through">'. $product['OldPrice'] .'</p> </div>
			                        <div> <p><b>Your Price</b></p> <p>'. $product['NewPrice'] .'</p> </div>
			                    </div>';

			                    if ($product['Binding'])  	$html .= '<p> <b>Binding: </b> <span>'. $product['Binding'] .'</span> </p>';
			                    if ($product['Studio'])  	$html .= '<p> <b>Studio: </b> <span>'. $product['Studio'] .'</span> </p>';
			                    if ($product['Brand'])  	$html .= '<p> <b>Brand: </b> <span>'. $product['Brand'] .'</span> </p>';
			                    if ($product['Language'])  	$html .= '<p> <b>Language: </b> <span>'. $product['Language'] .'</span> </p>';
			                    if ($product['Studio'])  	$html .= '<p> <b>Studio: </b> <span>'. $product['Studio'] .'</span> </p>';

			                    $html .= '<div class="cart-btn-list">
			                        <button class="btn btn-dark btn-cart">
			                            <i class="fa fa-shopping-cart" aria-hidden="true"></i>
			                            Add to cart
			                        </button>

			                        <button class="btn btn-dark">
			                            <i class="fa fa-facebook" aria-hidden="true"></i>
			                        </button>
			                        <button class="btn btn-dark">
			                            <i class="fa fa-twitter" aria-hidden="true"></i>
			                        </button>
			                        <button class="btn btn-dark">
			                            <i class="fa fa-google-plus" aria-hidden="true"></i>
			                        </button>
			                    </div>
			                </div>
			            </div>
			        </div>';
	        }
	    }
	    return $html;
	    // echo "<pre>". print_r($products, true) ."</pre>";
	}
	public function getProductHtml_old($products='') {
		$html= '';
	    if ($products) {
	        foreach ($products as $product) {
	            $html .= '<li id="'. $product['ASIN'] .'">';
	            $html .= '<img src="'. $product['Image'] .'" alt="" class="image">';
	            $html .= '<h4 class="title">'. $product['Title'] .'<h4>';
	            $html .= 'Binding : '. $product['Binding'] .'<br>';
	            $html .= 'Studio : '. $product['Studio'] .'<br>';
	            $html .= 'OldPrice : '. $product['OldPrice'] .'<br>';
	            $html .= 'NewPrice : '. $product['NewPrice'] .'<br>';
	            $html .= '</li>';
	        }
	    }
	    return $html;
	    // echo "<pre>". print_r($products, true) ."</pre>";
	}
	public function getProducts($args, $is_single=false) {
		$results = $this->requestAPI($args);
		$this->parsed_xml = json_decode(json_encode((array) simplexml_load_string($results)), 1);
		if ( $is_single ) $attributes = $this->getProductArray();
		else $attributes = $this->getProductsArray();
		// echo "<pre>". print_r($this->parsed_xml, true) ."</pre>";
		return $this->getProductHtml($attributes['items']);
		// echo "<pre>". print_r($attributes['product'], true) ."</pre><hr>";
	}
	public function render() {
		$html= '';
		$productItems =  $this->getProducts($this->args);

	    if ($productItems) {
		    $html .= '<div id="productWrapper" class="grid" data_MinPercentageOff="'. $this->MinPercentageOff .'" data_Keywords="'. $this->args['Keywords'] .'" data_maxPages="'. $this->get_total_pages() .'" data_ItemPage="2">';
		        $html .= $productItems;
		    $html .= '</div>';
		    $html .= $this->getLoader();
		}

		echo $html;
	}

	public function loadMoreProducts($args) {
		$this->args = $args;
		return $this->getProducts($this->args);
	}

	public function getCategories() {
		echo '<br><pre>'. print_r($this->parsed_xml, true) .'</pre>'; exit();
	}

	/* ====================================================================
	** ================== ItemLookup (single item) ========================
	** ====================================================================
	**
	** Given an Item identifier, the ItemLookup operation returns some or all of the item attributes, depending on the response group 
	** specified in the request. By default, ItemLookup returns an item’s ASIN, Manufacturer, ProductGroup, and Title of the item. 
	**
	** To look up more than one item at a time, separate the item identifiers by commas.
	**
	** http://docs.aws.amazon.com/AWSECommerceService/latest/DG/ItemLookup.html
	*/
	public function get_single_product($ItemId, $IdType='ASIN') {
		$this->args = [
			'Operation' => 'ItemLookup', 
			'ItemId' => $ItemId, 
			'IdType' => $IdType, 
			'Condition' => 'All'
		];
		echo $this->getProducts($this->args, true);
	}

	public function getLoader() {
		$html = '';
		$html .= '<div class="clearfix" style="clear:both;"></div>';
		$html .= '<div class="spinnerWrapper hidden">';
		$html .= '<div class="spinner"> <div></div> <div></div> <div></div> <div></div> </div>';
		$html .= '</div>';

		return $html;
	}
	public function get_total_pages() {
	    if ($this->parsed_xml) return $this->parsed_xml['Items']['TotalPages'];
	    return false;
	}
	public function get_current_page() {
	    if ($this->parsed_xml) {
	        $currentPageNumber = @$this->parsed_xml['Items']['Request']['ItemSearchRequest']['ItemPage'];
	        return $currentPageNumber ? $currentPageNumber : 1;
	    }
	    return false;
	}
	public function is_valid_request() {
	    if ($this->parsed_xml) return $this->parsed_xml['Items']['Request']['IsValid'];
	    return false;
	}
}
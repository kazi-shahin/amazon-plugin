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
	    // $request = $parsed_xml['Items']['Request'];
	    if ($this->parsed_xml['Items']['Item']) {
		    foreach ($this->parsed_xml['Items']['Item'] as $value) {
		        if ($counter == 0) $data['product'] = $value;
		        $items[$counter]['ASIN'] 		= @$value['ASIN'];
		        $items[$counter]['Image'] 		= @$value['LargeImage']['URL'];
		        $items[$counter]['Title'] 		= @$value['ItemAttributes']['Title'];
		        $items[$counter]['Binding'] 	= @$value['ItemAttributes']['Binding'];
		        $items[$counter]['Studio'] 		= @$value['ItemAttributes']['Studio'];
		        $items[$counter]['OldPrice'] 	= @$value['ItemAttributes']['ListPrice']['FormattedPrice'];
		        $items[$counter]['NewPrice'] 	= @$value['OfferSummary']['LowestNewPrice']['FormattedPrice'];
		        $items[$counter]['NewPrice'] 	= @$value['OfferSummary']['LowestNewPrice']['FormattedPrice'];
		        $counter++;
		    }
		    $data['items'] = $items;
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
	    $items[$counter]['NewPrice'] 	= @$item['OfferSummary']['LowestNewPrice']['FormattedPrice'];
	    $items[$counter]['NewPrice'] 	= @$item['OfferSummary']['LowestNewPrice']['FormattedPrice'];
	    // echo "<pre>". print_r($item, true) ."</pre><hr><hr>";
	    
	    $data['items'] = $items;
	    return $data;
	}
	// Render data
	public function getProductHtml($products='') {
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
		    $html .= '<div id="productWrapper" class="container imageList" data_MinPercentageOff="'. $this->MinPercentageOff .'" data_Keywords="'. $this->args['Keywords'] .'" data_maxPages="'. $this->get_total_pages() .'" data_ItemPage="2">';
		        $html .= '<ul>';
		        	$html .= $productItems;
		        $html .= '</ul>';
		    $html .= $this->getLoader();
		    $html .= '</div>';
		}

		echo $html;
	}

	public function loadMoreProducts($args) {
		$this->args = $args;
		return $this->getProducts($this->args);
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

	protected function getLoader() {
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
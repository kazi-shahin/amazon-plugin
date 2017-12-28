<?php 
/**
* Amazon categories
*/
class amazon_cats extends amazon {
	public $parsed_xml;

	function __construct($ACCESS_KEY,$SECRET_KEY,$ASSOCIATED_TAG) {
		parent::__construct($ACCESS_KEY,$SECRET_KEY,$ASSOCIATED_TAG);
	}

	public function getCategories() {
		$args = ['SearchIndex' => 'Book', 'Title' => 'superman'];
		$results = $this->requestAPI($args);
		$this->parsed_xml = json_decode(json_encode((array) simplexml_load_string($results)), 1);
		$this->parsed_xml = $this->parsed_xml['Items']['Request']['Errors']['Error']['Message'];
		// $replaceStr = [
		// 	'The value you specified for SearchIndex is invalid. Valid values include [' => '',
		// 	'].' => '',
		// 	"'"  => ''
		// ];
		// $this->parsed_xml = strstr($this->parsed_xml, $replaceStr);
		$replaceStr = 'The value you specified for SearchIndex is invalid. Valid values include [';
		$this->parsed_xml = str_replace($replaceStr, '', $this->parsed_xml);
		$this->parsed_xml = str_replace('].', '', $this->parsed_xml);
		$this->parsed_xml = str_replace("'", '', $this->parsed_xml);
		$this->parsed_xml = explode(',', $this->parsed_xml);

		return $this->parsed_xml;
	}
}
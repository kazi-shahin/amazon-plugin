<?php
/**
 * Created by PhpStorm.
 * User: Dell
 * Date: 12/18/2017
 * Time: 6:15 PM
 */
get_header();

$locales = ['co.uk', 'com', 'ca', 'com.br', 'de', 'es', 'fr', 'in', 'it', 'co.jp', 'com.mx'];
$availableFilters = [
    'Keywords' => 'batman, catman',
    'Title' => 'batman', // Exception All and Blended (string)
    'Operation' => 'ItemSearch',
    'ResponseGroup' => 'ItemAttributes,Reviews,Offers,Images',
    'MaximumPrice' => 3241, // Exception All and Blended (string)
    'MinimumPrice' => 3241, // Exception All and Blended (string)
];
define('AWS_SECRET_KEY', 'Qilz3ak8g913Zd5qbNHQlkLbvSkUpncdjWO0ruxp');
define('AWS_ACCESS_KEY', 'AKIAI24SOD3RFJ7DYRNQ');
define('ASSOCIATIVE_ID', 'curesinusitis-20');
//=====================================================
function sign($url, $params) {
    $parsed_url = parse_url($url);
    $query = http_build_query_rfc3986($params);

    $request = array(
        'GET',
        $parsed_url['host'],
        $parsed_url['path'],
        $query
    );
    // echo "<pre>". print_r($request, true) ."</pre>";
    $signature = base64_encode(hash_hmac('sha256', implode("\n", $request), AWS_SECRET_KEY, true));
    return $signature;
}
function requestAPI($params=[]) {
    $requestURI = 'http://webservices.amazon.com/onca/xml?';

    $defaults = array(
        'Service' => 'AWSECommerceService',
        'AWSAccessKeyId' => AWS_ACCESS_KEY,
        'Timestamp' => gmdate('Y-m-d\TH:i:s\Z'),
        'Version' => '2013-08-01',
        'AssociateTag' => ASSOCIATIVE_ID,
        // Configurable items
        'Operation' => 'ItemSearch',
        'ResponseGroup' => 'ItemAttributes,Reviews,Offers,Images',
    );

    $params = array_merge($defaults, $params);
    $params['Signature'] = sign($requestURI, $params);

    $url = $requestURI . http_build_query_rfc3986($params);

    $result = request($url, true);
    return $result;
}
function http_build_query_rfc3986($params) {
    ksort($params);
    $query = http_build_query($params);
    $query = strtr($query, array('%7E' => '~', '+' => '%20'));

    return $query;
}

function request($url, $force = false, $opts = array()) {
    global $http_response_header;
    $headers = array(
        'http' => array(
            'method' => 'GET',
            'user_agent' => "Mozilla/5.0 (X11; Linux i686 on x86_64; rv:5.0) Gecko/20100101 Firefox/5.0",
            'timeout' => 60.0,
            'ignore_errors' => false,
        )
    );

    $context = stream_context_create(array_merge($headers, $opts));
    $result = file_get_contents($url, false, $context);

    if($force || strpos($http_response_header[0], '200') !== false) {
        return $result;
    }

    return false;
}
function getHtmlResult($parsed_xml) {
    $items = [];
    $counter = 0;
    $request = $parsed_xml->Items->Request;
    foreach ($parsed_xml->Items->Item as $value) {
        if ($counter == 0) $data['product'] = $value;
        $items[$counter]['ASIN'] = $value->ASIN;
        $items[$counter]['Image'] = $value->LargeImage->URL;
        $items[$counter]['Title'] = $value->ItemAttributes->Title;
        $items[$counter]['Binding'] = $value->ItemAttributes->Binding;
        $items[$counter]['Studio'] = $value->ItemAttributes->Studio;
        $items[$counter]['OldPrice'] = $value->ItemAttributes->ListPrice->FormattedPrice;
        $items[$counter]['NewPrice'] = $value->OfferSummary->LowestNewPrice->FormattedPrice;
        $items[$counter]['NewPrice'] = $value->OfferSummary->LowestNewPrice->FormattedPrice;
        $counter++;
    }
    $data['items'] = $items;
    return $data;
}
$args = ['SearchIndex' => 'DVD', 'Title' => 'batman'];
$results = requestAPI($args);
$parsed_xml = simplexml_load_string($results);
$attributes = getHtmlResult($parsed_xml);
echo "<pre>". print_r($attributes['items'], true) ."</pre>";
echo "<pre>". print_r($attributes['product'], true) ."</pre><hr>";

get_footer();
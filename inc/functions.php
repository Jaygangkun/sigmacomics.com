<?php

function shopify_call($token, $shop, $api_endpoint, $query = array(), $method = 'GET', $request_headers = array()) {
    
	// Build URL
	$url = "https://" . $shop . ".myshopify.com" . $api_endpoint;
	
	if (!is_null($query) && in_array($method, array('GET', 	'DELETE'))) $url = $url . "?" . http_build_query($query);

	// Configure cURL
	$curl = curl_init($url);
	curl_setopt($curl, CURLOPT_HEADER, TRUE);
	curl_setopt($curl, CURLOPT_RETURNTRANSFER, TRUE);
	curl_setopt($curl, CURLOPT_FOLLOWLOCATION, TRUE);
	curl_setopt($curl, CURLOPT_MAXREDIRS, 3);
	curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, FALSE);
	// curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 3);
	// curl_setopt($curl, CURLOPT_SSLVERSION, 3);
	curl_setopt($curl, CURLOPT_USERAGENT, 'My New Shopify App v.1');
	curl_setopt($curl, CURLOPT_CONNECTTIMEOUT, 30);
	curl_setopt($curl, CURLOPT_TIMEOUT, 30);
	curl_setopt($curl, CURLOPT_CUSTOMREQUEST, $method);

	// Setup headers
	$request_headers[] = "";
	if (!is_null($token)) $request_headers[] = "X-Shopify-Access-Token: " . $token;
	curl_setopt($curl, CURLOPT_HTTPHEADER, $request_headers);

	if ($method != 'GET' && in_array($method, array('POST', 'PUT'))) {
		if (is_array($query)) $query = http_build_query($query);
		curl_setopt ($curl, CURLOPT_POSTFIELDS, $query);
	}
    
	// Send request to Shopify and capture any errors
	$response = curl_exec($curl);
	$error_number = curl_errno($curl);
	$error_message = curl_error($curl);

	// Close cURL to be nice
	curl_close($curl);

	// Return an error is cURL has a problem
	if ($error_number) {
		return $error_message;
	} else {

		// No error, return Shopify's response by parsing out the body and the headers
		$response = preg_split("/\r\n\r\n|\n\n|\r\r/", $response, 2);

		// Convert headers into an array
		$headers = array();
		$header_data = explode("\n",$response[0]);
		$headers['status'] = $header_data[0]; // Does not contain a key, have to explicitly set
		array_shift($header_data); // Remove status, we've already set it above
		foreach($header_data as $part) {
			$h = explode(":", $part);
			$headers[trim($h[0])] = trim($h[1]);
		}

		// Return headers and Shopify's response
		return array('headers' => $headers, 'response' => $response[1]);

	}
    
}

function getCountryCurrencyByIp(){
    $ip = $_SERVER['REMOTE_ADDR'];
    // $ip = '212.20.237.2';
      //$ip = '82.244.215.203'; // France
    $countryCodeList = array('CA','GB','AU','ES','AR','MX','FR','DE','IT','JP','BR','PT','SE','NO','DK','NL','GB','IE');
    if (filter_var($ip, FILTER_VALIDATE_IP)){
        $response = @json_decode(file_get_contents("http://www.geoplugin.net/json.gp?ip=" . $ip));

        if (!empty($response) && isset($response->geoplugin_countryCode) && in_array($response->geoplugin_countryCode,$countryCodeList)){
            return $response;
            //return $response->geoplugin_currencyCode;
        }
        return false;
    }
    return false;
}
function convertCurrency($to)
{
    if (!empty($to)){
        $url = file_get_contents('https://free.currconv.com/api/v7/convert?q=USD_' . $to->geoplugin_currencyCode . '&compact=ultra&apiKey=fe552d4bcb7f493b857942434c926731');
        $json = json_decode($url, true);
        if (!empty($json) ){
            $rate = implode(" ",$json);
            if (!empty($rate)){
                return $rate;
            }
            return false;
        }
        return false;
    }
    return false;
}


function calculateCurrencyAmountWithNullValue($countryCurrency,$countryCurrencyRate,$amount){
  
    
    if (!empty($countryCurrency) && !empty($countryCurrencyRate)){
        if (empty($amount)){
            return "";
        }
        $total = $countryCurrencyRate * $amount;
        if ($countryCurrency->geoplugin_currencySymbol_UTF8 == '€'){
            return number_format($total,2)."$countryCurrency->geoplugin_currencySymbol_UTF8";
        }
     
        if ($countryCurrency->geoplugin_countryCode == 'CA'){
            return $countryCurrency->geoplugin_currencySymbol_UTF8.number_format($total,2)." CAN";
        }
        if ($countryCurrency->geoplugin_countryCode == 'MX'){
            return $countryCurrency->geoplugin_currencySymbol_UTF8.number_format($total,2)." ".$countryCurrency->geoplugin_currencyCode;
        }
        if ($countryCurrency->geoplugin_countryCode == 'AU'){
            return $countryCurrency->geoplugin_currencySymbol_UTF8.number_format($total,2)." ".$countryCurrency->geoplugin_currencyCode;
        }
     
        return $countryCurrency->geoplugin_currencySymbol_UTF8.number_format($total,2);
    }
    if (empty($amount)){
        return"";
    }
     
    return "$".number_format($amount,2);
}

function calculateCurrencyAmount($countryCurrency,$countryCurrencyRate,$amount){
    
    if (!empty($countryCurrency) && !empty($countryCurrencyRate)){
        if (empty($amount)) {
           // return $countryCurrency->geoplugin_currencySymbol_UTF8 . "";
            return "";
        }
        $total = $countryCurrencyRate * $amount;
        if ($countryCurrency->geoplugin_currencySymbol_UTF8 == '€'){
            return number_format($total,2)."$countryCurrency->geoplugin_currencySymbol_UTF8";
        }
        if ($countryCurrency->geoplugin_countryCode == 'CA'){
            return $countryCurrency->geoplugin_currencySymbol_UTF8.number_format($total,2)." CAN";
        }
        if ($countryCurrency->geoplugin_countryCode == 'MX'){
            return $countryCurrency->geoplugin_currencySymbol_UTF8.number_format($total,2)." ".$countryCurrency->geoplugin_currencyCode;
        }
        if ($countryCurrency->geoplugin_countryCode == 'AU'){
            return $countryCurrency->geoplugin_currencySymbol_UTF8.number_format($total,2)." ".$countryCurrency->geoplugin_currencyCode;
        }
          if ($countryCurrency->geoplugin_countryCode == 'BR'){
            //  print_r($countryCurrency);
            return $countryCurrency->geoplugin_currencySymbol_UTF8.number_format($total,2)." ".$countryCurrency->geoplugin_currencyCode;
        }
    
          if (  $countryCurrency->geoplugin_countryCode == 'ES'){
            // return $countryCurrency->geoplugin_currencySymbol_UTF8.number_format($total,2);
            
                        $a = number_format($total,2)."$countryCurrency->geoplugin_currencySymbol_UTF8";
          $currency = ['$', 'kr', ''];
           $replace = "€";


                         $b = str_replace($currency, $replace, $a);
                        


                 return $b;

        }
         if ( $countryCurrency->geoplugin_countryCode == 'AR'){
            // return $countryCurrency->geoplugin_currencySymbol_UTF8.number_format($total,2);
            
                        $a = "$countryCurrency->geoplugin_currencySymbol_UTF8".number_format($total,2);
          $currency = ['$'];
           $replace = "$";


                         $b = str_replace($currency, $replace, $a);
                        


                 return $b;

        }
           
        return $countryCurrency->geoplugin_currencySymbol_UTF8.number_format($total,2);
    }
    if (empty($amount)) {
            return   "";
        }
    return "$".number_format($amount,2);
}

function calculateCurrencyAmountWithOurCountryCurrency($countryCurrency,$countryCurrencyRate,$amount){
    if (!empty($countryCurrency) && !empty($countryCurrencyRate)){
        $total = $countryCurrencyRate * $amount;

        return number_format($total,2);
    }
    return number_format($amount,2);
}

function calculateCurrencyAmountWithOurCountryCurrencyUnformatted($countryCurrency,$countryCurrencyRate,$amount){
    if (!empty($countryCurrency) && !empty($countryCurrencyRate)){
        $total = $countryCurrencyRate * $amount;

        return $total;
    }
    return $amount;
}

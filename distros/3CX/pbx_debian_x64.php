<?php
/*

*/

$url = "https://www.3cx.com/downloads/3cxpbxiso/debian-3cx.iso";

$ch = curl_init(); //initialise the curl handle
//COOKIESESSION is optional, use if you want to keep cookies in memory
curl_setopt($ch, CURLOPT_COOKIESESSION, true);

curl_setopt($ch, CURLOPT_URL, $url); //specify your URL
curl_setopt($ch, CURLOPT_HEADER, true); //include headers in http data
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, false); //don't follow redirects
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$http_data = curl_exec($ch); //hit the $url
$curl_info = curl_getinfo($ch);
$headers = substr($http_data, 0, $curl_info["header_size"]); //split out header

preg_match("!\r\n(?:Location|URI): *(.*?) *\r\n!", $headers, $matches);
$realurl = $matches[1];
$realurl_http = str_replace("https://", "http://", $realurl);
//$realurl = curl_getinfo($ch, CURLINFO_EFFECTIVE_URL);
//print($response);
curl_close($ch);
//echo $realurl;
header( 'Location: ' . $realurl_http  ) ;
?>
<?php

define('CLIENT_ID', 'f2cdeb8b697146488446cd98f4e9eb83'); // Client_ID aplikacji
define('CLIENT_SECRET', '7mv07UuQfjElQtv9tdLVKMZuWVLlr7ZJTgWSnSiJyUPXtYXbhzYbPYgQ25dnZfNv'); // Client_Secret aplikacji


function getCurl($headers, $url, $content = null) {
	$ch = curl_init();
	curl_setopt_array($ch, array(
		CURLOPT_URL => $url,
		CURLOPT_HTTPHEADER => $headers,
		CURLOPT_SSL_VERIFYPEER => false,
		CURLOPT_RETURNTRANSFER => true
    ));
    if ($content !== null) {
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $content);
    }
	return $ch;
}

function getCategoryByID($token) {
    $headers = array("Authorization: Bearer {$token}",
     "Accept: application/vnd.allegro.public.v1+json");
    $url = "https://api.allegro.pl/sale/categories/709";
    $ch = getCurl($headers, $url);
    $mainCategoriesResult = curl_exec($ch);
    $resultCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);
    if ($mainCategoriesResult === false || $resultCode !== 200) {
        exit ("Something went wrong");
    }
    $categoriesList = json_decode($mainCategoriesResult);
    return $categoriesList;
}

function getAccessToken() {
	$authorization = base64_encode(CLIENT_ID.':'.CLIENT_SECRET);
	$headers = array("Authorization: Basic {$authorization}","Content-Type: application/x-www-form-urlencoded");
	$content = "grant_type=client_credentials";
    $url = "https://allegro.pl/auth/oauth/token";
	$ch = getCurl($headers, $url, $content);
	$tokenResult = curl_exec($ch);
    $resultCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
	curl_close($ch);
    if ($tokenResult === false || $resultCode !== 200) {
        exit ("Something went wrong");
    }
	return json_decode($tokenResult)->access_token;
}

function main()
{
    $token = getAccessToken();
    $main_categories = getCategoryByID($token);
    var_dump($main_categories);

   
}

main();

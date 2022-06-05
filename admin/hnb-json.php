<?php

$curl = curl_init();

curl_setopt_array($curl, [
	CURLOPT_URL => "https://accuweatherstefan-skliarovv1.p.rapidapi.com/get24HoursConditionsByLocationKey",
	CURLOPT_RETURNTRANSFER => true,
	CURLOPT_FOLLOWLOCATION => true,
	CURLOPT_ENCODING => "",
	CURLOPT_MAXREDIRS => 10,
	CURLOPT_TIMEOUT => 30,
	CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
	CURLOPT_CUSTOMREQUEST => "POST",
	CURLOPT_POSTFIELDS => "apiKey=%3CREQUIRED%3E&locationKey=%3CREQUIRED%3E",
	CURLOPT_HTTPHEADER => [
		"X-RapidAPI-Host: AccuWeatherstefan-skliarovV1.p.rapidapi.com",
		"X-RapidAPI-Key: ab9d37519amshaf445bcfbcee4c9p1a8792jsneacde33843af",
		"content-type: application/x-www-form-urlencoded"
	],
]);

$response = curl_exec($curl);
$err = curl_error($curl);

curl_close($curl);

if ($err) {
	echo "cURL Error #:" . $err;
} else {
	echo $response;
}


	
?>

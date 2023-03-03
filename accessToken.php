<?php
	require_once realpath(__DIR__ . "/vendor/autoload.php");
    use Dotenv\Dotenv;


    $dotenv=Dotenv::createUnsafeImmutable(__DIR__);
    $dotenv->load();
    $consumerKey=$_ENV["CONSUMERKEY"];
    $consumerSecret=$_ENV["CONSUMERSECRET"];


	$headers = ['Content-Type:application/json; charset=utf8'];

	$url = 'https://api.safaricom.co.ke/oauth/v1/generate?grant_type=client_credentials';

	$curl = curl_init($url);
	curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
	curl_setopt($curl, CURLOPT_RETURNTRANSFER, TRUE);
	curl_setopt($curl, CURLOPT_HEADER, FALSE);
	curl_setopt($curl, CURLOPT_USERPWD, $consumerKey.':'.$consumerSecret);
	$result = curl_exec($curl);
	print_r("Results:".$result);
	$status = curl_getinfo($curl, CURLINFO_HTTP_CODE);
	$result = json_decode($result);

	$access_token = $result->access_token;

	echo $access_token;
	
	curl_close($curl);









<?php
    require_once realpath(__DIR__ . "/vendor/autoload.php");
    use Dotenv\Dotenv;


    $dotenv=Dotenv::createUnsafeImmutable(__DIR__);
    $dotenv->load();
    $accessToken=$_ENV["ACCESSTOKEN"];
    $shortCode=$_ENV["SHORTCODE"];
    $confirmationUrl=$_ENV["CONFIRMATIONURL"];
    $validationUrl=$_ENV["VALIDATIONURL"];
	$data=json_encode(
		[
			"ShortCode"=>$shortCode,
			"ResponseType"=>"Completed",
			"ConfirmationURL"=>$confirmationUrl,
			"ValidationURL"=>$validationUrl
		]);
	
	$ch = curl_init('https://sandbox.safaricom.co.ke/mpesa/c2b/v1/registerurl');
	curl_setopt($ch, CURLOPT_HTTPHEADER, [
		'Authorization: Bearer '.$accessToken,
		'Content-Type: application/json'
	]);
	curl_setopt($ch, CURLOPT_POST, 1);
	curl_setopt($ch, CURLOPT_POSTFIELDS,$data);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	$response     = curl_exec($ch);
	curl_close($ch);
	echo $response;
<?php
include_once('vendor/autoload.php');
include('constants.php');

use Firebase\JWT\JWT;

header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET');
header('Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, X-Requested-With');
header('Content-Type: application/json');

// Step 1. Generate SQL parameters
$jwt = $_GET['jwt'];

// Step 2. Retrive username from JWT
try {
    $raw_jwt = json_decode($jwt);
    echo (JWT::decode($jwt, $jwt_secret, array('HS256'))->username);
} catch (Exception $e) {
	print_r($e);
}


?>

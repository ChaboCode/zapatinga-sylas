<?php
include_once('vendor/autoload.php');
include_once('constants.php');
include_once('validateToken.php');

use Firebase\JWT\JWT;

header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, X-Requested-With');
header('Content-Type: application/json');

// Step 1. Generate SQL parameters
$jwt = json_decode($_POST['jwt']);
$item_id = $_POST['item_id'];

// Step 2. Validate JWT
$decoded_jwt = is
if($decoded_jwt = isValidJWT($jwt)) {
    die('Invalid JWT');
}

// Step 2. Connect to database
$con = new mysqli($servername, $username, $password, $db);

if ($con->connect_error) {
    echo $con->connect_error;
}

// Step 3. Query
$sql = "INSERT INTO cart ( VALUES";

?>

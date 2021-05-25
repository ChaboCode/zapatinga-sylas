<?php
include_once('vendor/autoload.php');
include('constants.php');

use Firebase\JWT\JWT;

header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET');
header('Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, X-Requested-With');
header('Content-Type: application/json');

// Step 1. Generate SQL parameters
$req_username = $_GET['username'];
$req_password = $_GET['password'];

// Step 2. Connect to database
$con = new mysqli($servername, $username, $password, $db);

if ($con->connect_error) {
	echo $con->connect_error;
}

// Step 3. Query
$sql = "SELECT * FROM users WHERE user_name = '$req_username' AND password = '$req_password'";
$result = $con->query($sql);

if ($result) {
    $token = array(
        'username' => $req_username,
	'exp' => time()+3600,
    );

    try {
        $jwt = JWT::encode($token, $jwt_secret);
	echo json_encode($jwt);
    } catch (UnexceptedValueException $e) {
        echo $e->getMessage();
    }
}

?>

<?php
include_once('vendor/autoload.php');
include('constants.php');

use Firebase\JWT\JWT;

header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET');
header('Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, X-Requested-With');
header('Content-Type: application/json');

// Step 1: Generate SQL parameters
$jwt = $_GET['jwt'];

// Step 2. Retrieve username from JWT
try {
    $sql_username = (JWT::decode($jwt, $jwt_secret, array('HS256'))->username);
} catch (Exception $e) {
	die($e);
}

// Step 3. Connect to databse
$con = new mysqli($servername, $username, $password, $db);

if ($con->connect_error) {
	echo $con->connect_error;
}

// Step 4. Fancy SQL subquery shit for getting 
// the cart items from the username
$sql = "SELECT entry_id, zapato_id, count, zapatos.model, zapatos.image, zapatos.price FROM cart JOIN zapatos ON zapato_id = zapatos.id WHERE user_id = (SELECT user_id FROM users WHERE user_name LIKE '%".$sql_username."%')";
$result = $con->query($sql);

if ($result == false) {
    die($con->error);
}

$data = array();
while ($row = $result->fetch_assoc()) {
    array_push($data, $row);
}

echo json_encode($data);

$con->close();

?>

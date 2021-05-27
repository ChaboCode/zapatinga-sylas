<?php
include_once "vendor/autoload.php";
include "constants.php";

use Firebase\JWT\JWT;

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST, OPTIONS");
header(
    "Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, X-Requested-With"
);
header("Content-Type: application/json");

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Step 1: Generate SQL parameters
    $jwt = $_GET["jwt"];

    // Step 2. Retrieve username from JWT
    try {
        $sql_username = JWT::decode($jwt, $jwt_secret, ["HS256"])->username;
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
    $sql = "DELETE FROM cart WHERE user_id = (SELECT user_id from users WHERE user_name LIKE '%$sql_username%')"
    $result = $con->query($sql);

    if ($result == false) {
        die($con->error);
    }

    $con->close();
}

?>

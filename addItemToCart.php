<?php
include_once "vendor/autoload.php";
include_once "constants.php";
include_once "validateToken.php";

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods", "POST, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type");
header("Access-Control-Allow-Credentials", "true");
header("Content-Type: application/json");

use Firebase\JWT\JWT;

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    
    // Step 1. Generate SQL parameters
    $jwt = $_REQUEST["jwt"];
    $zapato_id = $_REQUEST["zapato_id"];

    // Step 2. Validate JWT
    if (!isValidJWT($jwt)) {
        die("Invalid JWT");
    }

    // Step 3. Retrive username from JWT
    try {
        $sql_username = JWT::decode($jwt, $jwt_secret, ["HS256"])->username;
    } catch (Exception $e) {
        print_r($e);
    }

    // Step 4. Connect to database
    $con = new mysqli($servername, $username, $password, $db);

    if ($con->connect_error) {
        echo $con->connect_error;
    }

    // Step 5. Query
    $sql =
        "INSERT INTO cart (user_id, zapato_id, count) VALUES((SELECT user_id FROM users WHERE user_name LIKE '%" .
        $sql_username .
        "%'), (SELECT id FROM zapatos WHERE id = " .
        $zapato_id .
        "), 1)";
    $result = $con->query($sql);
    if ($result == false) {
        die($con->error);
    }

    $con->close();
}
?>

<?php
include('constants.php');

header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET');
header('Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, X-Requested-With');
header('Content-Type: application/json');

// Step 1. Generate SQL parameters
$zapato_id = $_GET['zapato_id'];

// Step 2. Connect to database
$con = new mysqli($servername, $username, $password, $db);

if ($con->connect_error) {
    echo $con->connect_error;
}

// Setp 3. Query
$sql = "SELECT id, image, price, model, seasons.season_name AS season FROM zapatos INNER JOIN seasons ON season = seasons.season_id WHERE id = ".$zapato_id;
$result = $con->query($sql);

if (!$result) {
   die($con->error);
}

// Step 4. Generate and return results
// Since only one row is returned, it can be directly echoed
echo json_encode($result->fetch_assoc());

$con->close();
?>

<?php
include('constants.php');

header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET');
header('Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, X-Requested-With');
header('Content-Type: application/json');

/// Step 1. Generate SQL parameters
$season_id = $_GET['season_id'];

// Step 2. Connect to database
$con = new mysqli($servername, $username, $password, $db);

if ($con->connect_error) {
    echo $con->connect_error;
}

// Step 3. Query
$sql = "SELECT season_name FROM seasons WHERE season_id = ".$season_id;
$result = $con->query($sql);

// Step 4. Generate and return results
// Since only one row is returned, it can be directly echoed
echo json_encode($result->fetch_assoc());

$con->close();


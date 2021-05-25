<?php
include('constants.php');

header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET');
header('Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, X-Requested-With');
header('Content-Type: application/json');

// Step 1: Generate SQL parameters
$search_param = $_GET['search'];
error_log($search_param);

// Step 2. COnnect to daatabase
$con = new mysqli($servername, $username, $password, $db);

if ($con->connect_error) {
    echo $con->connect_error;
}

// Step 3. Query
$sql = "SELECT id, image, model, price FROM zapatos WHERE model LIKE \"%$search_param%\" LIMIT 30";
$result = $con->query($sql);

// Step 4. Generate and return result
$data = [];
while ($row = $result->fetch_assoc()) {
    array_push($data, $row);
}
echo json_encode($data);

$con->close();

?>
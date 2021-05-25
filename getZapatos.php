<?php
include('constants.php');

header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET');
header('Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, X-Requested-With');
header('Content-Type: application/json');

// Step 1: Generate SQL parameters
$order = $_GET['order'];
$select = $_GET['select'];

switch($order) {
	case 'recent':
		$sql_order = 'publish_date DESC';
		break;
	case 'name':
		$sql_order = 'model DESC';
		break;
	default:
		$sql_order = 'publish_date DESC';
		break;
}

switch($select) {
	case 'name':
		$sql_select = 'model';
		break;
	case 'name-img':
		$sql_select = 'model, image';
		break;
	default: 
		$sql_select = '*';
		break;
}

// Step 2. Connect to database
$con = new mysqli($servername, $username, $password, $db);

if ($con->connect_error) {
	echo $con->connect_error;
}

// Step 3. Query
$sql = "SELECT $sql_select FROM zapatos ORDER BY $sql_order LIMIT 30";
$result = $con->query($sql);

// Step 4. Generate and return results
$data = [];
while($row = $result->fetch_assoc()) {
	array_push($data, $row);
}
echo json_encode($data);

$con->close();
?>

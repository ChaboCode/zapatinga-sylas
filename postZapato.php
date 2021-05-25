<?php
include('constants.php');

header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: PUT');
header('Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, X-Requested-With');

// Step 1. Generate SQL parameters
$model = $_POST['model'];
$season = $_POST['season'];
$price = $_POST['price'];
$image = $_POST['img'];

// Step 2. Connect to database
$con = new mysqli($servername, $username, $password, $db);

if ($con->connect_error) {
	echo $con->connect_error;
}

// Step 3. Query
$sql = "INSERT INTO zapatos(model, price, season, image, publish_date) VALUES('$model', '$price', '$season', '$image', DATE(NOW()))";
echo $sql;
if ($con->query($sql) === TRUE) {
    echo "Registro exitoso. <a href=\"./nuevoZapato.html\">A&ntilde;adir otro</a>";
} else {
    echo $con->error;
}

?>

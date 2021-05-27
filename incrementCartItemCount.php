<?php
include('constants.php');

header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, X-Requested-With');
header('Content-Type: application/json');

if($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Step 1. Generate SQL parameters
    $entry_id = $_POST['entry_id'];
    
    // Step 2. Connect to database
    $con = new mysqli($servername, $username, $password, $db);
    
    if ($con->connect_error) {
        echo $con->connect_error;
    }
    
    // Step 3. Query actual object
    $sql = "UPDATE cart SET count = count + 1 WHERE entry_id = ".$entry_id;
    $result = $con->query($sql);
    
    // Step 4. Return any errors
    if($err = $con->error) {
        echo $err;
        die();
    }

    $con->close();
}

?>

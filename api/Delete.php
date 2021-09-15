<?php

require_once("connect.php");

$requestMethod = $_SERVER["REQUEST_METHOD"];

if (isset($_GET['Wash_ID'])) {

    $W_ID = $_GET['Wash_ID'];
 
    $sql = "DELETE FROM washmachine WHERE Wash_ID=$W_ID";
    
    $result = mysqli_query($link, $sql);

    if ($result) {
        echo json_encode(['status' => 'ok','message' => 'Delete Data Complete']);
    } else {
        echo json_encode(['status' => 'error','message' => 'Error']);    
    }
}

?>

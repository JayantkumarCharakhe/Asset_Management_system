<?php
include 'connection.php';
$name = $_POST['name'];
$age = $_POST['age'];
$note = $_POST['note'];

$sql = "INSERT INTO `user_info`( `name`, `age`, `note`) 
	VALUES ('$name','$age','$note')";
if (mysqli_query($conn, $sql)) {
    echo json_encode(array("statusCode" => 200));
} else {
    echo json_encode(array("statusCode" => 201));
}
mysqli_close($conn);

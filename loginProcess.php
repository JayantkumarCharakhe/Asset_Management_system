<?php
session_start();
if (isset($_POST['save'])) {
    extract($_POST);
    include 'connection.php';
    $sql = mysqli_query($conn, "SELECT * FROM register where email='$email' and password='$password'");
    $row  = mysqli_fetch_array($sql);
    if (is_array($row)) {

        $_SESSION["email"] = $row['email'];
        $_SESSION["name"] = $row['name'];
       header("Location: ajax.dashboard.php");
    } else {
        echo "Invalid Email ID/Password";
    }
}
?>
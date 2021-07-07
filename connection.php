<?php

$conn = mysqli_connect("localhost", "root", "plus91", "dbasset");
if (!$conn) {
    die('Could not Connect My Sql:' . mysqli_connect_error());
}

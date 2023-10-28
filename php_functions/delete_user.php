<?php

include "conn.php";

if(isset($_GET['id'])){
    $usersId = $_GET['id'];

$del = "DELETE FROM users_info where usersId = '$usersId'";
if(mysqli_query($conn, $del)){ // delete query
    header("location: ../admin/manageUsers.php"); // redirects to all records page
    exit();	
}
else
{
    echo "Error deleting record"; // display error message if not delete
}
}
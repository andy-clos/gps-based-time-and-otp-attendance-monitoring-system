<?php

include "conn.php";

if(isset($_GET['id'])){
    $usersId = $_GET['id'];
    $leaveId = $_GET['lid'];


$del = "DELETE FROM leave_apply where usersId = '$usersId' AND leaveId = '$leaveId'";
if(mysqli_query($conn, $del)){ // delete query
    header("location: ../user/leaveInfo.php"); // redirects to all records page
    exit();	
}
else
{
    echo "Error deleting record"; // display error message if not delete
}
}
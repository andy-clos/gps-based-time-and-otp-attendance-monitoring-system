<?php

include "conn.php";

if(isset($_GET['id'])){
    $usersId = $_GET['id'];
    $attendanceId = $_GET['aid'];


$del = "DELETE FROM attendance where usersId = '$usersId' AND attendanceId = '$attendanceId'";
if(mysqli_query($conn, $del)){ // delete query
    header("location: ../admin/attendanceInfo.php"); // redirects to all records page
    exit();	
}
else
{
    echo "Error deleting record"; // display error message if not delete
}
}
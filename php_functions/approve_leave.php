<?php 

include "conn.php";

if(isset($_GET['id'])){
    $usersId = $_GET['id'];
    $leaveId = $_GET['lid'];

   $sql = "UPDATE leave_apply SET statusL = 'Approved' WHERE usersId = '$usersId' AND  leaveId = '$leaveId'";
   $result = mysqli_query($conn , $sql);
   if($result){
    header("location: ../admin/leaveInfo.php");
    exit();
   }

}
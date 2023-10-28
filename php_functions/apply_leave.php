<?php

include('conn.php');
session_start();
$email = $_SESSION['email'] ;
$queryUsersInfo = mysqli_query($conn,"SELECT * FROM users_info WHERE usersEmail = '".$email."'");
$getUserID = mysqli_fetch_array($queryUsersInfo, MYSQLI_ASSOC);  
$_SESSION['id'] = $getUserID['usersId'];
$usersId = $_SESSION['id'];

if(isset($_POST['submitLeave'])){
    $startDate = $_POST['startDate'];
    $endDate = $_POST['endDate'];
    $leaveType = $_POST['leavetype'];
    
    $applyleave = "INSERT INTO leave_apply(usersId, leaveType, startDate, endDate, statusL) VALUES ('$usersId', '$leaveType', '$startDate', '$endDate', 'Pending')"; 
    mysqli_query($conn, $applyleave);

    header("location: ../user/leaveInfo.php");
}
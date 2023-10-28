<?php
include('../php_functions/conn.php');
session_start();

if (isset($_POST["updateUser"])){
    $usersId = $_POST['usersId'];
    $name=$_POST['name'];
    $icNum=$_POST['icNum'];
    $dob=$_POST['dob'];
    $phoneNum=$_POST['phoneNum'];
    $email=$_POST['email'];
    $role=$_POST['role'];
    $department=$_POST['department'];
    $select= "select * from users_info where usersId='$usersId'";
    $sql = mysqli_query($conn,$select);
    $row = mysqli_fetch_assoc($sql);

       $update = "UPDATE users_info SET usersName='$name', usersICNUM='$icNum', usersDOB='$dob', usersPhoneNum='$phoneNum', usersEmail='$email', usersRole='$role', usersDepartment='$department' WHERE usersId='$usersId'";
       $sql2=mysqli_query($conn,$update);
if($sql2)
       { 
           /*Successful*/
           header("location: ../admin/manageUsers.php");
       }
       else
       {
           /*sorry your profile is not update*/
           header("location: ../admin/updateManageUser.php");
       }
    }
    else
    {
        /*sorry your id is not match*/
        header("location: ../admin/updateManageUser.php");
    }

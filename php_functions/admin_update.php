<?php
include('../php_functions/conn.php');
session_start();

if (isset($_POST["updateProfile"])){
    $adminId = $_SESSION['id'];
    $profilePic=$_FILES["profilePic"]["name"];
    $tempname=$_FILES["profilePic"]["tmp_name"];
    $folder = "../image/".$profilePic;
    $name=$_POST['name'];
    $icNum=$_POST['icNum'];
    $phoneNum=$_POST['phoneNum'];
    $email=$_POST['email'];
    $department=$_POST['department'];
    $select= "select * from admin_info where adminId='$adminId'";
    $sql = mysqli_query($conn,$select);
    $row = mysqli_fetch_assoc($sql);
    $res= $row['id'];
    if($res === $id)
    {
   
       $update = "UPDATE admin_info SET adminName='$name', adminICNum='$icNum', adminphoneNumber='$phoneNum', adminEmail='$email', adminDepartment='$department', profilePic='$profilePic' WHERE adminId='$adminId'";
       $sql2=mysqli_query($conn,$update);
       move_uploaded_file($tempname, $folder);

       if(empty($profilePic))
       {
           $filename = $row['profilePic'];
           $update = "UPDATE admin_info SET profilePic='$filename' WHERE adminId='$adminId'";
           $sql2=mysqli_query($conn,$update);
       }
       
       if($sql2)
       { 
           /*Successful*/
           header("location: ../admin/profileInfo.php");
       }
       else
       {
           /*sorry your profile is not update*/
           header("location: ../admin/updateProfile.php");
       }
    }
    else
    {
        /*sorry your id is not match*/
        header("location: ../admin/updateProfile.php");
    }
 }
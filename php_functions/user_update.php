<?php
include('conn.php');
session_start();

if (isset($_POST["updateProfile"])){
    $usersId = $_SESSION['id'];
    $profilePic=$_FILES["profilePic"]["name"];
    $tempname=$_FILES["profilePic"]["tmp_name"];
    $folder = "../image/".$profilePic;
    $name=$_POST['name'];
    $icNum=$_POST['icNum'];
    $dob=$_POST['dob'];
    $phoneNum=$_POST['phoneNum'];
    $email=$_POST['email'];
    $select= "select * from users_info where usersId='$usersId'";
    $sql = mysqli_query($conn,$select);
    $row = mysqli_fetch_assoc($sql);
    $res= $row['id'];
    if($res === $id)
    {
   
       $update = "UPDATE users_info SET usersName='$name', usersICNUM='$icNum', usersDOB='$dob', usersPhoneNum='$phoneNum', usersEmail='$email', profilePic='$profilePic' WHERE usersId='$usersId'";
       $sql2=mysqli_query($conn,$update);
       move_uploaded_file($tempname, $folder);

       if(empty($profilePic))
       {
           $filename = $row['profilePic'];
           $update = "UPDATE users_info SET profilePic='$filename' WHERE usersId='$usersId'";
           $sql2=mysqli_query($conn,$update);
       }
       
       if($sql2)
       { 
           /*Successful*/
           header("location: ../user/profileInfo.php");
       }
       else
       {
           /*sorry your profile is not update*/
           header("location: ../user/updateProfile.php");
       }
    }
    else
    {
        /*sorry your id is not match*/
        header("location: ../user/updateProfile.php");
    }
 }
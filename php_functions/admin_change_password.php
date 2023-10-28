<?php
include('../php_functions/conn.php');
session_start();
$adminId = $_SESSION["id"];/* userid of the admin */
$pwd = $_POST["currentPass"];
$newPass = $_POST["newPass"];
$verifyPass = $_POST["verifyPass"];

$result = mysqli_query($conn,"SELECT * FROM admin_info WHERE adminId = $adminId ");
$row = mysqli_fetch_assoc($result);
$dbpwd = $row["adminPassword"];
$checkPwd = password_verify($pwd, $dbpwd);


if($checkPwd === true && $newPass === $verifyPass ) {
    $hashedPwd = password_hash($newPass, PASSWORD_DEFAULT);

$update = "UPDATE admin_info SET adminPassword = '$hashedPwd' WHERE adminId = '$adminId' ";
$sql2 = mysqli_query($conn, $update);

if($sql2){
    header("location: ../admin/updatePassword.php?success");
    exit();
    } else {
        header("location: ../admin/updatePassword.php?error=error");
        exit();
    }
} else{
    header("location: ../admin/updatePassword.php?error=wrongpassword");
        exit();
}
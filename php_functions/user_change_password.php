<?php
include('../php_functions/conn.php');
session_start();
$usersId = $_SESSION["id"];/* userid of the user */
$pwd = $_POST["currentPass"];
$newPass = $_POST["newPass"];
$verifyPass = $_POST["verifyPass"];

$result = mysqli_query($conn,"SELECT * FROM users_info WHERE usersId = $usersId ");
$row = mysqli_fetch_assoc($result);
$dbpwd = $row["usersPassword"];
$checkPwd = password_verify($pwd, $dbpwd);


if($checkPwd === true && $newPass === $verifyPass ) {
    $hashedPwd = password_hash($newPass, PASSWORD_DEFAULT);

$update = "UPDATE users_info SET usersPassword = '$hashedPwd' WHERE usersId = '$usersId' ";
$sql2 = mysqli_query($conn, $update);

if($sql2){
    header("location: ../user/updatePassword.php?success");
    exit();
    } else {
        header("location: ../user/updatePassword.php?error=error");
        exit();
    }
} else{
    header("location: ../user/updatePassword.php?error=wrongpassword");
        exit();
}


<?php

if(isset($_POST["registerAdmin"])){

    $profilePic = 'profile.jpg';
    $name = $_POST["name"];
    $icNum = $_POST["icNum"];
    $phoneNum = $_POST["phoneNum"];
    $email = $_POST["email"];
    $passwd = $_POST["passwd"];
    $department = $_POST["department"];

    require_once 'conn.php';
    require_once 'functions.php';

    if(adminemailExists($conn, $email) !== false){
        header("location: ../admin/addAdmins.php?error=emailtaken");
        exit();
    }

    addAdmin($conn, $name, $icNum, $phoneNum, $email, $passwd, $department, $profilePic);

}else {
    header("location: ../admin/addAdmins.php");
}
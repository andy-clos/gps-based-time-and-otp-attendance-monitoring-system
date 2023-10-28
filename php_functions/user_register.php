<?php

if(isset($_POST["registerUser"])){

    $profilePic = 'profile.jpg';
    $name = $_POST["name"];
    $icNum = $_POST["icNum"];
    $dob = $_POST["dob"];
    $phoneNum = $_POST["phoneNum"];
    $email = $_POST["email"];
    $passwd = $_POST["passwd"];
    $role = $_POST["role"];
    $department = $_POST["department"];

    require_once 'conn.php';
    require_once 'functions.php';

    if(emailExists($conn, $email) !== false){
        header("location: ../admin/addUsers.php?error=emailtaken");
        exit();
    }

    addUser($conn, $name, $icNum, $dob, $phoneNum, $email, $passwd, $role, $department, $profilePic);

}else {
    header("location: ../addUsers.php");
}
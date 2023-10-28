<?php

$host ="localhost";
$user ="root";
$pwd ="root";
$db_name ="attendancesystem";

$conn = mysqli_connect($host, $user, $pwd, $db_name);

if(!$conn){
    die("<script>alert('Connection Failed.')</script>");
}
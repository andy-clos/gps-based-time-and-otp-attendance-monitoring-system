<?php
if(isset($_POST['newPass']) && $_POST['token'] && $_POST['email'])
{
  include "conn.php";
  
  $email = $_POST['email'];

  $token = $_POST['token'];
  
  $password = password_hash($_POST['newPass'], PASSWORD_DEFAULT);

  $update = "UPDATE admin_info SET adminPassword = '$password', token = NULL, exp_date = NULL WHERE adminEmail = '$email' ";
  $sql2 = mysqli_query($conn, $update);

  

   if($sql2){

       header("location: ../admin/loginpage.php?error=pwdchanged");
       exit();
   }else{
      echo "<p>Something goes wrong. Please try again</p>";
   }
}
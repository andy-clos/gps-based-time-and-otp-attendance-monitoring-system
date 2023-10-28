<?php

include('conn.php');

    $email = $_POST['email'];  
    $password = $_POST['password'];  
      
        //to prevent from mysqli injection  
        $email = stripcslashes($email);  
        $password = stripcslashes($password);  
        $email = mysqli_real_escape_string($conn, $email);  
        $password = mysqli_real_escape_string($conn, $password);
      
        $sql = "select * from users_info where usersEmail = '$email'";  
        $result = mysqli_query($conn, $sql);  
        $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
        $pwdHashed = $row['usersPassword']; 
        $checkPwd = password_verify($password, $pwdHashed);   
          
        if($checkPwd === true){  
            session_start();
            $_SESSION["user"] = ["usersName"];
            $_SESSION["id"] = ["usersId"];
            $otp = rand(100000,999999);
                    $_SESSION['otp'] = $otp;
                    $_SESSION['email'] = $email;
                    require "PHPMailerAutoload.php";
                    require 'class.phpmailer.php';
                    require 'class.smtp.php';
                    $mail = new PHPMailer();
    
                    $mail->isSMTP();
                    $mail->Host='smtp.gmail.com';
                    $mail->Port=587;
                    $mail->SMTPSecure='tls';
                    $mail->SMTPDebug = 1;
                    $mail->SMTPAuth=true;
    
                    $mail->Username='ocaitsolutions@gmail.com';
                    $mail->Password='cbikcbziwajikpkt';
    
                    $mail->setFrom('ocaitsolutions@gmail.com', 'OTP Verification');
                    $mail->addAddress($_POST["email"]);
    
                    $mail->isHTML(true);
                    $mail->Subject="Your OTP for Login";
                    $mail->Body="<p>Dear user, </p> <h3>Your verify OTP code is $otp <br></h3>
                    <br><br>
                    <p>With regards,</p>
                    <b>OCA IT Solutions</b>";
                    $mail->send();
    
                            if(!$mail->send()){
                                ?>
                                    <script>
                                        alert("<?php echo "OTP Error"?>");
                                    </script>
                                <?php
                            }
            header("location: ../user/otp.php");
            exit();
        }  
        else{   
            header("location: ../user/loginpage.php?error=wronglogin");
            exit();
        }     
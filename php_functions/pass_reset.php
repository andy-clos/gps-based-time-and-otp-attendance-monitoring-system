<?php

if(isset($_POST['submit']) && $_POST['email']){
    include "conn.php";
    $email = $_POST['email'];
    $result = mysqli_query($conn, "SELECT * FROM users_info WHERE usersEmail ='$email'");
    $row = mysqli_num_rows($result);

    if($row = 1){
        $token = md5($email).rand(10,9999);
        $expFormat = mktime(date("H"), date("i"), date("s"), date("m") ,date("d")+1, date("Y"));
        $expDate = date("Y-m-d H:i:s",$expFormat);
        $update = mysqli_query($conn,"UPDATE users_info SET token='$token' ,exp_date='$expDate' WHERE usersEmail='$email'");
        $link = "<a href='localhost/user/reset-password.php?key=".$email."&token=".$token."'>Click To Reset password</a>"; 

        require "PHPMailerAutoload.php";
        require 'class.phpmailer.php';
        require 'class.smtp.php';

        $mail = new PHPMailer();

        $mail->isSMTP();
        $mail->Host='smtp.gmail.com';
        $mail->Port=587;
        $mail->SMTPSecure='tls';
        $mail->SMTPAuth=true;
    
        $mail->Username='ocaitsolutions@gmail.com';
        $mail->Password='cbikcbziwajikpkt';
    
        $mail->setFrom('ocaitsolutions@gmail.com', 'Reset Password');
        $mail->addAddress($_POST["email"]);
    
        $mail->isHTML(true);
        $mail->Subject="Reset Password";
        $mail->Body="<p>Dear user, </p> <h3>Please click on the following link to reset your password. <br></h3>
        $link
        <br><p>If you did not request this forgotten password email, no action is needed, your password will not be reset. </p>
        <br><br>
        <p>With regards,</p>
        <b>OCA IT Solutions</b>";
        $mail->send();
    
            if(!$mail->send()){
                ?>
                    <script>
                        alert("<?php echo "Error"?>");
                    </script>
                <?php
            }
        header("location: ../user/loginpage.php?error=none");
        exit();
    }else{
        header("location: ../user/loginpage.php?error=invalidemail");
        exit();
    }
    
}
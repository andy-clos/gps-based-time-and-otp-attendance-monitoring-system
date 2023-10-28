<!--
INTEGRATED PROJECT (DFT 50114) GPS BASED TIME AND OTP ATTENDANCE MONITORING SYSTEM

OTP PAGE - ADMIN (HTML)

BY  : ANDYCLOS A/L BOON MEE (01DDT20F1007)
      OOI YONG HERN (01DDT20F1042)
      CHIN LI XIN (01DDT20F1047)
-->
<?php session_start(); ?>
<!DOCTYPE html>

<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>OTP Verification</title>
    <link href="../css/otpStyles.css" rel="stylesheet" />
    <link rel="icon" href="../image/time.png"/>
    <script src="../js/datetime.js"></script>
</head>

<body onload="initClock()">
    <main>
        <div class="datetime">
            <div class="date">
                <span id="dayname">Day</span>,
                <span id="month">Month</span>
                <span id="daynum">00</span>,
                <span id="year">Year</span>
            </div>

            <div class="time">
                <span id="hour">00</span>:
                <span id="minutes">00</span>:
                <span id="seconds">00</span>
                <span id="period">AM</span>
            </div>
        </div>
        <form id="otp_form" class="form_class" action="#" method="POST">
            <div class="form_div">
                <h1>Enter OTP</h1>
                <p>Check your email for the OTP</p>
                <input class="field_class" type="text" maxlength="6" id = "otp" name = "otp_code" placeholder="6-digit code" required>
                <div class="button">
                    <button id="verify" class="submit_button" type="submit" name = "submit_otp" form="otp_form">Verify</button>
                    <?php 
                            include('../php_functions/conn.php');
                             if(isset($_POST["submit_otp"])){
                                $otp = $_SESSION['otp'];
                                $email = $_SESSION['email'];
                                $otp_code = $_POST['otp_code'];

                             if($otp != $otp_code){
                         ?>
                            <script>alert("Invalid OTP code");</script>
                        <?php
                        }else{
                        ?>
                        <script>
                            window.location.replace("dashboard.php");
                        </script>
                        <?php
                        }}
                        ?>

                </div>
            </div>

        </form>
    </main>
</body>

</html>
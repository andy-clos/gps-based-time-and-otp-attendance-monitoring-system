<!--
INTEGRATED PROJECT (DFT 50114) GPS BASED TIME AND OTP ATTENDANCE MONITORING SYSTEM

LOGIN PAGE - ADMIN (HTML)

BY  : ANDYCLOS A/L BOON MEE (01DDT20F1007)
      OOI YONG HERN (01DDT20F1042)
      CHIN LI XIN (01DDT20F1047)
-->

<!DOCTYPE html>

<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Login</title>
    <link href="../css/LoginStyles.css" rel="stylesheet" />
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

        <form id="login_form" class="form_class" action="../php_functions/authentication_admin.php" method="POST">
            <img class="icon" src="../image/time.png" alt="clock icon" />
            <div class="form_div">
                <h1>GLock Attendance</h1>
                <hr>
                <label>Email:</label>
                <input class="field_class" type="email" name="email" placeholder="Enter your registered email" required>
                <label>Password:</label>
                <input class="field_class" type="password" name="password" placeholder="Enter your password" required>
                <div class="button">
                    <button id="login" class="submit_button" type="submit" form="login_form"
                        action="otp.php">Login</button>
                    <button id="fpss" class="submit_button" type="button" onclick="window.location.href = 'forgotPwd.php'">Forgot Password</button>
                </div>
                <?php
                    if (isset($_GET["error"])){
                        if($_GET["error"] == "wronglogin"){
                            echo "<script>alert('Invalid email or password!')</script>";
                        } elseif($_GET["error"] == "invalidemail"){
                            echo "<script>alert('Invalid email!')</script>";
                        } elseif($_GET["error"] == "none"){
                            echo "<script>alert('Check your email for link to reset password!')</script>";
                        } elseif($_GET["error"] == "pwdchanged"){
                            echo "<script>alert('Password Changed!')</script>";
                        }
                    }
                    ?>

            </div>
        </form>
    </main>
</body>

</html>
<!--
INTEGRATED PROJECT (DFT 50114) GPS BASED TIME AND OTP ATTENDANCE MONITORING SYSTEM

FORGOT PASSWORD - USER (HTML)

BY  : ANDYCLOS A/L BOON MEE (01DDT20F1007)
      OOI YONG HERN (01DDT20F1042)
      CHIN LI XIN (01DDT20F1047)
-->

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
        <title>Forgot Password</title>
        <link href="../css/LoginStyles.css" rel="stylesheet"/>
        <link rel="icon" href="../image/time.png"/>
    </head>

    <body>
        <main>
            <form id="forgotPwd_form" class="fPassform_class" action="../php_functions/pass_reset.php" method="POST">
                <div class="form_div">
                    <h1 class="rstPassH1">Reset Password</h1>
                    <label>Email:</label>
                    <input class="field_class" type="email" name = "email" placeholder="Enter your registered email" required>
                    <div class="button">
                        <button id="change" class="submit_button" type="submit" name="submit" form="forgotPwd_form">Change</button>
                        <button id="cancel" type="button" onclick="window.location.href = 'loginpage.php'">Cancel</button>
                    </div>
                </div>
            </form> 
        </main>
    </body>
</html>
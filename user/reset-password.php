<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
            integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
        <title>Forgot Password</title>
        <link href="../css/LoginStyles.css" rel="stylesheet"/>
        <link rel="stylesheet" href="../css/pwdMeterStyles.css" />
        <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" />
        <link rel="icon" href="../image/time.png"/>
    </head>

    <body>
        <main>
            <form id="forgotPwd_form" class="fPassform_class" action="../php_functions/update_forgot_pwd.php" method="POST">
                <div class="form_div">
                <?php
                    if($_GET['key'] && $_GET['token'])
                    {
                    include "../php_functions/conn.php";
                    
                    $email = $_GET['key'];

                    $token = $_GET['token'];

                    $query = mysqli_query($conn,
                    "SELECT * FROM users_info WHERE token='$token' and usersEmail='$email';"
                    );

                    $curDate = date("Y-m-d H:i:s");


                    if (mysqli_num_rows($query) > 0) {

                    $row= mysqli_fetch_array($query);

                    if($row['exp_date'] >= $curDate){ ?>
                    <h1 class="rstPassH1">Reset Password</h1>
                    <input type="hidden" name="email" value="<?php echo $email;?>">
                    <input type="hidden" name="token" value="<?php echo $token;?>">
                    <div class="pw-meter">
                        <label class="mt-4">New Password:
                            <div class="tooltips">
                                <button type="button" class="btn btn-info ml-4" data-bs-toggle="tooltip"
                                    data-bs-placement="right"
                                    title="Password length minimum 10 characters and include at least one upper case letter, one lower case letter, one number, and one special character."
                                    style="font-size: 15px"><i class="fal fa-lightbulb-on"></i> Tips</button>
                            </div>
                        </label>
                        <input class="field_class" id="newPass" type="password" name="newPass" minlength="10"
                            placeholder="Enter your new password" required>
                        <div class="pw-strength mt-1 mb-4" style="background-color: #cac4c4;">
                            <span>Weak</span>
                            <span></span>
                        </div>
                    </div>
                    <label class="mt-3">Re-Type New Password:</label>
                    <input class="field_class mb-3" id="verifyPass" type="password" name="verifyPass" minlength="10"
                        placeholder="Confirm your new password" required>
                    <div id='password_confirmation_invalid' style="color: red;"></div>
                    <div class="button">
                        <button id="changePass" class="submit_button" type="submit" name="new-password"
                            form="forgotPwd_form" disabled>Change</button>
                        <button id="cancel" type="button" onclick="window.location.href = 'loginpage.php'">Cancel</button>
                    </div>
                    <?php } } else{
                    echo "<p>This forget password link has expired</p>";
              }
            }
            ?>
                </div>
            </form> 
        </main>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
        <script src="../js/pwdMeter.js"></script>
        <script>
            var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
            var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
                return new bootstrap.Tooltip(tooltipTriggerEl)
            })
        </script>
    </body>
</html>
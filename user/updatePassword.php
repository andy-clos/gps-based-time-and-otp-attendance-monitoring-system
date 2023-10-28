<!--
INTEGRATED PROJECT (DFT 50114) GPS BASED TIME AND OTP ATTENDANCE MONITORING SYSTEM

CHANGE PASSWORD PAGE - USER (HTML)

BY  : ANDYCLOS A/L BOON MEE (01DDT20F1007)
      OOI YONG HERN (01DDT20F1042)
      CHIN LI XIN (01DDT20F1047)
-->
<?php
session_start();
if($_SESSION['email']==FALSE){
    header("location: ../index.php");
    exit();
}
include('../php_functions/conn.php');
$email = $_SESSION['email'] ;
$queryUsersInfo = mysqli_query($conn,"SELECT * FROM users_info WHERE usersEmail = '".$email."'");
$getUserID = mysqli_fetch_array($queryUsersInfo, MYSQLI_ASSOC);  
$_SESSION['id'] = $getUserID['usersId'];
$usersId = $_SESSION['id'];
?>
<!DOCTYPE html>

<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/sidebarStyles.css" />
    <link rel="stylesheet" href="../css/profileStyles.css" />
    <link rel="stylesheet" href="../css/pwdMeterStyles.css" />
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" />
    <link rel="icon" href="../image/time.png"/>
    <script src="../js/datetime.js"></script>
    <title>Change Password</title>
</head>

<body onload="initClock()">
    <div class="main-container d-flex">
        <div class="sidebar" id="side_nav">
            <div class="header-box px-2 pt-3 pb-4 d-flex justify-content-between">
                <div class="datetime">
                    <div class="date text-white">
                        <span id="dayname">Day</span>,
                        <span id="month">Month</span>
                        <span id="daynum">00</span>,
                        <span id="year">Year</span>
                    </div>

                    <div class="time text-white">
                        <span id="hour">00</span>:
                        <span id="minutes">00</span>:
                        <span id="seconds">00</span>
                        <span id="period">AM</span>
                    </div>
                </div>
                <button class="btn d-md-none d-block close-btn px-1 py-0 text-white"><i
                        class="fal fa-stream"></i></button>
            </div>

            <hr class="h-color mx-2 mb-4">

            <ul class="list-unstyled px-2">
                <li class=" mb-4" style="font-size: 20px;"><a href="dashboard.php"
                        class="text-decoration-none px-3 py-2 d-block"><i
                            class="fal fa-home px-2 fa-2x"></i>Dashboard</a></li>
                <li class=" mb-4" style="font-size: 20px;"><a href="attendanceInfo.php"
                        class="text-decoration-none px-3 py-2 d-block"><i class="fal fa-clipboard-user px-2 fa-2x"></i>
                        Attendance</a></li>
                <li class=" mb-4" style="font-size: 20px;"><a href="leaveInfo.php"
                        class="text-decoration-none px-3 py-2 d-block"><i class="fal fa-paper-plane px-2 fa-2x"></i>
                        Leave</a></li>
                <li class="active mb-4" style="font-size: 20px;"><a href="profileInfo.php"
                        class="text-decoration-none px-3 py-2 d-block"><i class="fal fa-address-card px-2 fa-2x"></i>
                        Profile</a></li>

            </ul>

            <hr class="h-color mx-2">

            <ul class="list-unstyled px-2">
                <li class=" mb-4" style="font-size: 20px;"><a href="../php_functions/logout.php"
                        class="text-decoration-none px-3 py-2 d-block"><i class="fal fa-sign-out px-2 fa-2x"></i>
                        Logout</a></li>
            </ul>
        </div>

        <div class="content">
            <nav class="navbar navbar-expand-lg navbar-light mb-5">
                <div class="container-fluid">
                    <div class="d-flex justify-content-between  mb-3 mt-3">
                        <button class="btn px-1 py-0 open-btn d-md-none d-block me-2"><i
                                class="fal fa-stream"></i></button>
                        <div class="header"><a class="navbar-brand fs-2" href="dashboard.php" style="letter-spacing: 3px;"><span
                                    class="px-2 py-0 text-white">GLock Attendance</span></a></div>
                    </div>
                </div>
            </nav>
            <div class="container">
                <h2 class="fs-1 mb-5">CHANGE PASSWORD</h2>

                <form id="changePassword_form" class="form_class" method="POST" action="../php_functions/user_change_password.php"
                    style="background-color: white;">
                    <div class="input-group-lg mb-3">
                        <label class="mb-4">Current Password :</label>
                        <input type="password" name="currentPass" id="currentPass" class="form-control mb-4"
                            placeholder="Enter your current password" required>
                        
                        <div class="pw-meter">
                            <div class="form-element input-group-lg">
                                <label class="mb-4">New Password :
                                    <div class="tooltips mb-4">
                                        <button type="button" class="btn btn-info" data-bs-toggle="tooltip"
                                            data-bs-placement="right"
                                            title="Password length minimum 10 characters and include at least one upper case letter, one lower case letter, one number, and one special character."
                                            style="font-size: 15px"><i class="fal fa-lightbulb-on"></i> Tips</button>
                                    </div>
                                </label>

                                <input type="password" name="newPass" id="newPass" class="form-control mb-4"
                                    placeholder="Enter your new password" minlength="10" required>
                                <div class="pw-strength mb-4">
                                    <span>Weak</span>
                                    <span></span>
                                </div>
                            </div>
                        </div>
                        
                        <label class="mb-4">Re-Type New Password:</label>
                        <input type="password" name="verifyPass" id="verifyPass" class="form-control mb-4"
                            placeholder="Confirm your new password" minlength="10" required>
                        <div id='password_confirmation_invalid' style="color: red;"></div>

                            <?php
                            if (isset($_GET["error"])){
                                if($_GET["error"] == "wrongpassword"){
                                    echo "<script>alert('Password Incorrect or Password Not Matched!')</script>";
                                } else if($_GET["error"] == "error"){
                                    echo "<script>alert('Error, Try Again!')</script>";
                                } 
                            }
                            if (isset($_GET["success"])){
                                echo "<script>alert('Password Changed!')</script>";
                            }
                            ?>

                        <div class="button">
                            <button type="submit" name="changePass" id="changePass"
                                class="submit_button btn btn-primary" form="changePassword_form" disabled>CHANGE</button>
                            <button type="button" name="cancel" id="cancel" class="btn btn-danger" value="cancel" onclick="window.location.href='profileInfo.php'">CANCEL</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"
        integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js"
        integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous">
    </script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="../js/sidebar.js"></script>
    <script src="../js/pwdMeter.js"></script>
    <script>
        var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
        var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl)
        })
    </script>

</body>

</html>
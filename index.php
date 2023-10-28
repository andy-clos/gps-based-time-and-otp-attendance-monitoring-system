<!--
INTEGRATED PROJECT (DFT 50114) GPS BASED TIME AND OTP ATTENDANCE MONITORING SYSTEM

USER TYPE SELECTION PAGE (HTML)

BY  : ANDYCLOS A/L BOON MEE (01DDT20F1007)
      OOI YONG HERN (01DDT20F1042)
      CHIN LI XIN (01DDT20F1047)
-->

<!DOCTYPE html>

<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Online Attendance System</title>
    <link href="css/indexStyles.css" rel="stylesheet" />
    <link rel="icon" href="image/time.png"/>
</head>

<body>
    <main>
        <form class="chooseUser form_class">
            <img class="icon" src="image/user.png" alt="user icon"/>
            <div class="form_div">
                <h1>Which user type are you?</h1>
                <div class="button">
                    <button id="user" class="submit_button" type="button"
                        onclick="window.location.href = 'user/loginpage.php'">User</button>
                    <button id="admin" class="submit_button" type="button"
                        onclick="window.location.href = 'admin/loginpage.php'">Admin</button>
                </div>
            </div>
        </form>
    </main>
</body>

</html>
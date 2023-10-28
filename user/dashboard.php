<!--
INTEGRATED PROJECT (DFT 50114) GPS BASED TIME AND OTP ATTENDANCE MONITORING SYSTEM

DASHBOARD PAGE - USER (HTML)

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
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" />
    <link rel="icon" href="../image/time.png"/>
    <script src="../js/datetime.js"></script>
    <style>
        @media screen and (max-width: 800px) {
            table thead {
                border: none;
                clip: rect(0 0 0 0);
                height: 1px;
                margin: -1px;
                overflow: hidden;
                padding: 0;
                position: absolute;
                width: 1px;
            }

            table tr {
                border-bottom: 15px solid #ddd;
                display: block;
                margin-bottom: .625em;
            }

            table td {
                border-bottom: 1px solid #ddd;
                display: block;
                text-align: right;
            }

            table td::before {
                content: attr(data-label);
                float: left;
                font-weight: bold;
            }

            table td:last-child {
                border-bottom: 0;
            }
        }
    </style>
    <title>Dashboard</title>
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
                <li class="active mb-4" style="font-size: 20px;"><a href="dashboard.php"
                        class="text-decoration-none px-3 py-2 d-block"><i
                            class="fal fa-home px-2 fa-2x"></i>Dashboard</a></li>
                <li class=" mb-4" style="font-size: 20px;"><a href="attendanceInfo.php"
                        class="text-decoration-none px-3 py-2 d-block"><i class="fal fa-clipboard-user px-2 fa-2x"></i>
                        Attendance</a></li>
                <li class=" mb-4" style="font-size: 20px;"><a href="leaveInfo.php"
                        class="text-decoration-none px-3 py-2 d-block"><i class="fal fa-paper-plane px-2 fa-2x"></i>
                        Leave</a></li>
                <li class=" mb-4" style="font-size: 20px;"><a href="profileInfo.php"
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
                    <div class="d-flex justify-content-between mb-3 mt-3">
                        <button class="btn px-1 py-0 open-btn d-md-none d-block me-2"><i
                                class="fal fa-stream"></i></button>
                        <div class="header"><a class="navbar-brand fs-2" href="dashboard.php" style="letter-spacing: 3px;"><span
                                    class="px-2 py-0 text-white">GLock Attendance</span></a></div>
                    </div>
                </div>
            </nav>

            <div class="container">
                <h2 class="fs-1 mb-5">WELCOME BACK, <?php $username = mysqli_query($conn,"SELECT * FROM users_info WHERE usersEmail = '".$email."'");
                    $displayusername = mysqli_fetch_array($username, MYSQLI_ASSOC);  
                    echo $displayusername['usersName'];?> </h2>

                <!--<div class="card shadow mb-5" style="border-color: black; border-width: 2px;">
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item text-center" style="background-color: rgb(202, 196, 186);"><i
                                class="fal fa-calendar-alt fa-3x"></i><b class="fs-3"> CALENDAR</b> </li>
                        <div>
                            <iframe
                                src="https://calendar.google.com/calendar/embed?height=600&wkst=1&bgcolor=%23ffffff&ctz=Asia%2FKuala_Lumpur&title=.&showTitle=0&showPrint=0&showTabs=1&showTz=0&showNav=0&showCalendars=0&showDate=1&src=Y2hyeXN0aW5hY2hpbkBnbWFpbC5jb20&src=YWRkcmVzc2Jvb2sjY29udGFjdHNAZ3JvdXAudi5jYWxlbmRhci5nb29nbGUuY29t&src=Y2xhc3Nyb29tMTA3MzMyMDEzOTQ4MTg1MDA1NzIwQGdyb3VwLmNhbGVuZGFyLmdvb2dsZS5jb20&src=Y19jbGFzc3Jvb21iMTIwYzgzM0Bncm91cC5jYWxlbmRhci5nb29nbGUuY29t&src=Y19jbGFzc3Jvb21mODA0NWExZUBncm91cC5jYWxlbmRhci5nb29nbGUuY29t&src=Y19jbGFzc3Jvb21kNjE4ZDc3Y0Bncm91cC5jYWxlbmRhci5nb29nbGUuY29t&src=Y19jbGFzc3Jvb21lMGFkZTZhMUBncm91cC5jYWxlbmRhci5nb29nbGUuY29t&src=ZW4ubWFsYXlzaWEjaG9saWRheUBncm91cC52LmNhbGVuZGFyLmdvb2dsZS5jb20&src=Y2xhc3Nyb29tMTE3Mzg1NTkxMDM3MzgwNTgzNzc0QGdyb3VwLmNhbGVuZGFyLmdvb2dsZS5jb20&color=%23039BE5&color=%2333B679&color=%230047a8&color=%23007b83&color=%23202124&color=%23c26401&color=%230047a8&color=%23616161&color=%230047a8"
                                style="border-width:0" width="100%" height="600" frameborder="0"
                                scrolling="no"></iframe>
                        </div>
                    </ul>
                </div>-->

                <?php $displayallattendance = "SELECT * FROM attendance WHERE usersId = $usersId"; 
                      $allattendance = mysqli_query($conn, $displayallattendance);
                      $showattendance = mysqli_num_rows($allattendance);

                      $displayontimeattendance = "SELECT * FROM attendance WHERE usersId = $usersId AND statusA = 'ON-TIME'"; 
                      $ontimeattendance = mysqli_query($conn, $displayontimeattendance);
                      $showontimeattendance = mysqli_num_rows($ontimeattendance);

                      $displaylateattendance = "SELECT * FROM attendance WHERE usersId = $usersId AND statusA = 'LATE'"; 
                      $lateattendance = mysqli_query($conn, $displaylateattendance);
                      $showlateattendance = mysqli_num_rows($lateattendance);
                ?>

                <div class="card shadow mb-5" style="border-color: black; border-width: 2px;">
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item text-center" style="background-color: rgb(202, 196, 186);"><i
                                class="fal fa-clipboard-user fa-3x"></i><b class="fs-3"> ATTENDANCES</b> </li>
                        <li class="list-group-item">Total Attendances : <?php echo $showattendance;?></li>
                        <li class="list-group-item">On-Time : <?php echo $showontimeattendance;?></li>
                        <li class="list-group-item">Late : <?php echo $showlateattendance;?></li>
                        <li class="list-group-item text-center" style="background-color: rgb(202, 196, 186);">
                        <b>Recent Attendances</b></li>
                        <li class="list-group-item"><h2 class="fs-5">Previous Clocked In Location : </h2>
                        <div class="mapouter">
                                <?php $displaylocation = "SELECT * FROM attendance WHERE usersId = $usersId order by attendanceId DESC LIMIT 1";
                                        if($location = mysqli_query($conn, $displaylocation)){
                                            if(mysqli_num_rows($location)>0){
                                                $cl = mysqli_fetch_array($location, MYSQLI_ASSOC);
                                            } else {
                                                echo "No Previous Location";
                                            }
                                        } else {
                                            echo "Error". mysqli_error($conn);
                                        }
                                ?>
                                <div class="gmap_canvas"><iframe height="500" id="gmap_canvas"
                                        src="https://maps.google.com/maps?q=<?php echo $cl['location']; ?>&t=&z=12&ie=UTF8&iwloc=&output=embed"
                                        frameborder="0" scrolling="no" marginheight="0" marginwidth="0"></iframe><br>
                                    <style>
                                        .mapouter {
                                            position: relative;
                                            height: 100%;
                                            width: 100%;
                                        }
                                    </style>
                                    <style>
                                        .gmap_canvas {
                                            overflow: hidden;
                                            background: none !important;
                                            height: 100%;
                                            width: 100%;
                                        }
                                    </style>
                                    <style>
                                        iframe {
                                            width: 100%;
                                        }
                                    </style>
                                </div>
                        </div>
                        </li>
                        <table class="table table-hover" style="width: 100%; text-align:center;">
                            <thead>
                                <tr>
                                    <th scope="col">Date</th>
                                    <th scope="col">Time In</th>
                                    <th scope="col">Time Out</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">Location</th>
                                </tr>
                            </thead>
                            <tbody>
                                    <?php 
                                          $displayattendance = "SELECT * FROM attendance WHERE usersId = $usersId order by date DESC LIMIT 5";
                                          if($attendance = mysqli_query($conn, $displayattendance)){
                                            if(mysqli_num_rows($attendance)>0){
                                                while ($row = mysqli_fetch_array($attendance, MYSQLI_ASSOC)){
                                                    ?>
                                                    <?php echo "<tr>"; ?>
                                                    <td data-label="Date"><?php $date = strtotime($row['date']); echo date("d/m/Y", $date);?></td>
                                                    <td data-label="Time In"><?php $time = strtotime($row['timeIn']); echo date("h:i:s A", $time);?></td>
                                                    <td data-label="Time Out">
                                                        <?php 
                                                            if($row['timeOut'] == NULL)
                                                            {
                                                                echo "N/A";
                                                            }

                                                            else
                                                            {
                                                                $time = strtotime($row['timeOut']); 
                                                                echo date("h:i:s A", $time);
                                                            }
                                                
                                                        ?>
                                                    </td>
                                                    <td data-label="Status"
                                                        <?php 
                                                            if($row['statusA'] == "ON-TIME") 
                                                            {
                                                                ?> style="background-color: green; color: white;" <?php 
                                                            } 
                                                                ?> <?php 
                                                            if($row['statusA'] == "LATE") 
                                                            {
                                                                ?> style="background-color: red; color: white;" <?php 
                                                            } 
                                                                ?>>
                                                        <?php 
                                                            echo $row['statusA'];
                                                        ?>
                                                    </td>
                                                    <td data-label="Location"><?php echo $row['location'];?></td>
                                                    <?php echo "</tr>"; ?>
                                            <?php
                                                  } 
                                                }
                                            } else {
                                                echo "Error". mysqli_error($conn);
                                            }
                                            ?>
                            </tbody>
                        </table>
                        <li class="list-group-item text-center"><button type="button" class="btn btn-outline-secondary"
                                style="width: 100%;" onclick="window.location.href = 'attendanceInfo.php'">VIEW ALL</button></li>
                    </ul>
                </div>
            </div>
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

</body>

</html>
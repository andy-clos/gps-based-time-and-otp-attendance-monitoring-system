<!--
INTEGRATED PROJECT (DFT 50114) GPS BASED TIME AND OTP ATTENDANCE MONITORING SYSTEM

USER ATTENDANCE PAGE - USER (HTML)

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
$query = "SELECT * FROM attendance WHERE usersId = '".$usersId."'";
$result = mysqli_query($conn, $query);
?>
<!DOCTYPE html>

<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap5.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../css/sidebarStyles.css" />
    <link rel="stylesheet" href="../css/attendanceStyles.css" />
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
    <title>Attendance</title>
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
                <li class="active mb-4" style="font-size: 20px;"><a href="attendanceInfo.php"
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
                <h2 class="fs-1 mb-5">MY ATTENDANCE</h2>
                <form id="attendance_form" class="form_class" method="POST"
                    action="../php_functions/insertAttendance.php" style="background-color: white;">
                    <div class="input-group-lg mb-3">
                        <button type="button" class="location btn btn-outline-secondary mb-4" id="button">LOCATION :
                        </button>
                        <!--<div class="mapouter">
                            <div class="gmap_canvas"><iframe height="500" id="gmap_canvas"
                                    src="https://maps.google.com/maps?q=&t=&z=4&ie=UTF8&iwloc=&output=embed&ll=4.2105, 101.9758"
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
                        </div>-->
                        <input type="text" name="currentLocation" id="currentLocation"
                            class="currentLocation form-control mb-4" placeholder="Press the button to detect your location"
                            readonly required>
                        <label class="labelTime mb-4">Time :</label>
                        <input type="text" name="currentTime" id="currentTime" class="form-control mb-4" readonly required>
                        <label class="labelDate mb-4">Date :</label>
                        <input type="text" name="currentDate" id="currentDate" class="form-control mb-4"
                            readonly required>
                        <div class="button">
                            <button name="submitClockIn" type="submit" class="clockIn submit_button btn btn-secondary"
                                id="clockIn" form="attendance_form" disabled>Clock In</button>
                            <button name="submitClockOut" type="submit" class="clockOut submit_button btn btn-secondary"
                                id="clockOut" form="attendance_form">Clock Out</button>
                        </div>
                    </div>
                </form>

                <div class="card shadow mb-4 mt-4">
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item text-center"><b>YOUR ATTENDANCES LIST</b> </li>

                        <table id="table" class="table table-hover" style="width: 100%; text-align:center;">
                            <thead>
                                <tr>
                                    <th scope="col" style="text-align:center;">Date</th>
                                    <th scope="col" style="text-align:center;">Time In</th>
                                    <th scope="col" style="text-align:center;">Status</th>
                                    <th scope="col" style="text-align:center;">Time Out</th>
                                    <th scope="col" style="text-align:center;">Total Hours</th>
                                    <th scope="col" style="text-align:center;">Location</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    if (mysqli_num_rows($result) > 0) {
                                    while($data = mysqli_fetch_assoc($result)) {
                                    ?>
                                <tr>
                                    <td data-label="Date"><?php $date = strtotime($data['date']); echo date("d/m/Y", $date);?></td>
                                    <td data-label="Time In"><?php $time = strtotime($data['timeIn']); echo date("h:i:s A", $time);?></td>
                                    <td data-label="Status"
                                        <?php 
                                                if($data['statusA'] == "ON-TIME") 
                                                {
                                            ?> style="background-color: green; color: white;" <?php 
                                                } 
                                            ?> <?php 
                                                if($data['statusA'] == "LATE") 
                                                {
                                            ?> style="background-color: red; color: white;" <?php 
                                                } 
                                            ?>>
                                        <?php 
                                                    echo $data['statusA'];
                                                ?>
                                    </td>
                                    <td data-label="Time Out">
                                        <?php 
                                                if($data['timeOut'] == NULL)
                                                {
                                                    echo "N/A";
                                                }

                                                else
                                                {
                                                    $time = strtotime($data['timeOut']); 
                                                    echo date("h:i:s A", $time);
                                                }
                                                
                                            ?>
                                    </td>
                                    <td data-label="Total Hours">
                                        <?php 
                                                if($data['totalHours'] == NULL)
                                                {
                                                    echo "N/A";
                                                }

                                                else
                                                {
                                                    $totalHours = strtotime($data['totalHours']); 
                                                    $hours = date("H", $totalHours);
                                                    $mins = date("i", $totalHours);
                                                    $secs = date("s", $totalHours);

                                                    $new_totalHours = $hours." hrs ".$mins." mins ".$secs." secs ";

                                                    echo $new_totalHours;
                                                }
                                                
                                            ?>
                                    </td>
                                    <td data-label="Location"><?php echo $data['location'];?></td>
                                </tr>
                                <?php
                                    }}
                                    ?>
                            </tbody>
                        </table>
                    </ul>
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
    <script>
        <?php
        $getapikey = mysqli_query($conn, "SELECT * FROM api_key WHERE id = '1'");
        $apikey = mysqli_fetch_array($getapikey, MYSQLI_ASSOC);
        $api_key = $apikey['API_KEY']; ?>

        const button = document.querySelector(".location");

        button.addEventListener("click", () => {
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(onSuccess, onError);
            } else {
                alert("Your browser doesn't support location");
            }
        });

        function onSuccess(position) {
            let {
                latitude,
                longitude
            } = position.coords;
            fetch(`https://api.opencagedata.com/geocode/v1/json?q=${latitude}+${longitude}&key=<?php echo $api_key?>`)
                .then(response => response.json()).then(result => {
                    let currentLocation = result.results[0].components;
                    let {
                        city,
                        state,
                        country
                    } = currentLocation;
                    //document.write(`${city}, ${state}, ${country}`);
                    document.getElementById("currentLocation").value = `${city}, ${state}, ${country}`;
                }).catch(() => {
                    alert("Something went wrong");
                })
        }

        function onError(error) {
            if (error.code == 1) {
                alert("Please allow location access");
            } else if (error.code == 2) {
                alert("Location not available");
            } else {
                alert("Error");
            }
        }
    </script>
    <script src="../js/moment.js"></script>
    <script src="../js/moment-with-locales.js"></script>
    <script>
        var date = new Date();
        var currentTime = date.getHours() + ':' + date.getMinutes() + ':' + date.getSeconds();

        document.getElementById('currentTime').value = currentTime;
        document.getElementById('currentDate').value = moment().format('DD-MM-YYYY');
    </script>

    <script src="../js/clockInOut.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap5.min.js"></script>
    <script>
        $(document).ready(function () {
            $('#table').DataTable();
        });
    </script>

</body>

</html>
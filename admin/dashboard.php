<!--
INTEGRATED PROJECT (DFT 50114) GPS BASED TIME AND OTP ATTENDANCE MONITORING SYSTEM

DASHBOARD PAGE - ADMIN (HTML)

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
$email = $_SESSION['email'];
$queryUsersInfo = mysqli_query($conn,"SELECT * FROM admin_info WHERE adminEmail = '".$email."'");
$getUserID = mysqli_fetch_array($queryUsersInfo, MYSQLI_ASSOC);  
$_SESSION['id'] = $getUserID['adminId'];
$adminId = $_SESSION['id'];
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
                <li class="active mb-4"><a href="dashboard.php" class="text-decoration-none px-3 py-2 d-block"><i
                            class="fal fa-home px-2"></i>Dashboard</a></li>
                <li class=" mb-4"><a href="manageUsers.php" class="text-decoration-none px-3 py-2 d-block"><i
                            class="fal fa-user px-2"></i>Manage Users</a></li>
                <li class=" mb-4"><a href="manageAdmins.php" class="text-decoration-none px-3 py-2 d-block"><i
                            class="fal fa-user-cog px-2"></i>Manage Admins</a></li>
                <li class=" mb-4"><a href="attendanceInfo.php" class="text-decoration-none px-3 py-2 d-block"><i
                            class="fal fa-clipboard-user px-2"></i>
                        Attendance</a></li>
                <li class=" mb-4"><a href="leaveInfo.php" class="text-decoration-none px-3 py-2 d-block"><i
                            class="fal fa-paper-plane px-2"></i>
                        Leave</a></li>
                <li class=" mb-4"><a href="profileInfo.php" class="text-decoration-none px-3 py-2 d-block"><i
                            class="fal fa-address-card px-2"></i>
                        Profile</a></li>

            </ul>

            <hr class="h-color mx-2">

            <ul class="list-unstyled px-2">
                <li class=" mb-4"><a href="../php_functions/logout.php" class="text-decoration-none px-3 py-2 d-block"><i
                            class="fal fa-sign-out px-2"></i>
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
                <h2 class="fs-1 mb-5">WELCOME BACK, <?php $username = mysqli_query($conn,"SELECT * FROM admin_info WHERE adminEmail = '".$email."'");
                    $displayusername = mysqli_fetch_array($username, MYSQLI_ASSOC);  
                    echo $displayusername['adminName'];?></h2>

                <div class="card shadow mb-5" style="border-color: black; border-width: 2px;">
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item text-center" style="background-color: rgb(202, 196, 186);"><i
                                class="fal fa-user-cog fa-3x"></i><b class="fs-3"> REGISTERED ADMIN</b> </li>
                        <li class="list-group-item">Total : <?php $totaladmin = mysqli_query($conn,"SELECT * FROM admin_info");
                    $displaytotaladmin = mysqli_num_rows($totaladmin);  
                    echo $displaytotaladmin;?></li>
                        <li class="list-group-item text-center" style="background-color: rgb(202, 196, 186);">
                            <b>Recently Registered</b></li>
                        <table class="table table-hover" style="table-layout:fixed; text-align:center;">
                            <thead>
                                <tr>
                                    <th scope="col" style="width: 7%;">Admin ID</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Email</th>
                                    <th scope="col">Department</th>
                                </tr>
                            </thead>
                            <tbody>
                                        <?php 
                                          $displayadmin = "SELECT * FROM admin_info order by adminId DESC LIMIT 5";
                                          if($admin = mysqli_query($conn, $displayadmin)){
                                            if(mysqli_num_rows($admin)>0){
                                                while ($row = mysqli_fetch_array($admin, MYSQLI_ASSOC)){
                                                    ?>
                                                    <?php echo "<tr>"; ?>
                                                    <td data-label="Admin ID"><?php echo $row['adminId'];?></td>
                                                    <td data-label="Name"><?php echo $row['adminName'];?></td>
                                                    <td data-label="Email"><?php echo $row['adminEmail'];?></td>
                                                    <td data-label="Department"><?php echo $row['adminDepartment'];?></td>
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
                                style="width: 100%;" onclick="window.location.href = 'manageAdmins.php'">VIEW ALL</button></li>
                    </ul>
                </div>

                <div class="card shadow mb-5" style="border-color: black; border-width: 2px;">
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item text-center" style="background-color: rgb(202, 196, 186);"><i
                                class="fal fa-user fa-3x"></i><b class="fs-3"> REGISTERED USER</b> </li>
                        <li class="list-group-item">Total : <?php $totalusers = mysqli_query($conn,"SELECT * FROM users_info");
                    $displaytotalusers = mysqli_num_rows($totalusers);  
                    echo $displaytotalusers;?></li>
                        <li class="list-group-item text-center" style="background-color: rgb(202, 196, 186);">
                            <b>Recently Registered</b></li>
                        <table class="table table-hover" style="table-layout:fixed; text-align:center;">
                            <thead>
                                <tr>
                                    <th scope="col" style="width: 7%;">User ID</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Email</th>
                                    <th scope="col">Department</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php 
                                          $displayuser = "SELECT * FROM users_info order by usersId DESC LIMIT 5";
                                          if($user = mysqli_query($conn, $displayuser)){
                                            if(mysqli_num_rows($user)>0){
                                                while ($row = mysqli_fetch_array($user, MYSQLI_ASSOC)){
                                                    ?>
                                                    <?php echo "<tr>"; ?>
                                                    <td data-label="User ID"><?php echo $row['usersId'];?></td>
                                                    <td data-label="Name"><?php echo $row['usersName'];?></td>
                                                    <td data-label="Email"><?php echo $row['usersEmail'];?></td>
                                                    <td data-label="Department"><?php echo $row['usersDepartment'];?></td>
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
                                style="width: 100%;" onclick="window.location.href = 'manageUsers.php'">VIEW ALL</button></li>
                    </ul>
                </div>

                <?php $displayallattendance = "SELECT * FROM attendance "; 
                      $allattendance = mysqli_query($conn, $displayallattendance);
                      $showattendance = mysqli_num_rows($allattendance);

                      $displayontimeattendance = "SELECT * FROM attendance WHERE statusA = 'ON-TIME'"; 
                      $ontimeattendance = mysqli_query($conn, $displayontimeattendance);
                      $showontimeattendance = mysqli_num_rows($ontimeattendance);

                      $displaylateattendance = "SELECT * FROM attendance WHERE statusA = 'LATE'"; 
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
                        <table class="table table-hover" style="table-layout:fixed; text-align:center;">
                            <thead>
                                <tr>
                                    <th scope="col" style="width: 7%;">User ID</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Date</th>
                                    <th scope="col">Time In</th>
                                    <th scope="col">Time Out</th>
                                    <th scope="col">Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                    <?php 
                                          $displayattendance = "SELECT * FROM attendance, users_info WHERE attendance.usersId = users_info.usersId order by date DESC LIMIT 5";
                                          if($attendance = mysqli_query($conn, $displayattendance)){
                                            if(mysqli_num_rows($attendance)>0){
                                                while ($row = mysqli_fetch_array($attendance, MYSQLI_ASSOC)){
                                                    ?>
                                                    <?php echo "<tr>"; ?>
                                                    <td data-label="User ID"><?php echo $row['usersId'];?></td>
                                                    <td data-label="Name"><?php echo $row['usersName'];?></td>
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
                 
                <?php $leavepending = "SELECT * FROM leave_apply WHERE statusL = 'Pending'"; 
                      $pending = mysqli_query($conn, $leavepending);
                      $showpending = mysqli_num_rows($pending);

                      $leaveapproved = "SELECT * FROM leave_apply WHERE statusL = 'Approved'"; 
                      $approved = mysqli_query($conn, $leaveapproved);
                      $showapproved = mysqli_num_rows($approved);
                ?>

                <div class="card shadow mb-5" style="border-color: black; border-width: 2px;">
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item text-center" style="background-color: rgb(202, 196, 186);"><i
                                class="fal fa-paper-plane fa-3x"></i><b class="fs-3"> LEAVES</b> </li>
                        <li class="list-group-item">Approved : <?php echo $showapproved;?></li>
                        <li class="list-group-item">Pending : <?php echo $showpending;?></li>
                        <li class="list-group-item text-center" style="background-color: rgb(202, 196, 186);">
                            <b>Pending Leaves</b></li>
                        <table class="table table-hover" style="table-layout:fixed; text-align:center;">
                            <thead>
                                <tr>
                                    <th scope="col" style="width: 7%;">User ID</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Leave Type</th>
                                    <th scope="col">Start Date</th>
                                    <th scope="col">End Date</th>
                                    <th scope="col">Status</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php 
                                        $displaypendingleave = "SELECT * FROM leave_apply, users_info WHERE leave_apply.usersId = users_info.usersId AND statusL = 'Pending' order by startDate";
                                        if($displaypending = mysqli_query($conn, $displaypendingleave)){
                                            if(mysqli_num_rows($displaypending)>0){
                                                while ($pendingleave = mysqli_fetch_array($displaypending, MYSQLI_ASSOC)){
                                                    ?>
                                                    <?php echo "<tr>"; ?>
                                                    <td data-label="User ID"><?php echo $pendingleave['usersId'];?></td>
                                                    <td data-label="Name"><?php echo $pendingleave['usersName'];?></td>
                                                    <td data-label="Leave Type"><?php echo $pendingleave['leaveType'];?></td>
                                                    <td data-label="Start Date"><?php $date = strtotime($pendingleave['startDate']); echo date("d/m/Y", $date);?></td>
                                                    <td data-label="End Date"><?php $date = strtotime($pendingleave['endDate']); echo date("d/m/Y", $date);?></td>
                                                    <td data-label="Status" style="background-color: yellow;"><?php echo $pendingleave['statusL'];?></td>
                                                    <?php echo "</tr>"; ?>
                                            <?php
                                                  } 
                                                } 
                                            }else {
                                                echo "Error". mysqli_error($conn);
                                            }
                                            ?>
                            </tbody>
                        </table>

                        <li class="list-group-item text-center"><button type="button" class="btn btn-outline-secondary"
                                style="width: 100%;" onclick="window.location.href = 'leaveInfo.php'">VIEW ALL</button></li>
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
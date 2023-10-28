<!--
INTEGRATED PROJECT (DFT 50114) GPS BASED TIME AND OTP ATTENDANCE MONITORING SYSTEM

MANAGE ATTENDANCE PAGE - ADMIN (HTML)

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
/*$email = $_SESSION['email'];
$queryUsersInfo = mysqli_query($conn,"SELECT * FROM admin_info WHERE adminEmail = '".$email."'");
$getUserID = mysqli_fetch_array($queryUsersInfo, MYSQLI_ASSOC);  
$_SESSION['id'] = $getUserID['adminId'];
$adminId = $_SESSION['id'];*/
?>
<!DOCTYPE html>

<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap5.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../css/sidebarStyles.css" />
    <link rel="stylesheet" href="../css/manageUserStyles.css" />
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
                <li class=" mb-4"><a href="dashboard.php" class="text-decoration-none px-3 py-2 d-block"><i
                            class="fal fa-home px-2"></i>Dashboard</a></li>
                <li class=" mb-4"><a href="manageUsers.php" class="text-decoration-none px-3 py-2 d-block"><i
                            class="fal fa-user px-2"></i>Manage Users</a></li>
                <li class=" mb-4"><a href="manageAdmins.php" class="text-decoration-none px-3 py-2 d-block"><i
                            class="fal fa-user-cog px-2"></i>Manage Admins</a></li>
                <li class="active mb-4"><a href="attendanceInfo.php" class="text-decoration-none px-3 py-2 d-block"><i
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
                <li class=" mb-4"><a href="../php_functions/logout.php"
                        class="text-decoration-none px-3 py-2 d-block"><i class="fal fa-sign-out px-2"></i>
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
                <h2 class="fs-1 mb-5" style="display: flex; justify-content: space-between;">MANAGE ATTENDANCE
                <a href = "allAttendance.php" download="Attendance" class="btn btn-secondary"><i class="fal fa-file-alt"></i> Generate Report</a>
                </h2>

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
                            <b>Attendances List</b></li>
                        <table id="table" class="table table-hover" style="width: 100%; text-align:center;">
                            <thead>
                                <tr>
                                    <th scope="col" style="text-align:center;">Date</th>
                                    <th scope="col" style="text-align:center;">User ID</th>
                                    <!--<th scope="col">Attendance ID</th>-->
                                    <th scope="col" style="text-align:center;">Name</th>
                                    <th scope="col" style="text-align:center;">Time In</th>
                                    <th scope="col" style="text-align:center;">Status</th>
                                    <th scope="col" style="text-align:center;">Time Out</th>
                                    <th scope="col" style="text-align:center;">Total Hours</th>
                                    <th scope="col" style="text-align:center;">Location</th>
                                    <th scope="col" style="text-align:center;">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php 
                                          $displayattendance = "SELECT * FROM attendance, users_info WHERE attendance.usersId = users_info.usersId order by date DESC";
                                          if($attendance = mysqli_query($conn, $displayattendance)){
                                            if(mysqli_num_rows($attendance)>0){
                                                while ($row = mysqli_fetch_array($attendance, MYSQLI_ASSOC)){
                                                    ?>
                                                    <?php echo "<tr>"; ?>
                                                    <td data-label="Date"><?php $date = strtotime($row['date']); echo date("d/m/Y", $date);?></td>
                                                    <td data-label="User ID"><?php echo $row['usersId'];?></td>
                                                    <!--<td data-label="Attendance ID"><?php //echo $row['attendanceId'];?></td>-->
                                                    <td data-label="Name"><?php echo $row['usersName'];?></td>
                                                    <td data-label="Time In"><?php $time = strtotime($row['timeIn']); echo date("h:i:s A", $time);?></td>
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
                                                    <td data-label="Total Hours">
                                                        <?php 
                                                                if($row['totalHours'] == NULL)
                                                                {
                                                                    echo "N/A";
                                                                }

                                                                else
                                                                {
                                                                    echo $row['totalHours'];
                                                                }
                                                                
                                                        ?>
                                                    </td>
                                                    <td data-label="Location"><?php echo $row['location'];?></td>
                                                    <td data-label="Action">
                                                             <a href="../php_functions/delete_attendance.php?id=<?php echo $row['usersId']; ?>&aid=<?php echo $row['attendanceId']; ?>" class="btn btn-danger" onclick="return confirm('Are you sure to delete?') "><i class="fal fa-trash"></i>
                                            DELETE
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
        <script src="../js/popup.js"></script>
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
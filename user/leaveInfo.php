<!--
INTEGRATED PROJECT (DFT 50114) GPS BASED TIME AND OTP ATTENDANCE MONITORING SYSTEM

USER APPLY LEAVE PAGE - USER (HTML)

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
    <link href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap5.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../css/sidebarStyles.css" />
    <link rel="stylesheet" href="../css/leaveStyles.css" />
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
    <title>Leave</title>
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
                <li class="active mb-4" style="font-size: 20px;"><a href="leaveInfo.php"
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
                    <div class="d-flex justify-content-between  mb-3 mt-3">
                        <button class="btn px-1 py-0 open-btn d-md-none d-block me-2"><i
                                class="fal fa-stream"></i></button>
                        <div class="header"><a class="navbar-brand fs-2" href="dashboard.php" style="letter-spacing: 3px;"><span
                                    class="px-2 py-0 text-white">GLock Attendance</span></a></div>
                    </div>
                </div>
            </nav>
            <div class="container">
                <h2 class="fs-1 mb-5" style="display: flex; justify-content: space-between;">LEAVE APPLICATION</h2>
                <form id="leave_form" class="form_class" method="POST" action="../php_functions/apply_leave.php" style="background-color: white;">
                    <div class="input-group-lg mb-3">
                        <label class="labelSD mb-4">Start Date :</label>
                        <input type="date" name="startDate" id="startDate" class="startDate form-control mb-4" required>

                        <label class="labelED mb-4">End Date :</label>
                        <input type="date" name="endDate" id="endDate" class="endDate form-control mb-4" required>

                        <label class="labelLT mb-4">Leave Type :</label>
                        <select name="leavetype" class="leavetype form-select mb-4" id="leavetype inputGroupSelect01"
                            required>
                            <option selected>Choose...</option>
                            <option value="Emergency Leave">Emergency Leave</option>
                            <option value="Annual Leave">Annual Leave</option>
                            <option value="Maternity Leave">Maternity Leave</option>
                            <option value="Sick Leave">Sick Leave</option>
                            <option value="Others">Others</option>
                        </select>

                        <div class="button">
                            <button name="submitLeave" type="submit" class="submit_button btn btn-secondary"
                                id="submitLeave" form="leave_form">SUBMIT</button>
                        </div>
                    </div>
                </form>

                <div class="card shadow mb-4 mt-4">
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item text-center"><b>YOUR APPLIED LEAVES LIST</b> </li>

                        <table id="table" class="table table-hover" style="width: 100%; text-align:center;">
                            <thead>
                                <tr>
                                    <th scope="col" style="text-align:center;">Leave Type</th>
                                    <th scope="col" style="text-align:center;">Start Date</th>
                                    <th scope="col" style="text-align:center;">End Date</th>
                                    <th scope="col" style="text-align:center;">Total Days</th>
                                    <th scope="col" style="text-align:center;">Status</th> <!--Pending or Approved or Reject-->
                                    <th scope="col" style="text-align:center;">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php
                                    $query = "SELECT * FROM leave_apply WHERE usersId = '$usersId'";
                                    if($result = mysqli_query($conn, $query)){
                                      if(mysqli_num_rows($result)>0){
                                          while ($data = mysqli_fetch_array($result, MYSQLI_ASSOC)){
                                    ?>
                                <tr>
                                    <td data-label="Leave Type"><?php echo $data['leaveType'];?></td>
                                    <td data-label="Start Date"><?php $date = strtotime($data['startDate']); echo date("d/m/Y", $date);?></td>
                                    <td data-label="End Date"><?php $date = strtotime($data['endDate']); echo date("d/m/Y", $date);?></td>
                                    <td data-label="Total Days"><?php 
                                    $date1 = $data['startDate'];
                                    $date2 = $data['endDate'];
                                    $diff = strtotime($date2) - strtotime($date1);
                                    $dateDiff = abs(round($diff / 86400)) + 1;
                                    printf($dateDiff);?></td>
                                    <td data-label="Status"
                                        <?php 
                                            if($data['statusL'] == "Approved") 
                                            {
                                                ?> style="background-color: green; color: white;" <?php 
                                            } 
                                                ?> <?php 
                                            if($data['statusL'] == "Rejected") 
                                            {
                                                ?> style="background-color: red; color: white;" <?php 
                                            } 
                                                ?> <?php 
                                            if($data['statusL'] == "Pending") 
                                            {
                                                ?> style="background-color: yellow;" <?php 
                                            } 
                                                ?>>
                                        <?php 
                                            echo $data['statusL'];
                                        ?>
                                    </td>
                                    <td data-label="Action">
                                    <a href="../php_functions/delete_leave.php?id=<?php echo $data['usersId']; ?>&lid=<?php echo $data['leaveId']; ?>" class="btn btn-danger" onclick="return confirm('Are you sure to delete?') "><i class="fal fa-trash"></i>
                                            DELETE
                                    </td>
                                </tr>
                                <?php
                                    }}} else {
                                        echo "Error". mysqli_error($conn);
                                    }
                                    ?>
                            </tbody>
                        </table>
                    </ul>
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
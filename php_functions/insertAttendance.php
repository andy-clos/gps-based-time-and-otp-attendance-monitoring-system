<?php
    require "conn.php";
    
    session_start();

    $email = $_SESSION['email'];

    $queryUsersInfo = mysqli_query($conn,"SELECT * FROM users_info WHERE usersEmail = '".$email."'");
    
    $getUserID = mysqli_fetch_array($queryUsersInfo, MYSQLI_ASSOC);  

    $_SESSION['id'] = $getUserID['usersId'];
    
    $usersId = $_SESSION['id'];

    $query = "SELECT * FROM attendance";
    
    $result = mysqli_query($conn, $query);

    if(isset($_POST['submitClockIn'])) 
    
    {
        $currentLocation = $_POST['currentLocation'];
        
        $currentTimeIn = $_POST['currentTime'];
        
        $currentDate = $_POST['currentDate'];

        $onTime = strtotime("08:00:00");

        $statusTimeIn = strtotime($currentTimeIn);

        if ($statusTimeIn <= $onTime)
        {
            $status = "ON-TIME";
        }

        else
        {
            $status = "LATE";
        }

        $sql = "INSERT INTO attendance (usersId, date, timeIn, location, statusA) VALUES ('$usersId', '$currentDate','$currentTimeIn','$currentLocation','$status')";

        if (mysqli_query($conn, $sql)) 
        
        {
            echo "New record has been added successfully !";
        }
        
        else 
        
        {
            echo "Error: " . $sql . ":-" . mysqli_error($conn);
        }
        
        mysqli_close($conn);
    }

    if(isset($_POST['submitClockOut'])) 
    
    {
        $currentDate = $_POST['currentDate'];
        
        $currentTimeOut = $_POST['currentTime'];
        
        $newTimeOut = $currentDate." ".$currentTimeOut;

        if (mysqli_num_rows($result) > 0) 
        
        {  
            while($data = mysqli_fetch_assoc($result)) 
            {    
                $attendanceID = $data['attendanceId'];
                $currentTimeIn = $data['timeIn'];

                $newTimeIn = $currentDate." ".$currentTimeIn;
            }
        }
        
        $TimeIn = new DateTime($newTimeIn);

        $TimeOut = new DateTime($newTimeOut);

        $calculateHours = $TimeIn->diff($TimeOut);

        $diffHours = $calculateHours->format("%H:%I:%S");

        $sql = "UPDATE attendance SET timeOut = ('$currentTimeOut'), totalHours = ('$diffHours') WHERE date=('$currentDate') AND attendanceId=('$attendanceID')";

        if (mysqli_query($conn, $sql)) 

        {
            echo "New record has been added successfully !";
        }
        
        else 
        
        {
            echo "Error: " . $sql . ":-" . mysqli_error($conn);
        }
        
        mysqli_close($conn);
    }

    header("location: ../user/attendanceInfo.php");
?>
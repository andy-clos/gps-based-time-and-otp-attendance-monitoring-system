<?php 
function emailExists($conn, $email){
    $sql = " SELECT * FROM users_info WHERE usersEmail = ?";
    $stmt = mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare($stmt, $sql)){
        header("location: ../admin/addUsers.php?error=stmtfailed");
        exit();
    }

    mysqli_stmt_bind_param($stmt, "s", $email);
    mysqli_stmt_execute($stmt);

    $resultData = mysqli_stmt_get_result($stmt);

    if($row = mysqli_fetch_assoc($resultData)){
        return $row;
    }else{
        $result = false;
        return $result;
    }
    mysqli_stmt_close($stmt);
}

function addUser($conn, $name, $icNum, $dob, $phoneNum, $email, $passwd, $role, $department, $profilePic){
    $sql = " INSERT INTO users_info(usersName, usersICNUM, usersDOB, usersPhoneNum, usersEmail, usersPassword, usersRole, usersDepartment, profilePic) VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?) ";
    $stmt = mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare($stmt, $sql)){
        header("location: ../admin/addUsers.php?error=stmtfailed");
        exit();
    }

    $hashedPwd = password_hash($passwd, PASSWORD_DEFAULT);

    mysqli_stmt_bind_param($stmt, "sssssssss", $name, $icNum, $dob, $phoneNum, $email, $hashedPwd, $role, $department, $profilePic);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);

    header("location: ../admin/manageUsers.php");
    exit();
}

function adminemailExists($conn, $email){
    $sql = " SELECT * FROM admin_info WHERE adminEmail = ?";
    $stmt = mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare($stmt, $sql)){
        header("location: ../admin/addAdmins.php?error=stmtfailed");
        exit();
    }

    mysqli_stmt_bind_param($stmt, "s", $email);
    mysqli_stmt_execute($stmt);

    $resultData = mysqli_stmt_get_result($stmt);

    if($row = mysqli_fetch_assoc($resultData)){
        return $row;
    }else{
        $result = false;
        return $result;
    }
    mysqli_stmt_close($stmt);
}

function addAdmin($conn, $name, $icNum, $phoneNum, $email, $passwd, $department, $profilePic){
    $sql = " INSERT INTO admin_info(adminName, adminICNUM, adminphoneNumber, adminEmail, adminPassword, adminDepartment, profilePic) VALUES(?, ?, ?, ?, ?, ?, ?) ";
    $stmt = mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare($stmt, $sql)){
        header("location: ../admin/addAdmins.php?error=stmtfailed");
        exit();
    }

    $hashedPwd = password_hash($passwd, PASSWORD_DEFAULT);

    mysqli_stmt_bind_param($stmt, "sssssss", $name, $icNum, $phoneNum, $email, $hashedPwd, $department, $profilePic);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);

    header("location: ../admin/manageAdmins.php");
    exit();
}
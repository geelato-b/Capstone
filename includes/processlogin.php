<?php
if(isset($_POST['login'])){
include_once "db_conn.php";
include_once "func.inc.php";
session_start();

$studid = htmlentities($_POST['stud_id']);
$password = htmlentities($_POST['password']);

if(uidExists($conn, $studid, $password ) !== false){
    $user_info = uidExists($conn, $studid, $password );
    
    
    switch($user_info['user_type']){
      
        case 'S': $_SESSION['user_type'] = 'S';
                  $_SESSION['stud_id'] = $user_info['stud_id'];
                  header("location: ../user/");
                  break;

        case 'U': $_SESSION['user_type'] = 'U';
                  $_SESSION['stud_id'] = $user_info['stud_id'];
                  $_SESSION['status2'] = "<b>Please wait for admin's confirmation.";
                  header("location: ../index.php");
                  break;
            
        case 'A': $_SESSION['user_type'] = 'A';
                  $_SESSION['stud_id'] = $user_info['stud_id'];
                  header("location: ../admin/");
                  break;

        case 'Blocked': $_SESSION['user_type'] = 'Blocked';
                  $_SESSION['stud_id'] = $user_info['stud_id'];
                   $_SESSION['status1'] = "<b>Your account has been Blocked.<br>Please contact the admin.  ";
                  header("location: ../index.php");
                  break;
                 

    }
}
else{
  $_SESSION['status1'] = "<b>Login Failed!</b><br>Invalid username or password. Try again.";
    header("location: ../index.php");

   exit();
    }
}

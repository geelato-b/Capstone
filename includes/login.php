<?php
include_once "db_conn.php";
include_once "func.inc.php";
if(isset($_POST['stud_id']) && isset($_POST['password'])){
$studid = htmlentities($_POST['stud_id']);
$password = htmlentities($_POST['password']);
$user_info = uidExists($conn, $studid, $password );
    if( $user_info !== false) {
        session_start();
        $_SESSION['user_type'] = $user_info['user_type'];
        $_SESSION['stud_id'] = $user_info['stud_id'];
        echo $_SESSION['user_type'];
        if($_SESSION['user_type'] == 'S'){
            header("location: ../user/");
        }
        else if($_SESSION['user_type'] == 'A'){
            header("location: ../admin/");
        }
    }
    else{
          echo "error";
    }  
}
else{
    echo "error1";
}
   

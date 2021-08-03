<?php
if(isset($_POST['login'])){
include_once "db_conn.php";
include_once "func.inc.php";

$studid = htmlentities($_POST['stud_id']);
$password = htmlentities($_POST['password']);

    if(uidExists($conn, $studid, $password ) !== false){
        $user_info = uidExists($conn, $studid, $password );
        
        session_start();
        
        switch($user_info['user_type']){
          
            case 'S': $_SESSION['user_type'] = 'S';
                      $_SESSION['stud_id'] = $user_info['stud_id'];
                      header("location: ../user/");
                      break;
                
            case 'A': $_SESSION['user_type'] = 'A';
                      $_SESSION['stud_id'] = $user_info['stud_id'];
                      header("location: ../admin/");
                      break;
        }
    }else{
       echo "error";
       exit();
    }
}

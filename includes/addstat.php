<?php
session_start();

if(isset($_POST['pay_status'])){
include_once "db_conn.php";

    $status_id = htmlentities($_POST['status_id']);
    $stud_id = htmlentities($_POST['stud_id']);
    $stud_name = htmlentities($_POST['stud_name']);
    $stud_program = htmlentities($_POST['stud_program']);
    $stud_year_block  = htmlentities($_POST['stud_year_block']);
    $gender = htmlentities($_POST['gender']);
    $accbty_id = htmlentities($_POST['accbty_id']);
    $pay_status = htmlentities($_POST['pay_status']);
    $pymt_rcv_by = htmlentities($_POST['pymt_rcv_by']);
    $date= htmlentities($_POST['date']);
    
    
    $sql_check="SELECT * FROM `status` WHERE stud_id= ? AND accbty_id = ? ;";
    
    $stmt_chk = mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare($stmt_chk, $sql_check)){
       
       header("location: ../admin/payment.php?error=3"); //statement failed
        exit();
    }
    mysqli_stmt_bind_param($stmt_chk, "ss", $stud_id, $accbty_id);
    mysqli_stmt_execute($stmt_chk);
    $chk_result=mysqli_stmt_get_result($stmt_chk);
    $arr=array();
    while($row = mysqli_fetch_assoc($chk_result)){
            array_push($arr, $row);
    }

    if(!empty($arr)){
        
        header("location: ../admin/payment.php?error=1&itemname={$accbty_name}"); //item exist
        exit();
    }
    else{
       $sql_ins="INSERT INTO `status`
                            (`stud_id`
                            , `stud_name`
                            , `stud_program`
                            , `stud_year_block`
                            , `gender`
                            , `accbty_id`
                            , `pymt_rcv_by`
                            , `pay_status`
                            , `date`) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?);";
        $stmt_ins = mysqli_stmt_init($conn);
        if(!mysqli_stmt_prepare($stmt_ins, $sql_ins)){
           
            header("location: ../admin/payment.php?error=2"); //insert failed
            exit();
        }
        mysqli_stmt_bind_param($stmt_ins, "sssssssss", $stud_id , $stud_name,  $stud_program,  $stud_year_block, $gender, $accbty_id, $pymt_rcv_by, $pay_status, $date );
        mysqli_stmt_execute($stmt_ins);
        
        header("location: ../admin/payment.php?error=0"); //success
    }
}
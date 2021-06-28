<?php

if(isset($_POST['AddSS'])){
include_once "db_conn.php";
include_once "func.inc.php";
   
    $accbty_name = htmlentities($_POST['accbty_name']);
    $accbty_price = htmlentities($_POST['accbty_price']);
    $accbty_deadline = htmlentities($_POST['accbty_deadline']);
    $accbty_desc  = htmlentities($_POST['accbty_desc']);
    
    $sql_check="SELECT * 
                FROM `accountabilities`
                 WHERE  accbty_name = ?;";
    
    $stmt_chk = mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare($stmt_chk, $sql_check)){
       header("location: ../user/e-payment.php?error=3"); //statement failed
        exit();
    }
    mysqli_stmt_bind_param($stmt_chk, "s", $accbty_name);
    mysqli_stmt_execute($stmt_chk);
    $chk_result=mysqli_stmt_get_result($stmt_chk);
    $arr=array();
    while($row = mysqli_fetch_assoc($chk_result)){
            array_push($arr, $row);
    }

    if(!empty($arr)){
        header("location: ../user/e-payment.php?error=1&itemname={$accbty_name}"); //item exist
        exit();
    }
    else{
       
        $stmt_ins = mysqli_stmt_init($conn);
        if(!mysqli_stmt_prepare($stmt_ins, $sql_ins)){
            header("location: ../user/e-payment.php?error=2"); //insert failed
            exit();
        }
        mysqli_stmt_bind_param($stmt_ins, "ssss", $accbty_name,  $accbty_price,  $accbty_desc, $accbty_deadline);
        mysqli_stmt_execute($stmt_ins);
        header("location: ../user/e-payment.php?error=0"); //success
    }
}
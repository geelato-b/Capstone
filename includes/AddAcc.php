<?php
session_start();
if(isset($_POST['accbty_desc'])){
include_once "db_conn.php";
   
    $accbty_name = htmlentities($_POST['accbty_name']);
    $accbty_price = htmlentities($_POST['accbty_price']);
    $accbty_deadline = htmlentities($_POST['accbty_deadline']);
    $accbty_desc  = htmlentities($_POST['accbty_desc']);
    
    $sql_check="SELECT * 
                FROM `accountabilities`
                 WHERE  accbty_name = ?
                  ;";
    
    $stmt_chk = mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare($stmt_chk, $sql_check)){
        $_SESSION['status1'] = "Connection Failed.";
       header("location: ../admin/update.php?error=3"); //statement failed
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
        $_SESSION['status1'] = "<b>Already Exist.</b><br> Please change the item name.";
        header("location: ../admin/update.php?error=1&itemname={$accbty_name}"); //item exist
        exit();
    }
    else{
       $sql_ins="INSERT INTO `accountabilities`
                            (`accbty_name`
                            , `accbty_price`
                            , `accbty_desc`
                            , `accbty_deadline`)
                            VALUES (?, ?, ?, ?);";
        $stmt_ins = mysqli_stmt_init($conn);
        if(!mysqli_stmt_prepare($stmt_ins, $sql_ins)){
            $_SESSION['status1'] = "Failed to insert. Try again.";
            header("location: ../admin/update.php?error=2"); //insert failed
            exit();
        }
        mysqli_stmt_bind_param($stmt_ins, "ssss", $accbty_name,  $accbty_price,  $accbty_desc, $accbty_deadline);
        mysqli_stmt_execute($stmt_ins);
        $_SESSION['status'] ="<b>".  $accbty_name . "</b>". " is successfully added. <br><b>Deadline: </b>". $accbty_deadline;
        header("location: ../admin/update.php?error=0"); //success
    }
}
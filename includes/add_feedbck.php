<?php

if(isset($_POST['bu_email'])){
include_once "db_conn.php";
   
    $bu_email = htmlentities($_POST['bu_email']);
    $fb_cont = htmlentities($_POST['fb_cont']);
    

       $sql_ins="INSERT INTO `feedback`(`bu_email`, `fb_cont`)
                            VALUES (?, ?);";
        $stmt_ins = mysqli_stmt_init($conn);
        if(!mysqli_stmt_prepare($stmt_ins, $sql_ins)){
            header("location: ../footer/feedback.php?error=2"); //insert failed
            exit();
        }
        mysqli_stmt_bind_param($stmt_ins, "ss", $bu_email,  $fb_cont);
        mysqli_stmt_execute($stmt_ins);
        header("location: ../footer/feedback.php?error=0"); //success
    }

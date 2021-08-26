<?php

if(isset($_POST['AddSS'])){
include_once "db_conn.php";
include_once "func.inc.php";
session_start();
    $studid = htmlentities($_POST['stud_id']);
    $accbty_name = htmlentities($_POST['accbty_name']);
    $stud_name = htmlentities($_POST['stud_name']);
    $bu_email = htmlentities($_POST['bu_email']);
    $date_time = htmlentities($_POST['date_time']);
    $accbty_name = htmlentities($_POST['accbty_name']);
    $accbty_price = htmlentities($_POST['accbty_price']);
    
    // file upload initialization--------------------------------->

    $filecheckstat = true;
    $image_temp_file = $_FILES["itemimagefile"]["tmp_name"];
    $baseitem_img = basename($_FILES["itemimagefile"]["name"]) ;
    $ext = strtolower(pathinfo($baseitem_img, PATHINFO_EXTENSION));
    $target_dir = '../img';
    $target_filename = strtolower($studid).($accbty_name).".".$ext;

    $check = getimagesize($image_temp_file) ;
    $filecheckstat = $check !== false ? true : false;

    $file_stat = checkImage($_FILES["itemimagefile"], $target_dir, $target_filename) ;
    $file_err_count=0;
    $err_msg = null;

    foreach ($file_stat as $key => $stat) {
        if ($stat != '') {
            $error_msg .= ($file_err_count+1). ": ". $stat ."<br>";
            $file_err_count++;
        }
    }
    if ($error_msg !== null) {
        header("location: ../user/e-payment.php?error={$error_msg}");
        exit();
    }

    //file uplload initialization------------------------------->


    $sql_check="SELECT * 
                FROM `gcash`
                 WHERE  stud_id = ?;";
    
    $stmt_chk = mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare($stmt_chk, $sql_check)){
       header("location: ../user/e-payment.php?error=3"); //statement failed
        exit();
    }
    mysqli_stmt_bind_param($stmt_chk, "s", $studid);
    mysqli_stmt_execute($stmt_chk);
    $chk_result=mysqli_stmt_get_result($stmt_chk);
    $arr=array();
    while($row = mysqli_fetch_assoc($chk_result)){
            array_push($arr, $row);
    }
    $sql_ins = "INSERT INTO `gcash`
                  (`stud_id`,`stud_name`,`accbty_name`, `bu_email`, `date_time`, `img`) 
                   VALUES (?,?,?,?,?,?);";
        $stmt_ins = mysqli_stmt_init($conn);

        if(!mysqli_stmt_prepare($stmt_ins, $sql_ins)){
        header("location: ../user/e-payment.php?error=2&target_filename={$target_filename}"); //insert failed
        exit();
        }
        mysqli_stmt_bind_param($stmt_ins,"ssssss",$studid,$stud_name,$accbty_name,$bu_email,$date_time,$target_filename);
        mysqli_stmt_execute($stmt_ins);

        if (!$file_err_count) {
            //upload file

            if (move_uploaded_file($image_temp_file, $target_dir."/".$target_filename)) {
                echo "The file ". htmlspecialchars( basename($_FILES["fileToUpload"]["name"])). "file has been uploaded.";
            }else{
                header("localtion: ../user/e-payment.php?error=99"); //file upload failed
                exit();
            }
        }
        $_SESSION['status'] = " Success";
    
        header("location:  ../user/e-payment.php?error=0&Item Added &target_filename={$target_filename}"); //successful
        exit();

}
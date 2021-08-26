<?php
if(isset($_POST['fb_id'])){
        include "db_conn.php";
        $fb_id = htmlentities($_POST['fb_id']);
        $new_user_status = htmlentities($_POST['new_stat']);
    
         $sql_upd = "UPDATE `feedback` 
                        SET fb_status = ?
                    WHERE fb_id  = ?;";
        $stmt_upd = mysqli_stmt_init($conn);
        if(!mysqli_stmt_prepare($stmt_upd, $sql_upd)){
        header("location: ../admin/feedback.php?error=8"); //update failed
        exit();
        }
        mysqli_stmt_bind_param($stmt_upd,"ss", $new_user_status, $fb_id );
        mysqli_stmt_execute($stmt_upd);
        header("location: ../admin/feedback.php?updated");
        
}

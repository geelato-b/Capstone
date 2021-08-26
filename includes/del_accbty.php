<?php
if(isset($_POST['accbty_id'])){
        include "db_conn.php";
        $accbty_id = htmlentities($_POST['accbty_id']);
        $new_user_status = htmlentities($_POST['new_stat']);
    
         $sql_upd = "UPDATE `accountabilities` 
                        SET status = ?
                    WHERE accbty_id  = ?;";
        $stmt_upd = mysqli_stmt_init($conn);
        if(!mysqli_stmt_prepare($stmt_upd, $sql_upd)){
        header("location: ../admin/update.php?error=8"); //update failed
        exit();
        }
        mysqli_stmt_bind_param($stmt_upd,"ss", $new_user_status, $accbty_id );
        mysqli_stmt_execute($stmt_upd);
        header("location: ../admin/update.php?updated");
        
}

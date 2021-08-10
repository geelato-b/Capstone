<?php
if(isset($_POST['gcash_id'])){
        include "db_conn.php";
        $gcash_id = htmlentities($_POST['gcash_id']);
        $new_gc_status = htmlentities($_POST['confirm_status']);
    
         $sql_upd = "UPDATE `gcash`
                        SET gc_status = ?
                    WHERE gcash_id = ?;";
        $stmt_upd = mysqli_stmt_init($conn);
        if(!mysqli_stmt_prepare($stmt_upd, $sql_upd)){
        header("location: ../admin/GCash.php?error=8"); //update failed
        exit();
        }
        mysqli_stmt_bind_param($stmt_upd,"ss", $new_gc_status, $gcash_id);
        mysqli_stmt_execute($stmt_upd);
        header("location: ../admin/GCash.php?success_update=1");
        
    }


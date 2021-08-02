<?php
if(isset($_POST['stud_id'])){
        include "db_conn.php";
        $stud_id = htmlentities($_POST['stud_id']);
        $new_item_status = htmlentities($_POST['new_item_status']);
    
         $sql_upd = "UPDATE `gcash`
                        SET gc_status = ?
                    WHERE stud_id = ?;";
        $stmt_upd = mysqli_stmt_init($conn);
        if(!mysqli_stmt_prepare($stmt_upd, $sql_upd)){
        header("location: ../admin/Gcash.php?error=8"); //update failed
        exit();
        }
        mysqli_stmt_bind_param($stmt_upd,"ss",$new_item_status, $stud_id);
        mysqli_stmt_execute($stmt_upd);
        header("location: ../admin/Gcash.php?success_update=1");
        
    }

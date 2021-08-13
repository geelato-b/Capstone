<?php
if(isset($_POST['stud_id'])){
        include "db_conn.php";
        $stud_id = htmlentities($_POST['stud_id']);
        $new_user_status = htmlentities($_POST['block_user']);
    
         $sql_upd = "UPDATE `student_acc` 
                        SET user_type = ?
                    WHERE stud_id  = ?;";
        $stmt_upd = mysqli_stmt_init($conn);
        if(!mysqli_stmt_prepare($stmt_upd, $sql_upd)){
        header("location: ../admin/student_acc.php?error=8"); //update failed
        exit();
        }
        mysqli_stmt_bind_param($stmt_upd,"ss", $new_user_status, $stud_id );
        mysqli_stmt_execute($stmt_upd);
        header("location: ../admin/student_acc.php?updated");
        
}

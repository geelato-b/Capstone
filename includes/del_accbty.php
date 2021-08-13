<?php
if(isset($_GET['Accbty_id'])){
        include "db_conn.php";
        $Accbty_id = htmlentities($_GET['Accbty_id']);
         $sql_del = "DELETE FROM `accountabilities` WHERE Accbty_id = ? ; ";
        $stmt_del = mysqli_stmt_init($conn);

            if(!mysqli_stmt_prepare($stmt_del, $sql_del)){
            header("location: ../admin/update.php?error=9"); //delete failed
            exit();
            }
            
        mysqli_stmt_bind_param($stmt_del,"s",$Accbty_id);
        mysqli_stmt_execute($stmt_del);
        header("location: ../admin/update.php?success_delete");
        
    }
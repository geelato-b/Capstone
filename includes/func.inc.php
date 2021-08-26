<?php
function uidExists($conn, $studid, $password ){
    $err;
    $sql="SELECT * FROM `student_acc` 
    WHERE  `stud_id` = ?
    AND `password`= ?;";

$stmt=mysqli_stmt_init($conn);

        if (!mysqli_stmt_prepare($stmt, $sql)){
        header("location: sign_in.php?error=stmtfailed");
        exit();
    }

        mysqli_stmt_bind_param($stmt, "ss" , $studid, $password);
        mysqli_stmt_execute($stmt);

        $resultData = mysqli_stmt_get_result($stmt);
        
        if($row = mysqli_fetch_assoc($resultData)){
            return $row;
        }
        else{
            $err=  false;
            return $err;   
        }
        mysql_stmt_close($stmt);
}

function GetUserDetails($conn, $studid ){
    $err;
    $sql="SELECT * FROM `student_info` 
    WHERE  stud_id = ?;";

$stmt=mysqli_stmt_init($conn);

        if (!mysqli_stmt_prepare($stmt, $sql)){
        header("location: index.php?error=stmtfailed");
        exit();
    }

        mysqli_stmt_bind_param($stmt, "s" , $studid);
        mysqli_stmt_execute($stmt);

        $resultData = mysqli_stmt_get_result($stmt);
        
        if($row = mysqli_fetch_assoc($resultData)){
            return $row;
        }
        else{
            $err=  false;
            return $err;   
        }
        mysql_stmt_close($stmt);
}
function cidExists($conn, $stid){
    $sql = "SELECT * FROM `student_acc`  WHERE `stud_id` = ?;";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("location: ../form.php?error=stmtfailed");
        exit();
    }
    mysqli_stmt_bind_param($stmt, "s", $stid);
    mysqli_stmt_execute($stmt);

    $resultData = mysqli_stmt_get_result($stmt);

    if ($row = mysqli_fetch_assoc($resultData)) {
         return $row;
    } else {
        $result = false;
        return $result;
    }

    mysqli_stmt_close($stmt);
 }
function passExists($conn, $psword){
    $sql = "SELECT * FROM `student_acc`  WHERE `password` = ?;";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("location: ../form.php?error=stmtfailed");
        exit();
    }
    mysqli_stmt_bind_param($stmt, "s", $psword);
    mysqli_stmt_execute($stmt);

    $resultData = mysqli_stmt_get_result($stmt);

    if ($row = mysqli_fetch_assoc($resultData)) {
         return $row;
    } else {
        $result = false;
        return $result;
    }

    mysqli_stmt_close($stmt);
 }

function passMatch($psword, $cpassword) {
    $result;
    if($psword !== $cpassword) {
        $result = true;
    } else {
        $result = false;
    }
    return $result;
}

function checkImage($img_file, $target_dir, $targetimagename){
    $stat = array(
        'fileSizeOk' => '',
        'fileExists' => '',
        'fileType'   => ''
    );

    $tmp_filename = $img_file['tmp_name'];
    $file_size = $img_file['size'];
    $img_size = getimagesize($img_file['tmp_name']);
    $img_mime = $img_size['mime'];
    $acceptable_files = array('image/jpeg','image/png','image/jpg');

    if (! in_array($img_mime, $acceptable_files)) {
        $stat['fileType'] = "This file is not an image .[jpg / png ]only";
    }
    if ($img_size === false || $file_size >500000) {
        $stat['fileSizeOk'] = "image size is not acceptable";
    }
   
    return $stat;
}

function getCategories($conn){
    $sql = "SELECT * FROM `accountabilities`";
    $stmt=mysqli_stmt_init($conn);
    
    if (!mysqli_stmt_prepare($stmt, $sql)){
        return false;
        exit;
    }
        mysqli_stmt_execute($stmt);
        $resultData = mysqli_stmt_get_result($stmt);
        $resArr = array();
      if(!empty($resultData)){
        while($row = mysqli_fetch_assoc($resultData)){
            array_push($resArr, $row);
        }
        return $resArr;
      }
        else{
            return false;
      }
        mysql_stmt_close($stmt);
}


function getSalesPerfCat($conn, $cat_id = null){
    if($cat_id != null){

         $sql="SELECT c.date
                   , c.stud_name
                   , c.accbty_price
                from `status` c
                join `accountabilities` i
                  on (c.accbty_id = i.accbty_id)
               WHERE i.accbty_id = ?
                 AND c.pay_status = 'P';
        ";
        $params = array();
        array_push($params, $cat_id);
        
        return query($conn, $sql, $params );
    } 
    else if($cat_id != null) {
            $sql="SELECT c.date
            , c.stud_name
            , c.accbty_price
         from `status` c
         join `accountabilities` i
           on (c.accbty_id = i.accbty_id)
        WHERE i.accbty_id = ?
          AND c.pay_status = 'P';
        ";
        $params = array();
        array_push($params, $cat_id);
        
        return query($conn, $sql, $params );
    }
    else{
         $sql="SELECT c.date
         , c.stud_name
         , c.accbty_price
      from `status` c
      join `accountabilities` i
        on (c.accbty_id = i.accbty_id)
     WHERE i.accbty_id = ?
       AND c.pay_status = 'P'
        ";
        
        return query($conn, $sql);
    }
       
        
    }




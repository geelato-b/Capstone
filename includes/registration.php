<?php
session_start();
include_once "func.inc.php";

$stid = $_POST['stid'];
$studname = $_POST['studname'];
$psword = $_POST['psword'];
$cpassword = $_POST['cpassword'];
$studprog = $_POST['studprog'];
$studyrblck = $_POST['studyrblck'];
$gender = $_POST['gender'];
$studbdate = $_POST['studbdate'];
$studaddress = $_POST['studaddress'];
$status = $_POST['status'];
$usertype = $_POST['usertype'];
$result = "";

$servername = "localhost";
$studid = "root";
$password = "";
$dbname = "capstone";

$conn = mysqli_connect($servername, $studid, $password, $dbname);

if (!$conn) {
die("Connection failed: " . mysqli_connect_error());
}
 
if(cidExists($conn, $stid)!== false){
    $_SESSION['status'] = "Account already exist.";
    header("location:../admin/form.php?error=This Student ID already have an account.");
    exit();

}
if(passExists($conn, $psword)!== false){
    $_SESSION['status'] = "Password already exist.";
    header("location:../admin/form.php?error=Password is already taken");
    exit();

}
if(passMatch($psword, $cpassword)!== false){
    
    $_SESSION['status'] = "Password don't match.";
    header("location:../admin/form.php?error=Password don't match");
    exit();    
    
}
else{

$sql = "INSERT INTO `student_acc` ( `stud_id`, `stud_name`, `password`, `status`, `user_type`)
VALUES (  '${stid}',  '${studname}','${psword}', 'Active', 'S');" ;

$sql .="INSERT INTO  `student_info` 
(  `stud_id`, `stud_name`,`stud_program`, `stud_year_block`, `gender`, `stud_birthdate`, `stud_address`) 
 VALUES('${stid}', '${studname}', '${studprog}', '${studyrblck}', '${gender}', '${studbdate}', '${studaddress}');";


if (mysqli_multi_query($conn, $sql)) {
     $_SESSION['status'] = "<h2>Successfully Registered.</h2>";
    header("location:../admin/form.php?success");
    } else {
    echo "Error: " . $sql . mysqli_error($conn);
    }
    
}

mysqli_close($conn);
?>
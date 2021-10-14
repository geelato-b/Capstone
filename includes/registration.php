<?php
 session_start();
include_once "func.inc.php";

$stid = $_POST['stid'];
$studname = $_POST['studname'];
$bu_email = $_POST['bu_email'];
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
// $pattern = "^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$^";  
$pattern = "^[_a-z0-9-]+(\.[_a-z0-9-]+)*@bicol-u.edu.ph$^"; 
$id = "^[2-9-]+*-PC-+[1-9-]+$^"; 
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
    header("location: ../form.php?error=This Student ID have already  an account.");
    exit();

}
if(passExists($conn, $psword)!== false){
    $_SESSION['status'] = "Password already exist.";
    header("location: ../form.php?error=Password is already taken");
    exit();

}
if(passMatch($psword, $cpassword)!== false){
    
    $_SESSION['status'] = "Password don't match.";
    header("location: ../form.php?error=Password don't match");
    exit();    
    
}elseif (!preg_match ("/^([a-zA-Z ,.' ]+)$/", $studname) ) {  
     $_SESSION['status'] = "Your name is not valid.";
    header("location: ../form.php?error=NotValid");
    exit();   
}elseif (!preg_match ($pattern, $bu_email) ){
    $_SESSION['status'] = "Your Email is not valid.";
    header("location: ../form.php?error=NotValid");
    exit();  
}
elseif (!preg_match("/^([0-9 ' ]+[-PC-]+[0-9 ']+)$/" ,$stid)) {
    $_SESSION['status'] = "Your Student ID Number is not valid.";
    header("location: ../form.php?error=NotValid");
    exit(); 
} 
elseif (!preg_match("/^([0-9]+[a-zA-Z]+)$/" ,$studyrblck)) {
    $_SESSION['status'] = "Your Yr. & Block is not valid.";
    header("location: ../form.php?error=NotValid");
    exit(); 
} 
elseif (!preg_match("#.*^(?=.{8,20})(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*\W).*$#" ,$psword)) {
    $_SESSION['status'] = "<b>Your Password is not valid.</b> <br> Password must be at least 8 characters in length and must contain at least one number,one upper case letter, one lower case letter and one special character.";
    header("location: ../form.php?error=NotValid");
    exit(); 
 } 
else{

$sql = "INSERT INTO `student_acc` ( `stud_id`,`bu_email`, `stud_name`, `password`, `status`, `user_type`)
VALUES (  '${stid}','${bu_email}',  '${studname}','${psword}', 'Active', 'U');" ;

$sql .="INSERT INTO  `student_info` 
(  `stud_id`,`bu_email`, `stud_name`,`stud_program`, `stud_year_block`, `gender`, `stud_birthdate`, `stud_address`) 
 VALUES('${stid}','${bu_email}', '${studname}', '${studprog}', '${studyrblck}', '${gender}', '${studbdate}', '${studaddress}');";


if (mysqli_multi_query($conn, $sql)) {
     $_SESSION['status'] = "Please wait for admin's confirmation.";
    header("location: ../index.php?success");
    } else {
    echo "Error: " . $sql . mysqli_error($conn);
    }
    
}

mysqli_close($conn);
?>

<?php
session_start();
include_once "../includes/db_conn.php";
include_once "../includes/func.inc.php";  
$STUD_ID = $_SESSION['stud_id'];


if (count($_POST) > 0) {
    $result = mysqli_query($conn, "SELECT * from student_acc WHERE stud_id ='" .  $_SESSION['stud_id'] . "'");
    $row = mysqli_fetch_array($result);
    if ($_POST["currentPassword"] == $row["password"]) {
        mysqli_query($conn, "UPDATE student_acc set password='" . $_POST["newPassword"] . "' WHERE stud_id ='" . $_SESSION['stud_id'] . "'");
        $message = "Password Changed";
    } else
        $message = "Current Password is not correct";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" > 
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
</head>
<body>

<nav class="navbar navbar-light bg-light">
  <div class="container-fluid">
    <span class="navbar-text">
     <a href="index.php"><i class="bi bi-house-door-fill"></i></a>
    </span>
  </div>
</nav>

<script>
function validatePassword() {
var currentPassword,newPassword,confirmPassword,output = true;

currentPassword = document.frmChange.currentPassword;
newPassword = document.frmChange.newPassword;
confirmPassword = document.frmChange.confirmPassword;

if(!currentPassword.value) {
	currentPassword.focus();
	document.getElementById("currentPassword").innerHTML = "required";
	output = false;
}
else if(!newPassword.value) {
	newPassword.focus();
	document.getElementById("newPassword").innerHTML = "required";
	output = false;
}
else if(!confirmPassword.value) {
	confirmPassword.focus();
	document.getElementById("confirmPassword").innerHTML = "required";
	output = false;
}
if(newPassword.value != confirmPassword.value) {
	newPassword.value="";
	confirmPassword.value="";
	newPassword.focus();
	document.getElementById("confirmPassword").innerHTML = "not same";
	output = false;
} 	
return output;
}
</script>
</head>
<body>

<section id="main-content">
    <div class="container">
        <form name="frmChange" method="post" action=""
        onSubmit="return validatePassword()">
                <legend>Change Password</legend>
                
                <div class="message"><?php if(isset($message)) { echo $message; } ?></div>

                <div class="mb-3">
                <label for="disabledTextInput" class="form-label">Student ID</label>
                <input type="text" name="stud_id" class="form-control" value="<?php echo $_SESSION['stud_id'];?>">
                </div>
                <div class="mb-3">
                <label for="disabledTextInput" class="form-label">Current Password</label>
                <input type="password" name="currentPassword" class="form-control" >
                </div>
                <div class="mb-3">
                <label for="disabledTextInput" class="form-label">New Password</label>
                <input type="password" name="newPassword" id="newPassword" class="form-control">
                <span id="confirmPassword" class="required"></span>
                </div>
                <div class="mb-3">
                <label for="disabledTextInput" class="form-label">Confrim Password</label>
                <input type="password" name="confirmPassword" id= "confirmPassword" class="form-control">
                <span id="confirmPassword" class="required"></span>
                </div>
          
                <div class="mb-3">
                <button type="submit" class="btn btn-primary">Submit</button>
           
        </form>

    </div>

</section>




    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" ></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.min.js" ></script>
</body>
</html>
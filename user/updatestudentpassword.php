<?php
session_start();
include_once "../includes/db_conn.php";
include_once "../includes/func.inc.php";   
$status_logged_in = null;
if(isset($_SESSION['user_type']) && isset($_SESSION['stud_id']) ){
    $status_logged_in = array('status' => true, 'user_type' => $_SESSION['user_type'] );
    

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
     <a href="student_acc.php"><i class="bi bi-back"></i></a>
    </span>
  </div>
</nav>

<section>
    <div class="container">
        <form>
                <legend>Change Password</legend>

                <?php if (isset($_GET['error'])) { ?>
     		<p class="error"><?php echo $_GET['error']; ?></p>
     	<?php } ?>

     	<?php if (isset($_GET['success'])) { ?>
            <p class="success"><?php echo $_GET['success']; ?></p>
        <?php } ?>



                <div class="mb-3">
                <label for="disabledTextInput" class="form-label">Student ID</label>
                <input type="text" name="stud_id" class="form-control">
                </div>
                <div class="mb-3">
                <label for="disabledTextInput" class="form-label">Old Password</label>
                <input type="password" name="op" class="form-control">
                </div>
                <div class="mb-3">
                <label for="disabledTextInput" class="form-label">New Password</label>
                <input type="password" name="np" class="form-control">
                </div>
                <div class="mb-3">
                <label for="disabledTextInput" class="form-label">Confrim Password</label>
                <input type="password" name="c_np" class="form-control">
                </div>
          
                <div class="mb-3">
                <button type="submit" class="btn btn-primary">Submit</button>
           
        </form>

    </div>

</section>


<?php    

    }

else{
    header("location: ../index.php");  
}
?>

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" ></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.min.js" ></script>
</body>
</html>
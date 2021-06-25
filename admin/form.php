<?php
session_start();
include_once "../includes/db_conn.php";
include_once "../includes/func.inc.php";  
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
     <a href="index.php"><i class="bi bi-house-fill"></i></a>
     <a href="student_acc.php"><i class="bi bi-back"></i></a>
    </span>
  </div>
</nav>

<section>
    <div class="container">
        <form action="../includes/registration.php" method="POST">
                <legend>Register</legend>
                <?php
                    if (isset($_SESSION['status'])) {
                    ?>
                    <div class="input-box">
                    <div class="alert alert-warning" role="alert">
                    <?php echo $_SESSION['status']; ?>
                    </div>
                    </div>
                    <?php
                        
                        unset($_SESSION['status']);
                    }
                ?>

                <div class="mb-3">
                <label for="disabledTextInput" class="form-label">Student ID</label>
                <input type="text" id="stid" name="stid" class="form-control" required="">
                </div>
                <div class="mb-3">
                <label for="disabledTextInput" class="form-label">Student FullName</label>
                <input type="text" id="studname" name="studname" class="form-control" required="">
                </div>
                <div class="mb-3">
                <label for="disabledTextInput" class="form-label">Password</label>
                <input type="password" id="psword" name="psword" class="form-control" required="">
                </div>
                <div class="mb-3">
                <label for="disabledTextInput" class="form-label">Confrim Password</label>
                <input type="password" id="cpassword" name="cpassword" class="form-control" required="">
                </div>
                <div class="mb-3">
                <label for="disabledTextInput" class="form-label">Gender</label>
                <select id="gender" name="gender" class="form-select" > 
                    <option value="F">Female</option>
                    <option value="M">Male</option>
                </select>
                </div>
                <div class="mb-3">
                <label for="disabledSelect" class="form-label">Program</label>
                <select id="studprog" name="studprog" class="form-select" >
                    <option>BS Information Technology</option>
                    <option>BS Information Technology Animation</option>
                </select>
                </div>
                <div class="mb-3">
                <label for="disabledTextInput" class="form-label">Year & Block</label>
                <input type="text" id="studyrblck" name="studyrblck" class="form-control" placeholder="Example: 1A" required="">
                </div>
                <button type="submit" name="submit"class="btn btn-primary">Submit</button>
           
        </form>

    </div>

</section>






    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" ></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.min.js" ></script>
</body>
</html>
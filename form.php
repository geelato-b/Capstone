<?php
session_start();
include_once "includes/db_conn.php";
include_once "includes/func.inc.php";  
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
    </span>
  </div>
</nav>

<section>
    <div class="container">
        <form action="includes/registration.php" method="POST">
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
                <label for="disabledTextInput" class="form-label">BU Email</label>
                <input type="email" id="bu_email" name="bu_email" class="form-control" required="">
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
                <label for="disabledTextInput" class="form-label">Confirm Password</label>
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
                    <option>BS in Computer Engineering</option>
                    <option>BS in Computer Science</option>
                    <option>BS in Mechanical Technology</option>
                    <option>BS in Automotive Technology</option>
                    <option>BS in Electrical Technology</option>
                    <option>BS in Food Technology</option>
                    <option>Bachelor of Science in Nursing</option>
                    <option>Bachelor of Tech and Livelihood Education</option>

                </select>
                </div>
                <div class="mb-3">
                <label for="disabledTextInput" class="form-label">Year & Block</label>
                <input type="text" id="studyrblck" name="studyrblck" class="form-control" placeholder="Example: 1A" required="">
                </div>

                <div class="mb-3">
                <label for="disabledTextInput" class="form-label">Student Birthdate</label>
                <input type="date" id="studname" name="studbdate" class="form-control" required="">
                </div>

                <div class="mb-3">
                <label for="disabledTextInput" class="form-label">Student Address</label>
                <input type="text" id="studname" name="studaddress" class="form-control" required="">
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
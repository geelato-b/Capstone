<?php
session_start();
include_once ('includes/db_conn.php');
include_once ('includes/func.inc.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign In: BUPC CSC Accountability System</title>
   <!-- CSS only -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" > 
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
    <link rel="stylesheet" href="css/style.css">
   
</head>
<body>



<!-------------------Sign In section------------------->

<section id="sign_in">
    <div class="container">
    <div class="row">
    <div class="form-container">
                    
                    <div class="sign-in">
                    <form action="includes/processlogin.php" method="POST" id="login" class="signin-form" >
                        <?php
                            if (isset($_SESSION['status'])) {
                            ?>
                            <div class="input-box">
                            <div class="alert alert-success" role="alert">
                            <?php echo $_SESSION['status']; ?>
                            </div>
                            </div>
                            <?php
                                
                                unset($_SESSION['status']);
                            }
                            ?>
                    <h2 class="title">Sign In</h2>
                    <div>
                        <img class="img-profile " src="img/logo2.png" width="115px" height="105px">
                        <img class="img-profile" src="img/logo1.png" width="100px" height="100px">
                      </div>
                            <div class="input-field">
                            <i class="bi bi-person-fill"></i>
                                <input name="stud_id" type="text" placeholder="Student ID" required>
                            </div>
        
                            <div class="input-field">
                            <i class="bi bi-lock-fill"></i>
                                <input  name="password" type="password" placeholder="Password" required>
                            </div>
        
                                <button type="submit" name="login"value="login" class="signin-btn">Log In</button>
                                <br>
                                <div>
                                </div>
                                
                                <div class="sign_up">
                                <a href="form.php">Don't have an account yet?</a>
                                </div>
                                
                                
                            </form>
                    </div>
                </div>
                
        
                <div class="panels-container">
                    <div class="panel left-panel">
                        <img src="img/sign_in.svg" class="image" alt="">
                    </div>
                </div>

    </div>
        

    </div>


</section>




<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" ></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.min.js" ></script>
</body>
</html>

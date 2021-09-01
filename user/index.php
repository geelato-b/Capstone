<?php
session_start();
include_once "../includes/db_conn.php";
include_once "../includes/func.inc.php";   
$status_logged_in = null;
if(isset($_SESSION['user_type']) && isset($_SESSION['stud_id']) ){
    $status_logged_in = array('status' => true, 'user_type' => $_SESSION['user_type'] );
    
    $STUD_ID = $_SESSION['stud_id'];
    $student_info = GetUserDetails($conn, $STUD_ID );

 ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BUPC CSC Accountability System</title>
   <!-- CSS only -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" > 
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
    <link rel="stylesheet" href="../css/style.css">
   
</head>
<body>
<section id= "nav-bar">
<header id="header">

    <div class="px-3 py-2 ">
      <div class="container">
        <div class="navbar d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start">
          <a href="#" class="logo d-flex align-items-center my-2 my-lg-0 me-lg-auto text-decoration-none text-dark">
          <img class="img-profile " src="../img/logo2.png" width="115px" height="105px">
            <img src="../img/logo1.png" alt="" width="100px" height="100px">
          </a>

          <ul class="nav col-12 col-lg-auto my-2 justify-content-center my-md-0 text-small">
            <li>
              <a href="index.php" class="nav-link text-dark">Home</a>
            </li>
            <li>
              <a href="acc.php" class="nav-link text-dark">Accountability
              <?php 
                            $sql_count = "SELECT COUNT(*) cartcount FROM `accountabilities` WHERE status = 'A';";
                            $stmt=mysqli_stmt_init($conn);
        
                        if (!mysqli_stmt_prepare($stmt, $sql_count)){
                            header("location: index.php?error=stmtfailed");
                            exit();
                        }
                            
                            mysqli_stmt_execute($stmt);

                            $resultData = mysqli_stmt_get_result($stmt);

                            if($row = mysqli_fetch_assoc($resultData)){ ?>
                                <span class="position-absolute translate-middle badge rounded-pill bg-danger"><?php echo $row['cartcount']; ?></span>
                            <?php }
                        
                            ?>
            
              </a>
            </li>
            <li>
              <a href="status.php" class="nav-link text-dark">Status
              <?php 
                            $sql_cart_count = "SELECT COUNT(*) cartcount FROM `status` WHERE pay_status = 'P' AND stud_id = ?;";
                            $stmt=mysqli_stmt_init($conn);
        
                        if (!mysqli_stmt_prepare($stmt, $sql_cart_count)){
                            header("location: index.php?error=stmtfailed");
                            exit();
                        }
                            mysqli_stmt_bind_param($stmt, "s" ,$_SESSION['stud_id']);
                            mysqli_stmt_execute($stmt);

                            $resultData = mysqli_stmt_get_result($stmt);

                            if($row = mysqli_fetch_assoc($resultData)){ ?>
                                <span class="position-absolute translate-middle badge rounded-pill bg-danger"><?php echo $row['cartcount']; ?></span>
                            <?php }
                        
                            ?>

              </a>
            </li>
            <li>
              <a href="e-payment.php" class="nav-link text-dark">G-Cash
              <?php 
                            $sql_cart_count = "SELECT COUNT(*) cartcount FROM `gcash` WHERE gc_status = 'UC' AND stud_id = ?;";
                            $stmt=mysqli_stmt_init($conn);
        
                        if (!mysqli_stmt_prepare($stmt, $sql_cart_count)){
                            header("location: index.php?error=stmtfailed");
                            exit();
                        }
                            mysqli_stmt_bind_param($stmt, "s" ,$_SESSION['stud_id']);
                            mysqli_stmt_execute($stmt);

                            $resultData = mysqli_stmt_get_result($stmt);

                            if($row = mysqli_fetch_assoc($resultData)){ ?>
                                <span class="position-absolute translate-middle badge rounded-pill bg-danger"><?php echo $row['cartcount']; ?></span>
                            <?php }
                        
                            ?>

              </a>
            </li>
            <li>
              <a href="setting.php" class="nav-link text-dark">Setting</a>
            </li>
            <li>
              <a href="about.php" class="nav-link text-dark">About Us</a>
            </li>
            
            <li>
              <a href="../logout.php" type="button" class="nav-link btn btn-outline-warning text-dark">Log out</a>
            </li>
          </ul>
        </div>
      </div>
    </div>
  </header>

</section>

<!-------------------banner section------------------->

<section id="banner">
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <p class="banner-title">BUPC CSC Accountability System</p>
		    <p>"We'll keep your finances on the track where everybody counts."</p>
	
                
            </div>
            <div class="col-md-6">
                <img src="../img/banner4.svg" alt="" class="img-fluid">
            </div>
        </div>
    </div>
        
</section>

<section id="banner">
    <div class="container">
        <div class="row">
        <p class="title">Pay through Gcash</p>
        
            <div class="col-md-6">
            <img src="../img/steps.svg" alt="" class="img-fluid">  
            </div>

            <div class="col-md-6 justify-content-center">
            <div id="carouselExampleSlidesOnly" class="carousel slide" data-bs-ride="carousel">
              <div class="carousel-inner">
                <div class="carousel-item active">
                  <img src="../img/step1.png" class="d-block w-100" alt="...">
                </div>
                <div class="carousel-item">
                  <img src="../img/step2.png" class="d-block w-100" alt="...">
                </div>
                <div class="carousel-item">
                  <img src="../img/step3.png" class="d-block w-100" alt="...">
                </div>
              </div>
            </div>
                
            </div>
        </div>
    </div>
        
</section>


<section id="banner">
    <div class="container">
        <div class="row">
          
            <div class="col-md-6 justify-content-center">
            <img src="../img/status.svg" alt="" class="img-fluid">  
                
            </div>

            <div class="col-md-6">
            <p class="banner-title">Check your Accountability Status</p>
                
            </div>
        </div>
    </div>
        
</section>





<footer class="footer">
				<div class="container-fluid">
					<div class="row text-muted">
						<div class="col-6 text-left">
							<p class="mb-0">
								<a href="index.php" class="text-muted"><strong>BUPC CSC Accountability System </strong></a> &copy
							</p>
						</div>
						<div class="col-6 text-right">
							<ul class="list-inline">
								<li class="footer-item">
									<a class="text-muted" href="https://www.facebook.com/bupc.csc.one">Contact</a>
								</li>
								<li class="footer-item">
									<a class="text-muted" href="../footer/privacy.php">Privacy Policy</a>
								</li>
								<li class="footer-item">
									<a class="text-muted" href="../footer/terms.php">Terms of Service</a>
								</li>
                <li class="footer-item">
									<a class="text-muted" href="../footer/feedback.php">Feedback</a>
								</li>
							</ul>
						</div>
					</div>
				</div>
			</footer>

      <?php    

}

else{
header("location: ../index.php");  
}
?>


<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" ></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.min.js" ></script>
</body>
</html>

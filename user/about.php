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
              <a href="status.php" class="nav-link text-dark">Status</a>
            </li>
            <li>
              <a href="e-payment.php" class="nav-link text-dark">G-Cash</a>
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
            <p class="banner-title">BUPC College Student Council</p>
                <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Accusamus sed, quo, 
                    odit ratione nobis, commodi dignissimos reiciendis 
                    ipsam voluptates optio delectus consequatur 
                    excepturi tenetur officia recusandae illo quia 
                     distinctio?</p>
            
            </div>

            <div class="col-md-6 justify-content-center">
            <img src="../img/csc.svg" alt="" class="img-fluid">
            
            </div>
                
            </div>
        </div>
    </div>
        
</section>

<section id="banner">
    <div class="container">
        <div class="row">
            <div class="col-md-6">
            <p class="banner-title">BUPC CSC Accountability System</p>
                <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Accusamus sed, quo, 
                    odit ratione nobis, commodi dignissimos reiciendis 
                    ipsam voluptates optio delectus consequatur 
                    excepturi tenetur officia recusandae illo quia 
                     distinctio?</p>
            </div>

            <div class="col-md-6 justify-content-center">
            <img src="../img/system.svg" alt="" class="img-fluid">  
                
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
									<a class="text-muted" href="#">Contact</a>
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

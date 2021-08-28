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

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
    <link rel="stylesheet" href="../css/dash.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" >
    <title>Admin Dashboard: BUPC CSC Accountability System</title>
  </head>
  <body>
  <div id="wrapper">
   <div class="overlay"></div>
    
        <!-- Sidebar -->
        <nav class="fixed-top align-top" id="sidebar-wrapper" role="navigation">
       <div class="simplebar-content" style="padding: 0px;">
				<a class="sidebar-brand" href="index.php">
        <br>
          <span class="align-middle">BUPC CSC AS</span>
        </a>

	<ul class="navbar-nav align-self-stretch">
	 
      <li class="sidebar-header"></li>
	  <li class=""> 
      <a href="index.php" class="nav-link text-left active"  role="button"><i class="bi bi-house-door"></i>Dashboard </a></li>

      <li class="has-sub"> 
		  <a class="nav-link collapsed text-left" href="#collapseExample2" role="button" data-toggle="collapse" >
      <i class="bi bi-people-fill"></i>Student
         </a>
		  <div class="collapse menu mega-dropdown" id="collapseExample2">
        <div class="dropmenu" aria-labelledby="navbarDropdown">
		  <div class="container-fluid ">
									<div class="submenu-box"> 
										<ul class="list-unstyled m-0">
											<li><a href="student_acc.php">Student Account</a></li>
											<li><a href="student_info.php">Student Information</a></li>
										</ul>
									</div>
								</div>
							</div>
		  </div>
		  </li>

		  <li><a href="payment.php" class="nav-link text-left"  role="button"><i class="bi bi-cash-coin"></i>Payment</a></li>
      <li><a href="Gcash.php" class="nav-link text-left"  role="button"><i class="bi bi-currency-exchange"></i>Gcash</a></li>
          <li><a href="status.php" class="nav-link text-left"  role="button"><i class="bi bi-person-lines-fill"></i>Status</a></li>
          <li><a href="update.php" class="nav-link text-left"  role="button"><i class="bi bi-journal-check"></i>Update</a></li>
          <li><a href="setting.php" class="nav-link text-left"  role="button"><i class="bi bi-gear-fill"></i>Setting</a></li>
          <li><a href="../logout.php" class="nav-link text-left"  role="button"><i class="bi bi-door-open"></i>Log Out</a></li>

		  </ul>	
        </div>
    </nav>
        <!-- /#sidebar-wrapper -->


        <!-- Page Content -->
        <div id="page-content-wrapper">
         
			
			<div id="content">

       <div class="container-fluid p-0 px-lg-0 px-md-0">
        <!-- Topbar -->
      <nav class="navbar navbar-expand navbar-light my-navbar">

          <!-- Sidebar Toggle (Topbar) -->
            <div type="button"  id="bar" class="nav-icon1 hamburger animated fadeInLeft is-closed" data-toggle="offcanvas">
               <span></span>
			    <span></span>
				 <span></span>
          </div>
		
          <!-- nav alert -->
          <div id="nav-alert">
            <a href="index.php"><h4>BUPC CSC Accountability System</h4></a>
          </div>
  
          <!-- Topbar Navbar -->
          <ul class="navbar-nav ml-auto">
            <li>
              <div>
                <img class="img-profile " src="../img/logo2.png" width="115px" height="105px" max-width="50px">
                <img class="img-profile" src="../img/logo1.png" width="100px" height="100px">
              </div>
                
            </li>

          </ul>

        </nav>  
        <!-- End of Topbar -->

        <!-- Begin Page Content -->
        <section id="main-content">
        <div class="container-fluid px-lg-4">
<div class="row">
<div class="col-md-12 mt-lg-4 mt-4">
          <!-- Page Heading -->
          <img src="../img/hello.svg" alt="" width="150px" height="150px"> 
          <h1>Hello!</h1>
<div class="col-md-12">
       <div class="row">
									<div class="col-sm-3">
										<div class="card">
											<div class="card-body">
												<a href="student_info.php"><h5 class="card-title mb-4">Total of Number Registered Students</h5>
                        <?php 
                            $sql_count = "SELECT COUNT(*) cartcount FROM `student_acc` WHERE status = 'Active' AND user_type = 'S' OR user_type = 'blocked';";
                            $stmt=mysqli_stmt_init($conn);
        
                        if (!mysqli_stmt_prepare($stmt, $sql_count)){
                            header("location: index.php?error=stmtfailed");
                            exit();
                        }
                            
                            mysqli_stmt_execute($stmt);

                            $resultData = mysqli_stmt_get_result($stmt);

                            if($row = mysqli_fetch_assoc($resultData)){ ?>
                                <span style = "font-size:1.5rem;
                                                color:white;" class="badge bg-primary"><?php echo $row['cartcount']; ?></span>
                            <?php }
                        
                            ?>
                      
                      </a>
											</div>
										</div>
										
									</div>
									<div class="col-sm-3">
										<div class="card">
											<div class="card-body">
												<a href="GCash.php"><h5 class="card-title mb-4">Pending Gcash Payment</h5>
                        <?php 
                            $sql_count = "SELECT COUNT(*) cartcount FROM `gcash` WHERE gc_status = 'UC';";
                            $stmt=mysqli_stmt_init($conn);
        
                        if (!mysqli_stmt_prepare($stmt, $sql_count)){
                            header("location: index.php?error=stmtfailed");
                            exit();
                        }
                            
                            mysqli_stmt_execute($stmt);

                            $resultData = mysqli_stmt_get_result($stmt);

                            if($row = mysqli_fetch_assoc($resultData)){ ?>
                                <span style = "font-size:1.5rem;
                                                color:white;" class="badge bg-primary"><?php echo $row['cartcount']; ?></span>
                            <?php }
                        
                            ?>
                      </a>
												
											</div>
										</div>
										
									</div>
									

                  <div class="col-sm-3">
										<div class="card">
											<div class="card-body">
												<a href="feedback.php"><h5 class="card-title mb-4">Feedbacks</h5></a>
                        <?php 
                            $sql_count = "SELECT COUNT(*) cartcount FROM `feedback` WHERE fb_status = 'Unread';";
                            $stmt=mysqli_stmt_init($conn);
        
                        if (!mysqli_stmt_prepare($stmt, $sql_count)){
                            header("location: index.php?error=stmtfailed");
                            exit();
                        }
                            
                            mysqli_stmt_execute($stmt);

                            $resultData = mysqli_stmt_get_result($stmt);

                            if($row = mysqli_fetch_assoc($resultData)){ ?>
                                <span style = "font-size:1.5rem;
                                                color:white;" class="badge bg-primary"><?php echo $row['cartcount']; ?></span>
                            <?php }
                        
                            ?>
											</div>
										</div>
										
									</div>
									
                  <div class="col-sm-3">
										<div class="card">
											<div class="card-body">
												<a href="gen_report.php"><h5 class="card-title mb-4">Generated Report</h5>
                        <?php 
                            $sql_count = "SELECT COUNT(*) cartcount FROM `accountabilities` WHERE status = 'A' or status = 'D' ;";
                            $stmt=mysqli_stmt_init($conn);
        
                        if (!mysqli_stmt_prepare($stmt, $sql_count)){
                            header("location: index.php?error=stmtfailed");
                            exit();
                        }
                            
                            mysqli_stmt_execute($stmt);

                            $resultData = mysqli_stmt_get_result($stmt);

                            if($row = mysqli_fetch_assoc($resultData)){ ?>
                                <span style = "font-size:1.5rem;
                                                color:white;" class="badge bg-primary"><?php echo $row['cartcount']; ?></span>
                            <?php }
                        
                            ?>
                      
                      </a>
												
											</div>
										</div>
										
									</div>
									
								</div>
</div>
                      
      </div>


        </section>

			
      
<footer class="footer">
				<div class="container-fluid">
					<div class="row text-muted">
						<div class="col-6 text-left">
							<p class="mb-0">
								<a href="index.html" class="text-muted"><strong> BUPC CSC Accountability System </strong></a> &copy
							</p>
						</div>
						<div class="col-6 text-right">
							<ul class="list-inline">
								
								<li class="footer-item">
									<a class="text-muted" href="../footer/privacy.php">Privacy Policy</a>
								</li>
								<li class="footer-item">
									<a class="text-muted" href="../footer/terms.php">Terms of Service</a>
								</li>
							</ul>
						</div>
					</div>
				</div>
			</footer>
		
        <!-- /#page-content-wrapper -->

    </div>
    <!-- /#wrapper -->

   <?php    

}

else{
header("location: ../index.php");  
}
?>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
  
  <script src="https://code.jquery.com/jquery-3.5.1.js" integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc=" crossorigin="anonymous"></script>
    
  
 <script>
 
$('#bar').click(function(){
	$(this).toggleClass('open');
	$('#page-content-wrapper ,#sidebar-wrapper').toggleClass('toggled' );

});
  </script>
  </body>
</html>

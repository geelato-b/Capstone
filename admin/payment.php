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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" > 
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
    <title>Admin Dashboard: BUPC CSC Accountability System</title>
    <link rel="stylesheet" href="../css/dash.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" >
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" >
  </head>
  <body>
  <div id="wrapper">
   <div class="overlay"></div>
    
        <!-- Sidebar -->
        <nav class="fixed-top align-top" id="sidebar-wrapper" role="navigation">
       <div class="simplebar-content" style="padding: 0px;">
				<a class="sidebar-brand" href="index.php">
          <span class="align-middle">BUPC CSC Accountability System</span>
        </a>

	<ul class="navbar-nav align-self-stretch">
	 
      <li class="sidebar-header"></li>
	  <li class=""> 
      <a href="index.php" class="nav-link text-left"  role="button"><i class="bi bi-house-door"></i>Dashboard </a></li>

      <li class="has-sub">
        <a class="nav-link collapsed text-left" data-bs-toggle="collapse" data-bs-target="#dashboard-collapse" aria-expanded="false">
        <i class="bi bi-people-fill"></i>Student
        </a>
        <div class="collapse" id="dashboard-collapse">
            <div class="submenu-box">
            <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small">
            <li><a href="student_acc.php" class="nav-link text-left active">Student Account</a></li>
            <li><a href="student_info.php" class="nav-link text-left active">Student Information</a></li>
          </ul>
        </div>
        </div>
      </li>
		  <li><a href="payment.php" class="nav-link text-left active"  role="button"><i class="bi bi-cash-coin"></i>Payment</a></li>
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
           <!-- Topbar Navbar -->
          
           <div class="container-fluid">
           <div id="nav-alert">
                  <a href="index.php">BUPC CSC Accountability System</a>
              </div>
              
               <form class="d-flex">
               <div class="input-group mb-3">
               <input type="text" class="form-control bg-light " placeholder="Search for..." aria-label="Search">
               <button class="btn btn-primary" type="button">
               <i class="bi bi-search"></i>
               </button>
               </div>
               </form>

               <div>
                <img class="img-profile " src="../img/logo2.png" width="115px" height="105px">
                  <img class="img-profile" src="../img/logo1.png" width="100px" height="100px">
               </div>
               
             </div>
        </nav>
        <!-- End of Topbar -->
        <!-- Begin Page Content -->

        <section id="content">
            
                <div>
                        <div class="card-header">
                                    <h3 class="display-7">Pay Here</h3>
                          </div>
                          <div>
                          <?php if(isset($_GET['error'])) {
                              switch ($_GET['error']){
                                  case 1:
                                    echo "<p class='text-danger'> Item Exist</p>";
                                  break;
                                  case 2:
                                    echo "<p class='text-danger'>Adding Record Failed</p>";
                                  break;
                                  case 3:
                                    echo "<p class='text-danger'>Checking Item Failed</p>";
                                  break;
                                  case 0:
                                    echo "<p class='text-danger'> Item Has Been Added</p>";
                                  break;
                              }
                            }
                        ?>
                          
                          </div>
                                    
                               
                    <div class="card-body">
                        <div class="Payment">
                        <form action="../includes/addstat.php" method="post">
                                <br>
                                
                                    <input hidden type="text" name="status_id" class="form-control" >
                                
                                <div class="mb-3">
                                    <label for="TextInput" class="form-label">Student ID</label>
                                    <input type="text" name="stud_id" class="form-control" >
                                </div>

                                <div class="mb-3">
                                    <label for="TextInput" class="form-label">Name</label>
                                    <input type="text" name="stud_name" class="form-control" >
                                </div>

                                <div class="mb-3">
                                    <label for="TextInput" class="form-label">Program</label>
                                    <select name="stud_program" id="disabledSelect" class="form-select">
                                        <option values="BSIT">BS Information Technology</option>
                                        <option values="BSIT Animation">BS Information Technology Animation</option>
                                    </select>

                                </div>
                                <div class="mb-3">
                                    <label for="TextInput" class="form-label">Year & Block</label>
                                    <input type="text" name="stud_year_block" class="form-control" >
                                </div>
                                <div class="mb-3">
                                    <label for="TextInput" class="form-label">Gender</label>
                                    <select name="gender" id="disabledSelect" class="form-select">
                                        <option value="F">Female</option>
                                        <option value="M">Male</option>
                                    </select>
                                </div>

                                <div class="mb-3">
                                    <label for="TextInput" class="form-label">Accountability</label>
                                    <select name="accbty_id" id="" class="form-select">
                                    <?php
                                            $sql_acc = "SELECT `accbty_id`, `accbty_name` FROM `accountabilities`;";
                                            $result = mysqli_query($conn, $sql_acc);
                                            if(mysqli_num_rows($result) > 0){
                                                while($row = mysqli_fetch_assoc($result)){
                                                    echo "<option value='".$row['accbty_id']."'>".$row['accbty_name']."</option>";
                                                }
                                            }
                                        ?>
                                    </select>
                                </div>

                                <div class="mb-3">
                                    <label for="TextInput" class="form-label">Status</label>
                                    <select name="pay_status" id="disabledSelect" class="form-select">
                                        <option value="UP">Unpaid</option>
                                        <option value="P">Paid</option>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="TextInput" class="form-label">Payment Received By</label>
                                    <input type="text" name="pymt_rcv_by" class="form-control" >
                                </div>

                                <div class="mb-3">
                                    <label for="TextInput" class="form-label">Date</label>
                                    <input type="date" name="date" class="form-control" >
                                </div>

                                         <div class="card-footer">
                                            <button class="btn btn-primary"> <i class="bi bi-save"></i> Save </button>
                                          </div>
                                </div>
                        </form>
                        </div>
                    </div>
                </div>
        </section>	
        <!-- /#page-content-wrapper -->

    </div>

    <?php    

}

else{
header("location: ../index.php");  
}
?>

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
									<a class="text-muted" href="#">Contacts</a>
								</li>
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

    <!-- /#wrapper -->

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" ></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.min.js" ></script>
  
  
    
  
 <script>
 
$('#bar').click(function(){
	$(this).toggleClass('open');
	$('#page-content-wrapper ,#sidebar-wrapper').toggleClass('toggled' );

});
  </script>
  </body>
</html>

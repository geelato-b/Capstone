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
                <span class="align-middle">BUPC CSC AS</span>
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
      <li><a href="Gcash.php" class="nav-link text-left"  role="button"><i class="bi bi-currency-exchange"></i>Proof of Payment</a></li>
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
           <div>
               <a href="index.php"><img class="img-profile " src="../img/logo2.png" width="115px" height="105px"></a>
                  <a href="index.php"><img class="img-profile" src="../img/logo1.png" width="100px" height="100px"></a>
            </div>
               
              
               <form class="d-flex">
               <div class="input-group mb-3">
                <a class="btn btn-primary" href="status.php" role="button"><i class="bi bi-search"></i> Search</a>
               </div>
               </form>

               
             </div>
        </nav>
        <!-- End of Topbar -->
        <!-- Begin Page Content -->

        <section id="content">
            
                <div>
                        <div class="card-header">
                                    <h3 class="display-7">Pay Here</h3>
                          </div>
                          <div class="mb-3">
                      <?php
                    if (isset($_SESSION['status'])) {
                    ?>
                    <div class="container-sm">
                    <div class="alert alert-success" role="alert">
                      <i class="fas fa-check-circle"></i> <?php echo $_SESSION['status']; ?>
                    </div>
                     </div>
                     
                    <?php
                        
                        unset($_SESSION['status']);
                    }

                   ?>   
                <?php
                if (isset($_SESSION['status1'])) {
                  ?>
                      <div class="container-sm">
                    <div class="alert alert-warning" role="alert">
                      <i class="fas fa-exclamation-circle"></i> <?php echo $_SESSION['status1']; ?>
                    </div>
                     </div>
                      <?php
                      unset($_SESSION['status1']);
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
                                    <input type="text" name="stud_id" class="form-control" required="">
                                </div>

                                <div class="mb-3">
                                    <label for="TextInput" class="form-label">Name</label>
                                    <input type="text" name="stud_name" class="form-control" required="">
                                </div>

                                <div class="mb-3">
                                    <label for="TextInput" class="form-label">Program</label>
                                    <select name="stud_program" id="disabledSelect" class="form-select">
                                        <option values="BS Information Technology">BS Information Technology</option>
                                        <option values="BS Information Technology Animation">BS Information Technology Animation</option>
                                        <option values="BS in Computer Engineering">BS in Computer Engineering</option>
                                        <option values="BS in Computer Science">BS in Computer Science</option>
                                        <option values="BS in Mechanical Technology">BS in Mechanical Technology</option>
                                        <option values="BS in Automotive Technology">BS in Automotive Technology</option>
                                        <option values="BS in Electrical Technology">BS in Electrical Technology</option>
                                        <option values="BS in Food Technology">BS in Food Technology</option>
                                        <option values="Bachelor of Science in Nursing">Bachelor of Science in Nursing</option>
                                        <option values="Bachelor of Tech and Livelihood Education">Bachelor of Tech and Livelihood Education</option>
                                    </select>

                                </div>
                                <div class="mb-3">
                                    <label for="TextInput" class="form-label" >Year & Block</label>
                                    <input type="text" placeholder= "Ex: 1A, 2B, 3C" name="stud_year_block" class="form-control" required="">
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
                                            $sql_acc = "SELECT `accbty_id`, `accbty_name`, `accbty_deadline` FROM `accountabilities` Where status = 'A';";
                                            $result = mysqli_query($conn, $sql_acc);
                                            if(mysqli_num_rows($result) > 0){
                                                while($row = mysqli_fetch_assoc($result)){
                                                    echo "<option value='".$row['accbty_id']." '>".$row['accbty_name']. " </option>";
                                                }
                                            }
                                        ?>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="TextInput" class="form-label">Amount</label>
                                    <input type="text" name="accbty_price" class="form-control" required="">
                                </div>

                            
                                <div class="mb-3">
                                    <label for="TextInput" class="form-label">Payment Received By</label>
                                    <input type="text" name="pymt_rcv_by" class="form-control" required="">
                                </div>

                                

                                         <div class="card-footer">
                                            <!-- <button class="btn btn-primary"> <i class="bi bi-save"></i> Save </button> -->
                                            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                                              <i class="bi bi-save"></i> Save 
                                            </button>
                                          </div>
                                          <!-- Button trigger modal -->


<!-- Modal -->
                                  <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                      <div class="modal-content">
                                        <div class="modal-header">
                                          <h5 class="modal-title" id="staticBackdropLabel"><i class="bi bi-save"></i> Save</h5>
                                          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                          Are you sure?
                                        </div>
                                        <div class="modal-footer">
                                          <button name="pay_status" type="submit"  class="btn btn-primary" >Yes</button>
                                          <button  class="btn btn-outline-danger" data-bs-dismiss="modal" type="button">No</button>
                                        </div>
                                      </div>
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

<?php
session_start();
include_once "../includes/db_conn.php";
include_once "../includes/func.inc.php";   
$status_logged_in = null;
if(isset($_SESSION['usertype']) && isset($_SESSION['stud_id']) ){
    $status_logged_in = array('status' => true, 'usertype' => $_SESSION['usertype'] );
    
    $STUD_ID = $_SESSION['stud_id'];
    $student_info = GetUserDetails($conn, $STUD_ID );
}
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
      <a href="index.php" class="nav-link text-left active"  role="button"><i class="bi bi-house-door"></i>Dashboard </a></li>

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
		  <li><a href="" class="nav-link text-left"  role="button"><i class="bi bi-cash-coin"></i>Payment</a></li>
          <li><a href="" class="nav-link text-left"  role="button"><i class="bi bi-person-lines-fill"></i>Status</a></li>
          <li><a href="update.php" class="nav-link text-left"  role="button"><i class="bi bi-journal-check"></i>Update</a></li>
          <li><a href="" class="nav-link text-left"  role="button"><i class="bi bi-gear-fill"></i>Setting</a></li>
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
          <!-- Topbar Search -->
          <form class="d-none d-sm-inline-block form-inline navbar-search" style="align-items: flex-end;">
            <div class="input-group">
              <input type="text" class="form-control bg-light " placeholder="Search for..." aria-label="Search">
              <div class="input-group-append">
                <button class="btn btn-primary" type="button">
                <i class="bi bi-search"></i>
                </button>
              </div>
            </div>
          </form>
        </nav>
        <!-- End of Topbar -->
        <!-- Begin Page Content -->

        <section>
            
                <div >
                    <div class="card card-body">
                        <div class="Payment">
                        <form>
                            <h3>Pay Here</h3>
                                <br>
                                <div class="mb-3">
                                    <label for="TextInput" class="form-label">Name</label>
                                    <input type="text" name="" class="form-control" >
                                </div>
                                <div class="mb-3">
                                    <label for="TextInput" class="form-label">Program</label>
                                    <select id="disabledSelect" class="form-select">
                                        <option>BS Information Technology</option>
                                        <option>BS Information Technology Animation</option>
                                    </select>

                                </div>
                                <div class="mb-3">
                                    <label for="TextInput" class="form-label">Year & Block</label>
                                    <input type="text" name="" class="form-control" >
                                </div>
                                <div class="mb-3">
                                    <label for="TextInput" class="form-label">Gender</label>
                                    <select id="disabledSelect" class="form-select">
                                        <option value="F">Female</option>
                                        <option value="M">Male</option>
                                    </select>
                                </div>

                                <div class="mb-3">
                                    <label for="TextInput" class="form-label">Accountability</label>
                                    <select id="disabledSelect" class="form-select">
                                        <option value="">

                                        </option>
                                    </select>
                                </div>

                                <div class="mb-3">
                                    <label for="TextInput" class="form-label">Status</label>
                                    <select id="disabledSelect" class="form-select">
                                        <option value="UP">Unpaid</option>
                                        <option value="P">Paid</option>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="TextInput" class="form-label">Payment Received By</label>
                                    <input type="text" name="" class="form-control" >
                                </div>

                                <div class="mb-3">
                                    <label for="TextInput" class="form-label">Date</label>
                                    <input type="date" name="" class="form-control" >
                                </div>


                                <button type="submit" class="btn btn-primary">Submit</button>
                                </div>
                        </form>
                        </div>
                    </div>
                </div>
        </section>	
        <!-- /#page-content-wrapper -->

    </div>
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
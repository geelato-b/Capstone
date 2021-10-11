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
        <span class="align-middle">BUPC CSC AS</span>
        </a>

        <ul class="navbar-nav align-self-stretch">
	 
   <li class="sidebar-header"></li>
   <li class=""> 
   <a href="index.php" class="nav-link text-left "  role="button"><i class="bi bi-house-door"></i>Home </a></li>
   <li class=""><a href="index.php" class="nav-link text-left "  role="button"><i class="bi bi-list"></i>Accountability
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
 
 </a></li>

   <li><a href="status.php" class="nav-link text-left"  role="button"><i class="bi bi-person-lines-fill"></i>Status
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
 </a></li>
   <li><a href="e-payment.php" class="nav-link text-left active"  role="button"><i class="bi bi-cash-coin"></i>Proof of Payment
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
 
 </a></li>
   <li><a href="setting.php" class="nav-link text-left"  role="button"><i class="bi bi-gear-fill"></i>Setting</a></li>
   <li><a href="about.php" class="nav-link text-left"  role="button"><i class="bi bi-book-half"></i>About Us</a></li>
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
          <form class="d-flex">
               <div class="input-group mb-3">
                <h1>List of Accountabilities</h1>
               </div>

               </form>
            <div>
               <a href="index.php"><img class="img-profile " src="../img/logo2.png" width="115px" height="105px"></a>
                  <a href="index.php"><img class="img-profile" src="../img/logo1.png" width="100px" height="100px"></a>
            </div>
               
            

             </div>
        </nav>
        <!-- End of Topbar -->
        <!-- Begin Page Content -->

       
              

        <section id="content" >
            <div class="main__container" style="margin-top:2rem;">
             <div class="container__fluid"> 
                    <div class="row" id="contentPanel">
                    <div class="col-12">
                        <?php
                                            $sql =" SELECT 
                                                        `accbty_id`
                                                        , `accbty_name`
                                                        , `accbty_desc`
                                                        , `accbty_price`
                                                        , `accbty_deadline`
                                                        , `status`
                                                        FROM `accountabilities`
                                                        Where status = 'A';";
                            $stmt=mysqli_stmt_init($conn);
                            if (!mysqli_stmt_prepare($stmt, $sql)){
                                header("location: ?error=failedcheckout");
                                exit();
                                }
                                mysqli_stmt_execute($stmt);
            
                                $resultData = mysqli_stmt_get_result($stmt); ?>
                            <div class="container">
                                <div class="row">
                                    <table class="table table-hover" style="box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
                                                                            border-radius: 10px;">
                                                <thead>
                                                    <th>Name</th>
                                                    <th>Description</th>
                                                    <th>Amount</th>
                                                    <th>Deadline</th>
                                                    <th></th>
                                                </thead>
                                            <?php while($row = mysqli_fetch_assoc($resultData)){ ?>
                                                <tr>
                                                    
                                                    <td><?php echo $row['accbty_name']; ?></td>
                                                    <td><?php echo $row['accbty_desc']; ?></td>
                                                    <td> Php <?php  echo number_format($row['accbty_price'],2); ?> </td> 
                                                    <td><?php echo $row['accbty_deadline']; ?></td>
                                                    
                                                </tr>
                                            <?php }?>
                                    </table> 
                            </div>
                        </div>
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

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
    <title>Student: BUPC CSC Accountability System</title>
    <link rel="stylesheet" href="../css/dash.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" >
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" >
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css">

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
      <a href="index.php" class="nav-link text-left "  role="button"><i class="bi bi-house-door"></i>Home </a></li>
      <li><a href="status.php" class="nav-link text-left"  role="button"><i class="bi bi-person-lines-fill"></i>Status</a></li>
      <li><a href="e-payment.php" class="nav-link text-left active"  role="button"><i class="bi bi-cash-coin"></i>G-Cash</a></li>
      <li><a href="" class="nav-link text-left"  role="button"><i class="bi bi-gear-fill"></i>Setting</a></li>
      <li><a href="" class="nav-link text-left"  role="button"><i class="bi bi-book-half"></i>About Us</a></li>
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
                <h1>Status</h1>
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

    
        <section >
            <div class="main__container" style="margin-top:2rem;">
             <div class="container__fluid"> 
                    <div class="row" id="contentPanel">
                    <div class="col-12">
                        <?php
                                            $sql =" SELECT `status_id`
                                            , s.stud_id
                                            , s.stud_name
                                            , s.stud_program
                                            , s.stud_year_block
                                            , s.gender
                                            , s.accbty_id
                                            , s.pymt_rcv_by
                                            , s.pay_status
                                            , s.date
                                            , a.accbty_name
                                            , a.accbty_desc
                                            , a.accbty_price
                                            , a.accbty_deadline
                                            FROM `status` s
                                            JOIN `accountabilities` a
                                            ON s.accbty_id = a.accbty_id
                                            WHERE s.stud_id = ?;";
                            $stmt=mysqli_stmt_init($conn);
                            if (!mysqli_stmt_prepare($stmt, $sql)){
                                header("location: ?error=failedcheckout");
                                exit();
                                }
                                mysqli_stmt_bind_param($stmt, "s" , $STUD_ID);
                                mysqli_stmt_execute($stmt);

                                $resultData = mysqli_stmt_get_result($stmt); ?>
                            <div class="container">
                                <div class="row">
                                <table class="table table-hover" style="box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
                                                                            border-radius: 10px;">
                                                <thead>
                                                    <th>ID Number</th>
                                                    <th>Name</th>
                                                    <th>Program</th>
                                                    <th>Year & Block</th>
                                                    <th>Gender</th>
                                                    <th>Accountability</th>
                                                    <th>Amount</th>
                                                    <th>Payment Received By</th>
                                                    <th>Status</th>
                                                    <th>Date</th>
                                                </thead>

                                            <?php while($row = mysqli_fetch_assoc($resultData)){ ?>
                                                <tr>
                                                    <td><?php echo $row['stud_id']; ?></td>
                                                    <td><?php echo $row['stud_name']; ?></td>
                                                    <td><?php echo $row['stud_program'];?></td>
                                                    <td><?php echo $row['stud_year_block'];?></td>
                                                    <td><?php echo $row['gender'];?></td>
                                                    <td><?php echo $row['accbty_name'];?></td>
                                                    <td><?php echo $row['accbty_price'];?></td>
                                                    <td><?php echo $row['pymt_rcv_by'];?></td>
                                                    <td><?php echo $row['pay_status'];?></td>
                                                    <td><?php echo $row['date'];?></td>

                                                    
                                                </tr>
                                            <?php }?>
                                    </table> 
                                  </div>
                                </div>
                            </div>
                          </div>
             </div>
           </div>
          </div>    

        </section>
        <?php    

}

else{
header("location: ../index.php");  
}
?>
      
        <!-- /#page-content-wrapper -->

    </div>
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
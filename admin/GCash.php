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
          <!-- Topbar Navbar -->
          
          <div class="container-fluid">
               
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

        <section >
            <div class="card-header">
                <h3 class="display-7">GCash Confirmation</h3>
        </div>
            <div class="main__container" style="margin-top:2rem;">
             <div class="container__fluid"> 
                    <div class="row" id="contentPanel">
                    <div class="col-12">
                        <?php
                                            $sql =" SELECT `gcash_id`
                                                            , `stud_id`
                                                            , `stud_name`
                                                            , `bu_email`
                                                            , `date_time`
                                                            , `img`
                                                            , `gc_status`
                                                            , `status` 
                                                            FROM `gcash` 
                                                            WHERE gc_status = 'UC' 
                                                            OR `status`  = 'N' ;";
                            $stmt=mysqli_stmt_init($conn);
                            if (!mysqli_stmt_prepare($stmt, $sql)){
                                header("location: GCash.php?error");
                                exit();
                                }
                                mysqli_stmt_execute($stmt);
            
                                $resultData = mysqli_stmt_get_result($stmt); 

                                $arr=array();

                                while($row = mysqli_fetch_assoc($resultData)){

                                    array_push($arr,$row);
                                }
                                    if(!empty($arr)){

                                    ?>
<section id="gcash">
    <div class="container">
        <?php
        foreach($arr as $key => $val){
        ?>

        <div class="slider">
            <div class="card item">
                <div class="image">
                    <img src="../img/<?php echo $val['img'] ?>" alt="1 x 1" class="card-img-top">
                </div>
                <div class="card-body">
                    <h5 class="card-title"><a href="../img"><?php echo $val['img']; ?></a></h5>
                    <p class="card-text">
                        <h6><?php echo $val['stud_id']?></h6>
                        <h5><?php echo $val['stud_name']?></h5>
                    </p>
                </div>

                    <div class="card-footer">
                     <form action="../includes/update_stat.php" method="post">
                            <input hidden type="text" name="gcash_id" value="<?php echo $row['gcash_id']; ?>">
                            <input type="" name="confirm_status" value="<?php echo $row['gc_status'] == 'UC' ? 'C' : 'UC' ; ?>">
                            <p class="lead"><?php echo $row['gc_status'] == 'UC' ? 'For Confirmation' : 'Confirmed' ; ?></p>
                            <button class="btn btn-primary"> <?php echo $row['gc_status'] == 'UC' ? 'Confirm' : 'Unconfirm' ; ?> </button>
                    </form>
                    </div>
            </div>
        </div>

                    <?php
                        }
                    }
                
                        ?>
    </div>
</section>
                                                                        
                                

                      
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
  
    <?php    

}

else{
header("location: ../index.php");  
}
?>

    
  
 <script>
 
$('#bar').click(function(){
	$(this).toggleClass('open');
	$('#page-content-wrapper ,#sidebar-wrapper').toggleClass('toggled' );

});
  </script>
  </body>
</html>

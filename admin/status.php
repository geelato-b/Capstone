<?php
session_start();
include_once "../includes/db_conn.php";
include_once "../includes/func.inc.php";   
$status_logged_in = null;
if(isset($_SESSION['user_type']) && isset($_SESSION['stud_id']) ){
    $status_logged_in = array('status' => true, 'user_type' => $_SESSION['user_type'] );
    
    $STUD_ID = $_SESSION['stud_id'];
    $student_info = GetUserDetails($conn, $STUD_ID );
$searchkey="";
if(isset($_GET['searchkey'])){
  $searchkey = htmlentities($_GET['searchkey']);

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

		  <li><a href="payment.php" class="nav-link text-left"  role="button"><i class="bi bi-cash-coin"></i>Payment</a></li>
      <li><a href="Gcash.php" class="nav-link text-left"  role="button"><i class="bi bi-currency-exchange"></i>Proof of Payment</a></li>
          <li><a href="status.php" class="nav-link text-left active"  role="button"><i class="bi bi-person-lines-fill"></i>Status</a></li>
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

                <form action="status.php" method="GET">
               <div class="input-group mb-3">
               <input type="text" id="searchbar" name="searchkey" class="form-control bg-light " placeholder="Search for..." aria-label="Search">
               <button class="btn btn-primary" type="button">
               <i class="bi bi-search"></i>
               </button>

               </div>
                </form>

               </form>

          </div>
        </nav>
        <!-- End of Topbar -->
        <!-- Begin Page Content -->

        <section>
        
          <!-- <ul class="list-group list-group-horizontal">
           <li class="list-group-item list-group-item-primary"><a href="status.php"><i class="fas fa-redo-alt"></i> Refresh</a></li>
           <li class="list-group-item list-group-item-primary"><a href="payment.php"><i class="bi bi-cash-coin"></i> Payment</a></li>
          </ul> -->
          <div class="btn-toolbar justify-content-between" role="toolbar" aria-label="Toolbar with button groups">
  <div class="btn-group" role="group" aria-label="First group">
    &nbsp<a href="status.php"><button type="button" class="btn btn-secondary"><i class="fas fa-redo-alt"></i> Refresh</button></a>
    

  </div>
  <div class="input-group">
    <div  id="btnGroupAddon2">
      &nbsp<a href="payment.php"><button type="button" class="btn btn-primary"><i class="bi bi-cash-coin"></i> Payment</button></a>
         <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#search">
                <i class="fas fa-info-circle"></i> </a>
          </button>
        </div>
  </div>
</div>
          
          
<!-- Modal -->
                    <div class="modal fade" id="search" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                      <div class="modal-dialog">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel"><b>Reminder</b></h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                          </div>
                          <div class="modal-body">
                            When using the search bar, please <u>enter the complete word</u>.<br><br>
                            It doesn't accept incomplete, copy-paste, and autocomplete words.
                          </div>
                          <div class="modal-footer">
                            <button type="button" class="btn btn-outline-primary" data-bs-dismiss="modal">Continue</button>
                           <!--  <a href="status.php"><button type="button" class="btn btn-primary"></button></a> -->
                          </div>
                        </div>
                      </div>
                    </div>
            <div class="main__container" style="margin-top:2rem;">
             <div class="container__fluid"> 
                    <div class="row" id="contentPanel">
                    <div class="col-12">
                        <?php
                        if ($searchkey == "") {
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
                                            WHERE s.pay_status = 'P' ;";

                                            $stmt=mysqli_stmt_init($conn);
                                            //prepare the statement
                                            if (!mysqli_stmt_prepare($stmt, $sql)){
                                            echo "Statement Failed.";
                                            exit();
                                            }
                        }
                        else{
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
                                            WHERE s.stud_id = ? 
                                            OR s.stud_name = ?
                                            OR s.stud_program = ?;";
                            $stmt=mysqli_stmt_init($conn);
                            if (!mysqli_stmt_prepare($stmt, $sql)){
                              header("location: status.php?error");
                               echo "Statement Failed. Record Not Found.";
                                exit();
                                }
                            mysqli_stmt_bind_param($stmt, "sss" , $searchkey , $searchkey , $searchkey);

                        }
                                mysqli_stmt_execute($stmt);
            
                                $resultData = mysqli_stmt_get_result($stmt); 
                                $arr=array();
                                while($row = mysqli_fetch_assoc($resultData)){ 
                                  array_push($arr,$row);
                                }
                                if(!empty($arr)){
                      ?>
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
                                                    <th>Received By</th>
                                                    <th>Status</th>
                                                    <th>Date</th>
                                                </thead>
                                            <?php foreach($arr as $key => $row){ ?>

                                                <tr>
                                                  
                                                    <td><?php echo $row['stud_id']; ?></td>
                                                    <td><?php echo $row['stud_name']; ?></td>
                                                    <td><?php echo $row['stud_program'];?></td>
                                                    <td><?php echo $row['stud_year_block'];?></td>
                                                    <td><?php echo $row['gender'];?></td>
                                                    <td><?php echo $row['accbty_name'];?></td>
                                                    <td><?php echo $row['accbty_price'];?></td>
                                                    <td><?php echo $row['pymt_rcv_by'];?></td>
                                                    <td><?php echo $row['pay_status']== 'P' ? 'Paid' : 'UnPaid' ; ;?></td>
                                                    <td><?php echo $row['date'];?></td>

                                                    
                                                </tr>
                                            <?php } ?>
                                    </table> 
                                   
                            </div>
                        </div>
                        <?php }

                        else{
                            echo "<h4>&nbsp No Records Found.</h4>";
                          }
                        ?>
             </div>
           </div>
          </div>          
        </section>
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
<?php
session_start();
include_once "../includes/db_conn.php";
include_once "../includes/func.inc.php"; 
include_once "../includes/utilities.inc.php";  
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
                <span class="align-middle">BUPC CSC AS</span>
        </a>

	<ul class="navbar-nav align-self-stretch">
	 
      <li class="sidebar-header"></li>
	  <li class=""> 
      <a href="index.php" class="nav-link text-left"  role="button"><i class="bi bi-house-door"></i>Dashboard </a></li>

      <li class="has-sub">
        <a class="nav-link collapsed text-left active" data-bs-toggle="collapse" data-bs-target="#dashboard-collapse" aria-expanded="false">
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
                    <div>
                    <a href="index.php"><img class="img-profile " src="../img/logo2.png" width="115px" height="105px"></a>
                        <a href="index.php"><img class="img-profile" src="../img/logo1.png" width="100px" height="100px"></a>
                    </div>
                    
                    
                    <form class="d-flex">
                    <div class="input-group mb-3">
                    
                    </div>
                    </form>
                
              </div>
            

        </nav>
        <!-- End of Topbar -->
        <!-- Begin Page Content -->

    <section>
            <div class="main__container" style="margin-top:2rem;">
             <div class="container__fluid"> 
            <div class="row" id="contentPanel">
                   
            <div class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
                
                <div class="list-group">
                    <a href="?cat=all&cat_n=All Category" class="list-group-item list-group-item-action">All</a>
                    <?php $category_list = getCategories($conn);
                                        if(!empty($category_list)){
                                            foreach($category_list as $catKey => $cat){ ?>
                    <a href="?cat=<?php echo $cat['accbty_id'];?>&cat_n=<?php echo $cat['accbty_name'];?>" class="list-group-item list-group-item-action">
                        <?php echo $cat['accbty_name'];?>
                        <br>
                        <?php echo $cat['accbty_deadline'];?>
                    </a>
                    <?php   
                                           }
                                            
                                        }
                                        else{ ?>
                    <li class="list-group-item">
                        No Categories
                    </li>
                    <?php }                    
                    ?>
                </div>
            </div>

            
            <div class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
              

                <?php
                 
      if(isset($_GET['cat'])){ //sales for category
                $catid=htmlentities($_GET['cat']);
                if($catid !== 'all'){ ?>

                <h3><?php echo htmlentities($_GET['cat_n'] === NULL ? '' : $_GET['cat_n']);?></h3>

                <?php $catSales = getSalesPerfCat($conn, $catid); 
                    if(!empty($catSales)){ //sales not empty
                ?>
                <table class="table table-responsive">
                    <thead>
                        <th>Transction Date</th>
                        <th>Student Name</th>
                        <th>Amount</th>
                    </thead>
                    <?php foreach($catSales as $k => $cs){ ?>
                    <tr>
                        <td><?php echo $cs['date'] ?></td>
                        <td><?php echo $cs['stud_name'] ?></td>
                        <td>Php <?php echo number_format($cs['accbty_price'],2) ?></td>
                    </tr>

                    <?php } ?>
                </table>
                <?php
                    } //sales not empty
                    else{ ?>
                <p class="lead">No Sales</p>
                <?php }
                }
                else{ ?>
                <h3><?php echo htmlentities($_GET['cat_n'] === NULL ? '' : $_GET['cat_n']);?>
                   
                </h3>
                <?php $categ = query($conn, "SELECT * FROM `accountabilities`; "); ?>
                <div class="container-fluid">
                    <div class="row align-items-start">

                        <?php foreach($categ as $k => $c){
                        $tot_cat_sale = 0.00;?>

                        <div class="col-lg-5 mb-4">
                            <div class="card">
                                <div class="card-header">
                                    <h3 style="font-weight:bolder; font-size:1.5rem; class="card-title"><?php echo $c['accbty_name'];?></h3>
                                    <h3 style="font-weight:bolder; color:black; font-size:1rem;" class="card-title"><?php echo $c['accbty_deadline'];?></h3>
                                </div>
                                <div class="card-body">
                                    <div class="list-group">
                                        <?php $item_categ = query($conn, "SELECT * FROM `accountabilities` WHERE accbty_id = ?; ", array($c['accbty_id']));
                                    foreach($item_categ as $x => $ic){ ?>
                                        <span class="list-group-item">
                                            <?php
                                    $item_sale =  query($conn, "SELECT sum(s.accbty_price) total_ordered  
                                                                        ,a.accbty_deadline
                                                                        FROM `status` s 
                                                                        JOIN `accountabilities` a 
                                                                        on (a.accbty_id = s.accbty_id)
                                                                         WHERE s.accbty_id = ? 
                                                                         and s.pay_status = 'P'
                                                                         ; ", 
                                    array($ic['accbty_id'])); 
                                    
                                    foreach($item_sale as $s => $sale){    ?>
                                            <span style="font-size:3rem;" class="float-end <?php echo $sale['total_ordered'] <= 0.00 ? 'text-danger' : 'text-danger';?>">Php <?php echo number_format( $sale['total_ordered'],2 ); ?></span>
                                            <?php
                                                                      } ?>
                                        </span>
                                        <?php }
                                                                      
                                    ?>
                                    </div>
                                </div>
                                


                            </div>
                        </div>

                        <?php } ?>
                    </div>
                </div>

                <?php }
                
                
                
            }
                ?>

            </div>
        </div>

    </div>



</body>
<?php mysqli_close($conn);?>
<script src="../js/bootstrap.min.js"></script>

</html>

                        
                    </div>
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
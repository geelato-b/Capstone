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
      <li><a href="Gcash.php" class="nav-link text-left"  role="button"><i class="bi bi-currency-exchange"></i>Gcash</a></li>
          <li><a href="status.php" class="nav-link text-left"  role="button"><i class="bi bi-person-lines-fill"></i>Status</a></li>
          <li><a href="update.php" class="nav-link text-left active"  role="button"><i class="bi bi-journal-check"></i>Update</a></li>
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
               <input type="text" id="searchbar" name="searchkey"class="form-control bg-light " placeholder="Search for..." aria-label="Search">
               <button class="btn btn-primary" type="button">
               <i class="bi bi-search"></i>
               </button>
               </div>
               </form>

             </div>
        </nav>
        <!-- End of Topbar -->
        <!-- Begin Page Content -->

        <section>
          <a href="update.php" class="list-group-item list-group-item-action"><i class="fas fa-redo-alt"></i> Refresh</a>
            <nav class="navbar sticky-top navbar-light">

                <div class="container-fluid">
                        <p>
                            <a class="btn btn-primary" data-bs-toggle="collapse" href="#AddAcctbl" role="button" aria-expanded="false" aria-controls="collapseExample">
                            <i class="bi bi-plus-circle"></i> Accountability
                            </a>
                        </p>
                                      
                </div>
            </nav>
                <div class="row mx-3">
                    <div class="col-3"></div>
                    <div class="col-6">
                    
                        
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
                        <div class="collapse" id="AddAcctbl" class="card collapse mt-3 shadow">
                          <div class="card-header">
                              <h3 class="display-7">Add New Item</h3>
                          </div>

                            <div class="card-body">
                                <div class="AddAcctbl">
                                <form action="../includes/AddAcc.php" method="post">
                                        <div class="mb-3">
                                            <label for="TextInput" class="form-label">Accountability Name</label>
                                            <input type="text" name="accbty_name" id="accbty_name" class="form-control" required="">
                                        </div>
                                        
                                        <div class="mb-3">
                                            <label for="TextInput" class="form-label">Amount</label>
                                            <input type="number" name="accbty_price" id="accbty_price" class="form-control" required="" >
                                        </div>

                                        <div class="mb-3">
                                            <label for="TextInput" class="form-label">Deadline</label>
                                            <input type="date" name="accbty_deadline" id="accbty_deadline" class="form-control" required="">
                                        </div>

                                        <div class="mb-3">
                                            <label for="TextInput" class="form-label">Accountability Description</label>
                                            <select name="accbty_desc" id="accbty_desc" class="form-select">
                                                <option value="Mandatory">Mandatory</option>
                                                <option value="Optional">Optional</option>
                                            </select>
                                            
                                        </div>
                                          <div class="card-footer">
                                            <button class="btn btn-primary"> <i class="bi bi-save"></i> Update </button>
                                          </div>

                                        </div>
                                </form>
                                </div>
                            </div>
                        </div>
                    </div>
                
                </div>
                
        </section>

        <section id="content" >

            <div class="main__container" style="margin-top:2rem;">
             <div class="container__fluid"> 
                    <div class="row" id="contentPanel">
                    <div class="col-12">
                        <?php
                        if ($searchkey == "") {
                           $sql =" SELECT 
                                                        `accbty_id`
                                                        , `accbty_name`
                                                        , `accbty_desc`
                                                        , `accbty_price`
                                                        , `accbty_deadline`
                                                        , `status`
                                                        FROM `accountabilities`
                                                        WHERE status = 'A';";

                                            $stmt=mysqli_stmt_init($conn);
                                            //prepare the statement
                                            if (!mysqli_stmt_prepare($stmt, $sql)){
                                            echo "Statement Failed.";
                                            exit();
                                            }
                        }
                        else{
                            $sql =" SELECT 
                                                        `accbty_id`
                                                        , `accbty_name`
                                                        , `accbty_desc`
                                                        , `accbty_price`
                                                        , `accbty_deadline`
                                                        , `status`
                                                        FROM `accountabilities`
                                                        WHERE status = 'A'
                                                        AND `accbty_name` = ?
                                                        OR `accbty_desc` = ?
                                                        OR `accbty_deadline` = ?;";

                                $stmt=mysqli_stmt_init($conn);
                               if (!mysqli_stmt_prepare($stmt, $sql)){
                               header("location: update.php?error");
                               echo "Connection Failed. Record Not Found.";
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
                                if(!empty($arr)){ ?>
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
                                            <?php foreach($arr as $key => $row){ ?>
                                                <tr>
                                                    
                                                    <td><?php echo $row['accbty_name']; ?></td>
                                                    <td><?php echo $row['accbty_desc']; ?></td>
                                                    <td> Php <?php  echo number_format($row['accbty_price'],2); ?> </td> 
                                                    <td><?php echo $row['accbty_deadline']; ?></td>
                                                    <td>
                                                    <form action="../includes/del_accbty.php" method="post">
                                                                <input hidden type="text" name="accbty_id" value="<?php echo $row['accbty_id']; ?>">
                                                                <input hidden type="text" name="accbty_name" value="<?php echo $row['accbty_name']; ?>">
                                                                <input type="hidden" name="new_stat" value="<?php echo $row['status'] == 'A' ? 'D' : 'A' ; ?>">
                                                                <button class="btn btn-primary"> <?php echo $row['status'] == 'A' ? 'Deactivate' : 'Activate' ; ?> </button>
                                                    </form>
                                                  
                                                    </td>
                                                </tr>
                                            <?php }?>
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

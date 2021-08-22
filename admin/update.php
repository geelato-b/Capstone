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

        <section>
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

                        <div class="collapse" id="AddAcctbl" class="card collapse mt-3 shadow">
                          <div class="card-header">
                              <h3 class="display-7">Add New Item</h3>
                          </div>

                            <div class="card-body">
                                <div class="AddAcctbl">
                                <form action="../includes/AddAcc.php" method="post">
                                        <div class="mb-3">
                                            <label for="TextInput" class="form-label">Accountability Name</label>
                                            <input type="text" name="accbty_name" id="accbty_name" class="form-control" >
                                        </div>
                                        
                                        <div class="mb-3">
                                            <label for="TextInput" class="form-label">Amount</label>
                                            <input type="number" name="accbty_price" id="accbty_price" class="form-control" >
                                        </div>

                                        <div class="mb-3">
                                            <label for="TextInput" class="form-label">Deadline</label>
                                            <input type="date" name="accbty_deadline" id="accbty_deadline" class="form-control" >
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
                                            $sql =" SELECT 
                                                        `Accbty_id`
                                                        , `accbty_name`
                                                        , `accbty_desc`
                                                        , `accbty_price`
                                                        , `accbty_deadline`
                                                        FROM `accountabilities`;";
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
                                                    <td>
                                                      <form action="../includes/del_accbty.php" method="get">
                                                              <input hidden type="text" name="Accbty_id" value="<?php echo $row['Accbty_id']; ?>" >
                                                              <button type="submit" class="btn btn-danger"><i class="fas fa-trash-alt"></i></i> </button>
                                                      </form>
                                                    </td>
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

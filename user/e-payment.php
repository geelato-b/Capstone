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
    <title>Proof of Payment: BUPC CSC Accountability System</title>
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
                <h1>Proof of Payment</h1>
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
                            &nbsp
                            <a class="btn btn-primary" data-bs-toggle="collapse" href="#AddGCASH" role="button" aria-expanded="false" aria-controls="collapseExample">
                            <i class="bi bi-plus-circle"></i> Proof of Payment
                            </a>
                            &nbsp
                            <a class="btn btn-primary" data-bs-toggle="collapse" href="#History" role="button" aria-expanded="false" aria-controls="collapseExample">
                            <i class="bi bi-save"></i> Upload History
                            </a>
                        </p>
                                  
                </div>
            </nav>
          <?php
                    if (isset($_SESSION['status'])) {
                    ?>
                    <div class="container-sm">
                    <div class="alert alert-success" role="alert">
                      <i class="fas fa-check-circle"></i><?php echo $_SESSION['status']; ?>
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
                   
          <div class="collapse" id="AddGCASH" class="card collapse mt-3 shadow">
                          <div class="card-header">
                              <h3 class="display-7">&nbsp Upload Receipt</h3>
                          </div>

                            <div class="card-body">
                                <div class="AddAcctbl">
                                <form action="../includes/AddSS.php" method="post" enctype="multipart/form-data">
                                        <div class="mb-3">
                                            <label hidden for="disabledTextInput" class="form-label">Student ID</label>
                                            <input hidden type="text" id="stud_id" name="stud_id" class="form-control"  value="<?php echo $_SESSION['stud_id'];?>">
                                        </div>
                                        <div class="mb-3">
                                            <label hidden for="disabledTextInput" class="form-label">Student FullName</label>
                                            <input hidden type="text" id="stud_name" name="stud_name" class="form-control"  value="<?php echo  $student_info['stud_name'];?>">
                                        </div>
                                        <div class="mb-3">
                                            <label hidden for="disabledTextInput" class="form-label">BU Email</label>
                                            <input hidden type="text" id="bu_email" name="bu_email" class="form-control"  value="<?php echo  $student_info['bu_email'];?>">
                                        </div>
                                        <div class="mb-3">
                                            <label for="TextInput" class="form-label">Accountability Name</label>
                                            <input type="text" name="accbty_name" id="accbty_name" class="form-control" placeholder="Ex. CSC Fee, T-Shirt" required="" >
                                        </div>
                                        
                                        <div class="mb-3">
                                            <label for="" class="form-label">Image</label>
                                            <input name="itemimagefile" type="file" class="form-control" required="">
                                        </div>

                                          <!-- <div class="card-footer">
                                            <button class="btn btn-primary" name="AddSS" type="submit"> <i class="bi bi-save"></i> Upload </button>
                                          </div> -->
                                          <div class="card-footer">
                                            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                                              <i class="bi bi-save"></i> Upload
                                            </button>
                                          </div>
                                          <!-- Button trigger modal -->


<!-- Modal -->
                                  <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                      <div class="modal-content">
                                        <div class="modal-header">
                                          <h5 class="modal-title" id="staticBackdropLabel"><b>Confirmation</b></h5>
                                          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                          Are you sure?
                                        </div>
                                        <div class="modal-footer">
                                          <button name="AddSS" type="submit"  class="btn btn-primary" >Yes</button>
                                          <button  class="btn btn-outline-danger" data-bs-dismiss="modal" type="button">No</button>
                                        </div>
                                      </div>
                                    </div>
                                  </div>

                                        </div>
                                </form>
                                </div>
                            </div>
                        </div>
                    </div>
                
                </div>
                
                <div class="collapse" id="History" class="card collapse mt-3 shadow">
                  <div class="card-header">
                              <h3 class="display-7"> &nbsp Upload History :</h3>
                  </div>

                  <div class="main__container" style="margin-top:2rem;">
                    <div class="container__fluid"> 
                      <div class="row" id="contentPanel">
                        <div class="col-12">
                            <?php
                                            $sql =" SELECT 
                                                        `stud_id`
                                                        , `stud_name`
                                                        , `bu_email`
                                                        , `date_time`
                                                        , `img`
                                                        , `gc_status`
                                                        , `status`
                                                        FROM `gcash`
                                                        WHERE stud_id = ?;
                                                        ";
                            $stmt=mysqli_stmt_init($conn);
                            if (!mysqli_stmt_prepare($stmt, $sql)){
                              echo "Statement Failed.";
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
                                                    <th>Date</th>
                                                    <th>Item</th>
                                                    <th>Student ID</th>
                                                    <th>Student's Name</th>
                                                    <th>Status</th>
                                                </thead>
                                            <?php while($row = mysqli_fetch_assoc($resultData)){ ?>
                                                <tr>
                                                    <td><?php echo $row['date_time']; ?></td>
                                                    <td>
                                                      <div class="card-body" style="width: 18rem;">
                                                      <img src="../img/<?php echo $row['img'] ?>" alt="1 x 1" class="card-img-top" style="height:400px; width: 200px;">
                                                          <div class="card-body">
                                                            <h5 class="card-title"></h5>
                                                            <a href="../img"><?php echo $row['img']; ?></a>
                                                          </div>
                                                        </div>
                                                    </td>
                                                    <td><?php echo $row['stud_id']; ?></td>
                                                    <td><?php echo $row['stud_name']; ?></td>
                                                    <td> <p class="lead"><?php echo $row['gc_status'] == 'C' ? 'Confirmed' : 'Unconfirmed' ; ?></p></td>
                                                   <!--  class="img-thumbnail" -->
                                                  
                                                    <td></td>
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

        <section >
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
                                                    <th>ID Number</th>
                                                    <th>Name</th>
                                                    <th>Description</th>
                                                    <th>Amount</th>
                                                    <th>Deadline</th>
                                                </thead>
                                            <?php while($row = mysqli_fetch_assoc($resultData)){ ?>
                                                <tr>
                                                    <td><?php echo $row['Accbty_id']; ?></td>
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

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
          <li><a href="Gcash.php" class="nav-link text-left active"  role="button"><i class="bi bi-currency-exchange"></i>Gcash</a></li>
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
                      </nav>
                      </div>
                      </div>
                      
                      <!-- End of Topbar -->
                      <!-- Begin Page Content -->


                      <section id="content" >
                          <div class="card-header">
                              <h3 class="display-7">GCash Confirmation</h3>
                          </div>
                          <div class="rightbutton">
                            <p>
                                <a class="btn btn-primary" data-bs-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample">
                                  History
                                </a>
                            </p>
                              <div class="collapse" id="collapseExample">
                                <div class="card-body">
                                  
                                <div class="main__container" style="margin-top:2rem;">
                                  <div class="container__fluid"> 
                                    <div class="row" id="contentPanel">
                                      <div class="col-12">
                                          <?php
                                                          $sql =" SELECT 
                                                                      `stud_id`
                                                                      , `stud_name`
                                                                      , `accbty_name`
                                                                      , `bu_email`
                                                                      , `date_time`
                                                                      , `img`
                                                                      , `gc_status`
                                                                      , `status`
                                                                      FROM `gcash`
                                                                      WHERE gc_status = 'C';
                                                                      ";
                                          $stmt=mysqli_stmt_init($conn);
                                          if (!mysqli_stmt_prepare($stmt, $sql)){
                                            echo "Statement Failed.";
                                            exit();
                                          }
                                              
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
                                                                  <th>Accountability</th>
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
                                                                  <td><?php echo $row['accbty_name']; ?></td>
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
                                </div>
                              </div>
                          </div>

                        

                      <div class="row no-gutters">
                      <div class= "col-md-6 no-gutters">
                      <div class = "leftside d-flex justify-content-center align-items-center">

                                          <?php
                                          $sql =" SELECT `gcash_id`
                                          , s.stud_id
                                          , s.stud_program
                                          , s.stud_year_block
                                          , s.gender
                                          , g.stud_id
                                          , g.stud_name
                                          , g.accbty_name
                                          , g.bu_email
                                          , g.date_time
                                          , g.img
                                          , g.gc_status
                                          , g.status 
                                          FROM `gcash` g
                                          JOIN `student_info` s
                                          ON s.stud_id = g.stud_id
                                          WHERE gc_status = 'UC' 
                                          AND `status`  = 'A' ;";

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

                                
                                
                                <section id="content">
                                  
                                <div class="container" >
                                    <?php
                                    foreach($arr as $key => $val){
                                    ?>
                                      <div class="card mb-3" style="max-width: 540px; margin-top:2rem;">
                                        <div class="row g-0">
                                          <div class="col-md-4">
                                          <img  class="img-fluid rounded-start" src="../img/<?php echo $val['img'] ?>" alt="1 x 1" class="card-img-top">
                                          </div>
                                          <div class="col-md-8">
                                            <div class="card-body">
                                              <h5 class="card-title"><a href="../img"><?php echo $val['img']; ?></a></h5>
                                              <p class="card-text">
                                                  <label for="">Student ID:</label>
                                                  <h6><?php echo $val['stud_id']?></h6>
                                                  <label for="">Name: </label>
                                                  <h6><?php echo $val['stud_name']?></h6>
                                                  <label for="">Program: </label>
                                                  <h6><?php echo $val['stud_program']?></h6>
                                                  <label for=""> Year & Block: </label>
                                                  <h6><?php echo $val['stud_year_block']?></h6>
                                                  <label for=""> Gender: </label>
                                                  <h6><?php echo $val['gender']?></h6>
                                                  <label for="">Accountability: </label>
                                                  <h6><?php echo $val['accbty_name']?></h6>
                                            </div>
                                          </div>
                                          <div class="card-footer">
                                            <form action="../includes/update_stat.php" method="post">
                                                    <input hidden type="text" name="gcash_id" value="<?php echo $val['gcash_id'];?>">
                                                    <input hidden type="text" name="confirm_status" value="<?php echo $val['gc_status'] == 'C' ? 'UC' : 'C' ; ?>">
                                                    <p class="lead"><?php echo $val['gc_status'] == 'UC' ? 'For Confirmation' : 'Confirmed' ; ?></p>
                                                    <button class="btn btn-primary"> <?php echo $val['gc_status'] == 'C' ? 'Unconfirm' : 'Confirm' ; ?> </button>
                                            </form>
                                            </div>
                                        </div>
                                      </div>
                                      <?php
                                      }
                                  }else{
                                    echo "NO GCASH PAYMENT TO CONFIRM.";
                                  }

                              
                                      ?>
                                  </div>

                                </section>

                      </div>
                      </div>


                      <div class= "col-md-6 no-gutters">

                                        
                      <div class = "rightside d-flex justify-content-center align-items-center">
                                  <div class="card-body">
                                          <form action="../includes/gcashprocess.php" method="post">
                                          <?php if(isset($_GET['error'])) {
                                            switch ($_GET['error']){
                                               
                                                case 0:
                                                 
                                                  echo "<p class='text-danger'>Click the Confirm Button</p>";
                                                break;
                                            }
                                          }
                                      ?>
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
                                                  <br>
                                                  
                                                      <input hidden type="text" name="status_id" class="form-control" >
                                                  
                                                  <div class="mb-3">
                                                      <label for="TextInput" class="form-label">Student ID</label>
                                                      <input type="text" name="stud_id" class="form-control" require>
                                                  </div>

                                                  <div class="mb-3">
                                                      <label for="TextInput" class="form-label">Name</label>
                                                      <input type="text" name="stud_name" class="form-control" require>
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
                                                      <input type="text" placeholder= "Ex: 1A, 2B, 3C" name="stud_year_block" class="form-control" >
                                                  </div>
                                                  <div class="mb-3">
                                                      <label for="TextInput" class="form-label">Gender</label>
                                                      <select name="gender" id="disabledSelect" class="form-select" require>
                                                          <option value="F">Female</option>
                                                          <option value="M">Male</option>
                                                      </select>
                                                  </div>

                                                  <div class="mb-3">
                                                      <label for="TextInput" class="form-label">Accountability</label>
                                                      <select name="accbty_id" id="" class="form-select" require>
                                                      <?php
                                                              $sql_acc = "SELECT `accbty_id`, `accbty_name` FROM `accountabilities` WHERE status = 'A';";
                                                              $result = mysqli_query($conn, $sql_acc);
                                                              if(mysqli_num_rows($result) > 0){
                                                                  while($row = mysqli_fetch_assoc($result)){
                                                                      echo "<option value='".$row['accbty_id']."'>".$row['accbty_name']."</option>";
                                                                  }
                                                              }
                                                          ?>
                                                      </select>
                                                  </div>

                                                  <div class="mb-3">
                                                      <label for="TextInput" class="form-label">Amount</label>
                                                      <input type="text" name="accbty_price" class="form-control" require>
                                                  </div>

                                                  <div class="mb-3">
                                                      <label for="TextInput" class="form-label">Status</label>
                                                      <select name="pay_status" id="disabledSelect" class="form-select" require>
                                                          <option value="UP">Unpaid</option>
                                                          <option value="P">Paid</option>
                                                      </select>
                                                  </div>
                                                  <div class="mb-3">
                                                      <label for="TextInput" class="form-label">Payment Received By</label>
                                                      <input type="text" name="pymt_rcv_by" class="form-control" require>
                                                  </div>

                                            
                                                          <div class="card-footer">
                                                              <!-- <button class="btn btn-primary"> <i class="bi bi-save"></i> Save </button> -->
                                                            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                                                                <i class="bi bi-save"></i> Save 
                                                            </button>

                                                          </div>
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

                                                  </div>
                                          </form>
                                </div>
                      </div>
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
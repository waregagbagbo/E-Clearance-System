<?php 
  include ('server.php');
	//session_start(); 

	if (!isset($_SESSION['username'])) {
		$_SESSION['msg'] = "You must log in first";
		header('location: login.php');
	}

	if (isset($_GET['logout'])) {
		session_destroy();
		unset($_SESSION['username']);
		header("location: dept_login.php");
	}

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>Dedan Kimathi Clearance System</title>
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <meta content="" name="keywords">
  <meta content="" name="description">
  <!-- Favicons -->
  <link href="img/favicon.png" rel="icon">
  <link href="img/apple-touch-icon.png" rel="apple-touch-icon">
  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" rel="stylesheet">
  <!-- Bootstrap CSS File -->
  <link href="lib/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <!-- Libraries CSS Files -->
  <link href="lib/font-awesome/css/font-awesome.min.css" rel="stylesheet">
  <link href="lib/animate/animate.min.css" rel="stylesheet">
  <link href="lib/ionicons/css/ionicons.min.css" rel="stylesheet">
  <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
  <!-- Main Stylesheet File -->
  <link href="css/style.css" rel="stylesheet">
</head>

<body>

  <div class="click-closed"></div>


  <!--/ Nav Star /-->
  <nav class="navbar navbar-default navbar-trans navbar-expand-lg fixed-top">
    <div class="container">
      <button class="navbar-toggler collapsed" type="button" data-toggle="collapse" data-target="#navbarDefault"
        aria-controls="navbarDefault" aria-expanded="false" aria-label="Toggle navigation">
        <span></span>
        <span></span>
        <span></span>
      </button>
      <a class="navbar-brand text-brand" href="index.html">Department<span class="color-b">Dashboard</span></a>
      
      <div class="navbar-collapse collapse justify-content-center" id="navbarDefault">
        <ul class="navbar-nav">
          <li class="nav-item">
            <a class="nav-link active" href="index.html">Home</a>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown"
              aria-haspopup="true" aria-expanded="false">
              Pages
            </a>
            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
              <a class="dropdown-item" href="#">Property Single</a>
              <a class="dropdown-item" href="#">Blog Single</a>
            </div>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="contact.html">Contact</a>
          </li>
          <!-- logged in user information -->
          <li>
            <?php  if (isset($_SESSION['username'])) : ?>
              <strong> <a class="nav-link" href="#"><?php echo $_SESSION['username']; ?></a></strong>
          </li>
          <li> 
            <a  class="nav-link" href="index.php?logout='1'" style="color: red;">&nbsp [logout] </a> 
            <?php endif ?>
          </li>

        </ul>
      </div>
    </div>
  </nav>
  <!--/ Nav End /-->
  <!--/ Testimonials Star /-->
  <section class="section-testimonials section-t8 nav-arrow-a">
    <div class="container">
      <h2>CLEARANCE PROGRESS</h2>
       <strong>USER: </strong>
     
         
          <!-- [ LOOP THE CLEARANCE STATUS OF THE STUDENTS ] --> 
          <?php
            
            $user =$_SESSION['username'];
            echo $user;

            $sql0 = "SELECT  * FROM depertment_officers WHERE username = '$user'";
            $result0 = mysqli_query($db, $sql0);
            $row = mysqli_fetch_assoc($result0);
            $dept = $row['departmment'];
            $deptid = $row['id'];
            $pen = 'PENDING';
            $clr = 'CLEARED';
            echo '<br>';
            echo "<b>CURRENT DEPARTMENT : </b>".$dept;
            echo "<b><br>DEPT ID :  </b>".$deptid;
            echo "<br>";       

            switch ($deptid) {
//  ======================================================================
//  :::::::::::::::::::; COD ::::::::::::::::::::::::::::::::
//  ======================================================================
              case "1": //COD
                  echo "HELLO COD!";
                  $de = "cod";
                  $sql = "SELECT * FROM clearance WHERE cod = '$pen' ORDER BY student_reg";
                 // $sql = "SELECT * FROM tablelist1   WHERE NOT EXISTS (SELECT JID FROM tablelog2 WHERE UID = 'X') "
                  $result = mysqli_query($db, $sql);
              ?>
               <table class="table table-bordered">
                <thead>
                  <tr>
                    <th scope="col">STD ID</th>
                    <th scope="col">REG No. </th>
                    <th scope="col">COD</th>
                    <th scope="col">CLEAR</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                    echo '<form method="post">';
                    while($row = mysqli_fetch_array($result, MYSQLI_NUM)){
                      
                      $stid = $row[0];
                      $reg = $row[1];
                      $cod = $row[2];
                      
                      //see if record already has issues if so skip from list of the once being cleared
                      $query = mysqli_query($db, "SELECT * FROM issue_cod WHERE  std_reg = '$reg'");
                      $number=mysqli_num_rows($query);
                      if($number == 0){

                        echo '<tr>';
                        echo '<td>'.$stid.'</td>';
                        echo  '<th scope="row">'.$reg.'</th>';
                        echo '<td>'.$cod.'</td>';
                        echo '<td><a href="clear.php?id='.$row[0].'&dept='.$de.'"><strong><button type="button" class="btn btn-success">CLEAR</button></td>';
                        echo  '</tr>';
                        echo '</form>';   
                      }    
                    } 
                    echo '</tbody>
                   </table>';

                   echo '<br>';
                   ?>
                   <h2>Students with issues</h2>
                   <table class="table table-bordered">
                    <thead>
                      <tr>
                        <th scope="col">is ID</th>
                        <th scope="col">REG No. </th>
                        <th scope="col">Category</th>
                        <th scope="col">Description</th>
                        <th scope="col">Status</th>
                      </tr>
                    </thead>
                    <tbody>
                    <?php
                    $sql = "SELECT * FROM issue_cod WHERE status = '$pen'";
                     $result = mysqli_query($db, $sql);
                      echo '<form method="post">';
                      while($row = mysqli_fetch_array($result, MYSQLI_NUM)){
                        echo '<tr>';
                          echo '<td>'.$row[0].'</td>';
                          echo  '<td>'.$row[1].'</th>';
                          echo '<td>'.$row[2].'</td>';
                          echo '<td>'.$row[3].'</td>';
                          echo '<td>'.$row[4].'</td>';
                        echo  '</tr>';
                        echo '</form>';       
                      } 
                      echo '</tbody>
                    </table>';
        
                  break;

//  ======================================================================
//  :::::::::::::::::::; LIBRARIAN ::::::::::::::::::::::::::::::::
//  ======================================================================
              case "2": //librarian
                  echo "HELLO MSEE WA BOOKS!";
                  $de = "librarian";
                  $sql = "SELECT * FROM clearance WHERE librarian = '$pen'";
                  $result = mysqli_query($db, $sql);
              ?>
              <table class="table table-bordered">
                <thead>
                  <tr>
                    <th scope="col">REG No. </th>
                    <th scope="col">COD</th>
                    <th scope="col">librarian</th>
                    <th scope="col">CLEAR</th>
                  </tr>
                </thead>
                <tbody>
                <?php
                    echo '<form method="post">';
                    while($row = mysqli_fetch_array($result, MYSQLI_NUM)){
                      
                      $stid = $row[0];
                      $reg = $row[1];
                      $cod = $row[2];
                      
                      //see if record already has issues if so skip from list of the once being cleared
                      $query = mysqli_query($db, "SELECT * FROM issue_librarian WHERE  std_reg = '$reg'");
                      $number=mysqli_num_rows($query);
                      if($number == 0){

                        echo '<tr>';
                        echo '<td>'.$stid.'</td>';
                        echo  '<th scope="row">'.$reg.'</th>';
                        echo '<td>'.$cod.'</td>';
                        echo '<td><a href="clear.php?id='.$row[0].'&dept='.$de.'"><strong><button type="button" class="btn btn-success">CLEAR</button></td>';
                        echo  '</tr>';
                        echo '</form>';   
                      }    
                    } 
                    echo '</tbody>
                   </table>';

                   echo '<br>';
                   ?>
                   <h2>Students with issues</h2>
                   <table class="table table-bordered">
                    <thead>
                      <tr>
                        <th scope="col">is ID</th>
                        <th scope="col">REG No. </th>
                        <th scope="col">Category</th>
                        <th scope="col">Description</th>
                        <th scope="col">Status</th>
                      </tr>
                    </thead>
                    <tbody>
                    <?php
                    $sql = "SELECT * FROM issue_librarian WHERE status = '$pen'";
                     $result = mysqli_query($db, $sql);
                      echo '<form method="post">';
                      while($row = mysqli_fetch_array($result, MYSQLI_NUM)){
                        echo '<tr>';
                          echo '<td>'.$row[0].'</td>';
                          echo  '<td>'.$row[1].'</th>';
                          echo '<td>'.$row[2].'</td>';
                          echo '<td>'.$row[3].'</td>';
                          echo '<td>'.$row[4].'</td>';
                        echo  '</tr>';
                        echo '</form>';       
                      } 
                      echo '</tbody>
                    </table>';
        
                  break;
//  ======================================================================
//  :::::::::::::::::::; HOUSE KEEPER ::::::::::::::::::::::::::::::::
//  ======================================================================
                  
              case "3":
                  echo "HELLO HOUSEKEEPER!";
                  $de = "housekeeper";
                  $sql = "SELECT * FROM clearance WHERE housekeeper = '$pen'";
                  $result = mysqli_query($db, $sql);
              ?>
              <table class="table table-bordered">
                <thead>
                  <tr>
                    <th scope="col">REG No. </th>
                    <th scope="col">COD</th>
                    <th scope="col">Housekeeper</th>
                    <th scope="col">CLEAR</th>
                  </tr>
                </thead>
                <tbody>
                <?php
                    echo '<form method="post">';
                    while($row = mysqli_fetch_array($result, MYSQLI_NUM)){
                      
                      $stid = $row[0];
                      $reg = $row[1];
                      $cod = $row[2];
                      
                      //see if record already has issues if so skip from list of the once being cleared
                      $query = mysqli_query($db, "SELECT * FROM issue_housekeeper WHERE  std_reg = '$reg'");
                      $number=mysqli_num_rows($query);
                      if($number == 0){

                        echo '<tr>';
                        echo '<td>'.$stid.'</td>';
                        echo  '<th scope="row">'.$reg.'</th>';
                        echo '<td>'.$cod.'</td>';
                        echo '<td><a href="clear.php?id='.$row[0].'&dept='.$de.'"><strong><button type="button" class="btn btn-success">CLEAR</button></td>';
                        echo  '</tr>';
                        echo '</form>';   
                      }    
                    } 
                    echo '</tbody>
                   </table>';

                   echo '<br>';
                   ?>
                   <h2>Students with issues</h2>
                   <table class="table table-bordered">
                    <thead>
                      <tr>
                        <th scope="col">is ID</th>
                        <th scope="col">REG No. </th>
                        <th scope="col">Category</th>
                        <th scope="col">Description</th>
                        <th scope="col">Status</th>
                      </tr>
                    </thead>
                    <tbody>
                    <?php
                    $sql = "SELECT * FROM issue_housekeeper WHERE status = '$pen'";
                     $result = mysqli_query($db, $sql);
                      echo '<form method="post">';
                      while($row = mysqli_fetch_array($result, MYSQLI_NUM)){
                        echo '<tr>';
                          echo '<td>'.$row[0].'</td>';
                          echo  '<td>'.$row[1].'</th>';
                          echo '<td>'.$row[2].'</td>';
                          echo '<td>'.$row[3].'</td>';
                          echo '<td>'.$row[4].'</td>';
                        echo  '</tr>';
                        echo '</form>';       
                      } 
                      echo '</tbody>
                    </table>';
        
                  break;
//  ======================================================================
//  :::::::::::::::::::; DEAN OF STUDENTS  ::::::::::::::::::::::::::::::::
//  ======================================================================
              case "4": //Dean of Students
                echo "HELLO DEAN!";
                $de = "dean_of_students";
                $sql = "SELECT * FROM clearance WHERE  dean_of_students='$pen'";
                $result = mysqli_query($db, $sql);
                ?>
                <table class="table table-bordered">
                <thead>
                <tr>
                  <th scope="col">ID</th>
                  <th scope="col">REG No. </th>
                  <th scope="col">DEAN OF STUDENTS</th>
                  <th scope="col">CLEAR</th>
                </tr>
                </thead>
                <tbody>
                <?php
                    echo '<form method="post">';
                    while($row = mysqli_fetch_array($result, MYSQLI_NUM)){
                      
                      $stid = $row[0];
                      $reg = $row[1];
                      $cod = $row[2];
                      
                      //see if record already has issues if so skip from list of the once being cleared
                      $query = mysqli_query($db, "SELECT * FROM issue_deanofstudents WHERE  std_reg = '$reg'");
                      $number=mysqli_num_rows($query);
                      if($number == 0){

                        echo '<tr>';
                        echo '<td>'.$stid.'</td>';
                        echo  '<th scope="row">'.$reg.'</th>';
                        echo '<td>'.$cod.'</td>';
                        echo '<td><a href="clear.php?id='.$row[0].'&dept='.$de.'"><strong><button type="button" class="btn btn-success">CLEAR</button></td>';
                        echo  '</tr>';
                        echo '</form>';   
                      }    
                    } 
                    echo '</tbody>
                   </table>';

                   echo '<br>';
                   ?>
                   <h2>Students with issues</h2>
                   <table class="table table-bordered">
                    <thead>
                      <tr>
                        <th scope="col">is ID</th>
                        <th scope="col">REG No. </th>
                        <th scope="col">Category</th>
                        <th scope="col">Description</th>
                        <th scope="col">Status</th>
                      </tr>
                    </thead>
                    <tbody>
                    <?php
                    $sql = "SELECT * FROM issue_deanofstudents WHERE status = '$pen'";
                     $result = mysqli_query($db, $sql);
                      echo '<form method="post">';
                      while($row = mysqli_fetch_array($result, MYSQLI_NUM)){
                        echo '<tr>';
                          echo '<td>'.$row[0].'</td>';
                          echo  '<td>'.$row[1].'</th>';
                          echo '<td>'.$row[2].'</td>';
                          echo '<td>'.$row[3].'</td>';
                          echo '<td>'.$row[4].'</td>';
                        echo  '</tr>';
                        echo '</form>';       
                      } 
                      echo '</tbody>
                    </table>';
        
                  break;

//  ======================================================================
//  :::::::::::::::::::; SPORTS OFFICER ::::::::::::::::::::::::::::::::
//  ======================================================================
              case "5": 
                echo "HELLO SPORTS OFFICER !";
                $de = "sports_officer";
                $sql = "SELECT * FROM clearance WHERE sports_officer='$pen'";
                $result = mysqli_query($db, $sql);
                ?>
                <table class="table table-bordered">
                <thead>
                <tr>
                  <th scope="col"> Id.</th>
                  <th scope="col">REG No. </th>
                  <th scope="col">SPORTS OFFICER</th>
                  <th scope="col">CLEAR</th>
                </tr>
                </thead>
                <tbody>
                <?php
                    echo '<form method="post">';
                    while($row = mysqli_fetch_array($result, MYSQLI_NUM)){
                      
                      $stid = $row[0];
                      $reg = $row[1];
                      $cod = $row[2];
                      
                      //see if record already has issues if so skip from list of the once being cleared
                      $query = mysqli_query($db, "SELECT * FROM issue_sportsofficer WHERE  std_reg = '$reg'");
                      $number=mysqli_num_rows($query);
                      if($number == 0){

                        echo '<tr>';
                        echo '<td>'.$stid.'</td>';
                        echo  '<th scope="row">'.$reg.'</th>';
                        echo '<td>'.$cod.'</td>';
                        echo '<td><a href="clear.php?id='.$row[0].'&dept='.$de.'"><strong><button type="button" class="btn btn-success">CLEAR</button></td>';
                        echo  '</tr>';
                        echo '</form>';   
                      }    
                    } 
                    echo '</tbody>
                   </table>';

                   echo '<br>';
                   ?>
                   <h2>Students with issues</h2>
                   <table class="table table-bordered">
                    <thead>
                      <tr>
                        <th scope="col">is ID</th>
                        <th scope="col">REG No. </th>
                        <th scope="col">Category</th>
                        <th scope="col">Description</th>
                        <th scope="col">Status</th>
                      </tr>
                    </thead>
                    <tbody>
                    <?php
                    $sql = "SELECT * FROM issue_sportsofficer WHERE status = '$pen'";
                     $result = mysqli_query($db, $sql);
                      echo '<form method="post">';
                      while($row = mysqli_fetch_array($result, MYSQLI_NUM)){
                        echo '<tr>';
                          echo '<td>'.$row[0].'</td>';
                          echo  '<td>'.$row[1].'</th>';
                          echo '<td>'.$row[2].'</td>';
                          echo '<td>'.$row[3].'</td>';
                          echo '<td>'.$row[4].'</td>';
                        echo  '</tr>';
                        echo '</form>';       
                      } 
                      echo '</tbody>
                    </table>';
        
                  break;
//  ======================================================================
//  :::::::::::::::::::; REGISTRAR ::::::::::::::::::::::::::::::::
//  ======================================================================
            case "6": //libratianM
              echo "HELLO REGISTRAR !";
              $de = "registrar";
              $sql = "SELECT * FROM clearance WHERE registrar='$pen' ";
              $result = mysqli_query($db, $sql);
              ?>
              <table class="table table-bordered">
                <thead>
              <tr>
                <th scope="col">REG No. </th>
                <th scope="col">REGISTRAR</th>
                <th scope="col">CLEAR</th>
                <th scope="col">NOT CLEARED</th>
              </tr>
              </thead>
              <tbody>
              <?php
                    echo '<form method="post">';
                    while($row = mysqli_fetch_array($result, MYSQLI_NUM)){
                      
                      $stid = $row[0];
                      $reg = $row[1];
                      $cod = $row[2];
                      
                      //see if record already has issues if so skip from list of the once being cleared
                      $query = mysqli_query($db, "SELECT * FROM issue_registrar WHERE  std_reg = '$reg'");
                      $number=mysqli_num_rows($query);
                      if($number == 0){

                        echo '<tr>';
                        echo '<td>'.$stid.'</td>';
                        echo  '<th scope="row">'.$reg.'</th>';
                        echo '<td>'.$cod.'</td>';
                        echo '<td><a href="clear.php?id='.$row[0].'&dept='.$de.'"><strong><button type="button" class="btn btn-success">CLEAR</button></td>';
                        echo  '</tr>';
                        echo '</form>';   
                      }    
                    } 
                    echo '</tbody>
                   </table>';

                   echo '<br>';
                   ?>
                   <h2>Students with issues</h2>
                   <table class="table table-bordered">
                    <thead>
                      <tr>
                        <th scope="col">is ID</th>
                        <th scope="col">REG No. </th>
                        <th scope="col">Category</th>
                        <th scope="col">Description</th>
                        <th scope="col">Status</th>
                      </tr>
                    </thead>
                    <tbody>
                    <?php
                    $sql = "SELECT * FROM issue_registrar WHERE status = '$pen'";
                     $result = mysqli_query($db, $sql);
                      echo '<form method="post">';
                      while($row = mysqli_fetch_array($result, MYSQLI_NUM)){
                        echo '<tr>';
                          echo '<td>'.$row[0].'</td>';
                          echo  '<td>'.$row[1].'</th>';
                          echo '<td>'.$row[2].'</td>';
                          echo '<td>'.$row[3].'</td>';
                          echo '<td>'.$row[4].'</td>';
                        echo  '</tr>';
                        echo '</form>';       
                      } 
                      echo '</tbody>
                    </table>';
        
                  break;

//  ======================================================================
//  :::::::::::::::::::; FINANCE ::::::::::::::::::::::::::::::::
//  ======================================================================
              case "7": //Finance 
                echo "HELLO FINANCE DEPARTMENT !";
                $de = "finance";
                $sql = "SELECT * FROM clearance WHERE  finance = '$pen'";
                $result = mysqli_query($db, $sql);
                ?>
                <table class="table table-bordered">
                <thead>
                <tr>
                  <th scope="col">REG NU. </th>
                  <th scope="col">REGISTRAR</th>
                  <th scope="col">CLEAR</th>
                  <th scope="col">NOT CLEARED</th>
                </tr>
                </thead>
                <tbody>
                <?php
                    echo '<form method="post">';
                    while($row = mysqli_fetch_array($result, MYSQLI_NUM)){
                      
                      $stid = $row[0];
                      $reg = $row[1];
                      $cod = $row[2];
                      
                      //see if record already has issues if so skip from list of the once being cleared
                      $query = mysqli_query($db, "SELECT * FROM issue_finance WHERE  std_reg = '$reg'");
                      $number=mysqli_num_rows($query);
                      if($number == 0){

                        echo '<tr>';
                        echo '<td>'.$stid.'</td>';
                        echo  '<th scope="row">'.$reg.'</th>';
                        echo '<td>'.$cod.'</td>';
                        echo '<td><a href="clear.php?id='.$row[0].'&dept='.$de.'"><strong><button type="button" class="btn btn-success">CLEAR</button></td>';
                        echo  '</tr>';
                        echo '</form>';   
                      }    
                    } 
                    echo '</tbody>
                   </table>';

                   echo '<br>';
                   ?>
                   <h2>Students with issues</h2>
                   <table class="table table-bordered">
                    <thead>
                      <tr>
                        <th scope="col">is ID</th>
                        <th scope="col">REG No. </th>
                        <th scope="col">Category</th>
                        <th scope="col">Description</th>
                        <th scope="col">Status</th>
                      </tr>
                    </thead>
                    <tbody>
                    <?php
                    $sql = "SELECT * FROM issue_finance WHERE status = '$pen'";
                     $result = mysqli_query($db, $sql);
                      echo '<form method="post">';
                      while($row = mysqli_fetch_array($result, MYSQLI_NUM)){
                        echo '<tr>';
                          echo '<td>'.$row[0].'</td>';
                          echo  '<td>'.$row[1].'</th>';
                          echo '<td>'.$row[2].'</td>';
                          echo '<td>'.$row[3].'</td>';
                          echo '<td>'.$row[4].'</td>';
                        echo  '</tr>';
                        echo '</form>';       
                      } 
                      echo '</tbody>
                    </table>';
        
                  break;

              default:
                  echo "CAN'T RESOLVE YOUR DEPARTMRENT!";
          }
            
          ?>
        </tbody>
      </table>

    </div>
  </section>
  <!--/ Testimonials End /-->

  <!--/ footer Star /-->
  <section class="section-footer">
    <div class="container">
      <div class="row">
        <div class="col-sm-12 col-md-4">
          <div class="widget-a">
            <div class="w-header-a">
              <h3 class="w-title-a text-brand">DEDAN KIMATHI UNIVERSITY</h3>
            </div>
            <div class="w-body-a">
              <p class="w-text-a color-text-a">
                Dedan kimathi university was founded some time long ago :).. and other stories coming right up
              </p>
            </div>
            <div class="w-footer-a">
              <ul class="list-unstyled">
                <li class="color-a">
                  <span class="color-text-a">Phone .</span> +254 713 835 965</li>
                <li class="color-a">
                  <span class="color-text-a">Email .</span> adminssionsoffice@dkut.ac.ke</li>
              </ul>
            </div>
          </div>
        </div>
        <div class="col-sm-12 col-md-4 section-md-t3">
          <div class="widget-a">
            <div class="w-header-a">
              <h3 class="w-title-a text-brand">Quick Links</h3>
            </div>
            <div class="w-body-a">
              <div class="w-body-a">
                <ul class="list-unstyled">
                  <li class="item-list-a">
                    <i class="fa fa-angle-right"></i> <a href="https://www.dkut.ac.ke">DKUT Conservancy</a>
                  </li>
                  <li class="item-list-a">
                    <i class="fa fa-angle-right"></i> <a href="https://www.dkut.ac.ke">Enquiry</a>
                  </li>
                  <li class="item-list-a">
                    <i class="fa fa-angle-right"></i> <a href="https://www.dkut.ac.ke">Complaints and Compliments</a>
                  </li>
                  <li class="item-list-a">
                    <i class="fa fa-angle-right"></i> <a href="https://www.dkut.ac.ke">Media Center</a>
                  </li>
                  <li class="item-list-a">
                    <i class="fa fa-angle-right"></i> <a href="https://www.dkut.ac.ke">Affiliate</a>
                  </li>
                  <li class="item-list-a">
                    <i class="fa fa-angle-right"></i> <a href="https://www.dkut.ac.ke">Privacy Policy</a>
                  </li>
                </ul>
              </div>
            </div>
          </div>
        </div>
        <div class="col-sm-12 col-md-4 section-md-t3">
          <div class="widget-a">
            <div class="w-header-a">
              <h3 class="w-title-a text-brand">Resources</h3>
            </div>
            <div class="w-body-a">
              <ul class="list-unstyled">
                <li class="item-list-a">
                  <i class="fa fa-angle-right"></i> <a href="https://www.dkut.ac.ke">student Portal</a>
                </li>
                <li class="item-list-a">
                  <i class="fa fa-angle-right"></i> <a href="https://www.dkut.ac.ke">staff Portal</a>
                </li>
                <li class="item-list-a">
                  <i class="fa fa-angle-right"></i> <a href="https://www.dkut.ac.ke">Office Extension Memmabers</a>
                </li>
                <li class="item-list-a">
                  <i class="fa fa-angle-right"></i> <a href="https://www.dkut.ac.ke>ICT Helpdesk</a>
                </li>
                <li class="item-list-a">
                  <i class="fa fa-angle-right"></i> <a href="https://www.dkut.ac.ke">Library Catallogue</a>
                </li>
                <li class="item-list-a">
                  <i class="fa fa-angle-right"></i> <a href="https://www.dkut.ac.ke">Institutional Repository</a>
                </li>
              </ul>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <footer>
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <nav class="nav-footer">
          
          </nav>
          <div class="socials-a">
            <ul class="list-inline">
              <li class="list-inline-item">
                <a href="#">
                  <i class="fa fa-facebook" aria-hidden="true"></i>
                </a>
              </li>
              <li class="list-inline-item">
                <a href="#">
                  <i class="fa fa-twitter" aria-hidden="true"></i>
                </a>
              </li>
              <li class="list-inline-item">
                <a href="#">
                  <i class="fa fa-instagram" aria-hidden="true"></i>
                </a>
              </li>
              <li class="list-inline-item">
                <a href="#">
                  <i class="fa fa-pinterest-p" aria-hidden="true"></i>
                </a>
              </li>
              <li class="list-inline-item">
                <a href="#">
                  <i class="fa fa-dribbble" aria-hidden="true"></i>
                </a>
              </li>
            </ul>
          </div>
        </div>
      </div>
    </div>
  </footer>
  <!--/ Footer End /-->

  <a href="#" class="back-to-top"><i class="fa fa-chevron-up"></i></a>
  <div id="preloader"></div>

  <!-- JavaScript Libraries -->
  <script src="lib/jquery/jquery.min.js"></script>
  <script src="lib/jquery/jquery-migrate.min.js"></script>
  <script src="lib/popper/popper.min.js"></script>
  <script src="lib/bootstrap/js/bootstrap.min.js"></script>
  <script src="lib/easing/easing.min.js"></script>
  <script src="lib/owlcarousel/owl.carousel.min.js"></script>
  <script src="lib/scrollreveal/scrollreveal.min.js"></script>
  <!-- Contact Form JavaScript File -->
  <script src="contactform/contactform.js"></script>

  <!-- Template Main Javascript File -->
  <script src="js/main.js"></script>

</body>
</html>

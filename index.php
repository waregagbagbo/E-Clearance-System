<?php 
  include('server.php');
	// session_start(); 

	if (!isset($_SESSION['username'])) {
		$_SESSION['msg'] = "You must log in first";
		header('location: login.php');
	}

	if (isset($_GET['logout'])) {
		session_destroy();
		unset($_SESSION['username']);
		header("location: login.php");
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
      <a class="navbar-brand text-brand" href="index.php">Clearance<span class="color-b">System</span></a>
      
      <div class="navbar-collapse collapse justify-content-center" id="navbarDefault">
        <ul class="navbar-nav">
          <li class="nav-item">
            <a class="nav-link active" href="index.php">Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">About</a>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown"
              aria-haspopup="true" aria-expanded="false">
              Pages
            </a>
            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
              <a class="dropdown-item" href="profile.php">Profile</a>
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
      [[ OUR TABLE HERE ]]
      <table class="table table-bordered">
        <thead>
          <tr>
            <th scope="col">REG No. </th>
            <th scope="col">COD</th>
            <th scope="col">librarian</th>
            <th scope="col">Housekeeper</th>
            <th scope="col">Dean of Students</th>
            <th scope="col">Sports Officer</th>
            <th scope="col">Registrar</th>
            <th scope="col">Finance</th>
          </tr>
        </thead>
        <tbody>
         
            <?php

              $user =$_SESSION['username'];
              echo $user;
				      $sql = "SELECT * FROM clearance WHERE student_reg = '$user'";
              $result = mysqli_query($db, $sql);
              
              while($row = mysqli_fetch_array($result, MYSQLI_NUM)){
                $cod = $row[2];  $lib = $row[3];  $hse = $row[4]; $dos = $row[5]; $sprt= $row[6]; $rgtr= $row[7]; $fin = $row[8];
                echo' <tr>
                <th scope="row">'.$_SESSION['username'].'</th>';
                echo '<td>'.$row[2].'</td>';
                echo '<td>'.$row[3].'</td>';
                echo '<td>'.$row[4].'</td>';
                echo '<td>'.$row[5].'</td>';
                echo '<td>'.$row[6].'</td>';
                echo '<td>'.$row[7].'</td>';
                echo '<td>'.$row[8].'</td>';
                echo'</tr>';
              }
            ?>

          
        </tbody>
      </table>
      <?php
        if( ($cod =='CLEARED') && ($cod == $lib) && ($lib== $hse) && ($hse==$dos) && ($dos== $sprt) && ($sprt==$rgtr) && ($rgtr==$fin)){
              echo "<div style='padding: 6px 12px; border: 1px solid #ccc; background-color:rgba(10, 200, 0, 0.3);'>
                  <h4>All Cleared !!</h4>
                  <a href='#' ><i class='fa fa-download'></i><b>'.$user.'</b></a><br>
                  Fantastick. you can download the Department Clearance form";
              echo '<a href="pdf/pdf.php?reg='.$user.'" target="0"><button class="btn btn-primary" style="width:100%"><i class="fa fa-download"></i>Download Clearance Form</button></a>';
              echo '</div>';
              echo '<br>';
              echo "<div style='padding: 6px 12px; border: 1px solid #ccc; background-color:rgba(5, 0, 200, 0.3);'>
              <h4 style='color:white;'>Gawn Clearance !</h4>
              <a href='#' ><i class='fa fa-download'></i><b>'.$user.'</b></a><br>
              you can now access gawn clearance here <br>";
              echo '<a href="gawnpart.php" target="0"><i class="fa fa-book"></i> Gown Clearance</a>';
              echo '</div>';
        }
      ?>
    </div>


    <br>

    <div class="container" >
        <div style="padding: 6px 12px; border: 1px solid #ccc;height:auto; verflow: auto;">
          <b>Issues from department ...... if there's any  </b>
          <table class="table table-bordered">
        <thead>
          <tr>
            <th scope="col">REG No. </th>
            <th scope="col">Department</th>
            <th scope="col">Issue Category</th>
            <th scope="col">Description</th>
            <th scope="col">Status</th>
          </tr>
        </thead>
        <tbody>
          <?php
            $user =$_SESSION['username'];
          ?>
          <!-- [ LOOP THE ISSUES FROM ALL DEPARTMENTS IF ANY  ] -->
          <?php
            $sqlcod = "SELECT * FROM issue_cod WHERE std_reg='$user'";
            $sqldeanofstudents = "SELECT * FROM issue_deanofstudents WHERE std_reg='$user'";
            $sqlfinance = "SELECT * FROM issue_finance WHERE std_reg='$user'";
            $sqlhousekeeper = "SELECT * FROM issue_housekeeper WHERE std_reg='$user'";
            $sqllibrarian = "SELECT * FROM issue_librarian WHERE std_reg='$user'";
            $sqlregistrar = "SELECT * FROM issue_registrar WHERE std_reg='$user'";
            $sqlsportsofficer = "SELECT * FROM issue_sportsofficer WHERE std_reg='$user'";

		        $rescod = mysqli_query($db, $sqlcod);
		        $resdeanofstudents = mysqli_query($db, $sqldeanofstudents);
		        $resfinance = mysqli_query($db, $sqlfinance);
		        $reshousekeeper = mysqli_query($db, $sqlhousekeeper);
		        $reslibrarian = mysqli_query($db, $sqllibrarian);
		        $resregistrar = mysqli_query($db, $sqlregistrar);
            $ressportsofficer = mysqli_query($db, $sqlsportsofficer);
            
            if (mysqli_num_rows($rescod) > 0) {
                echo '<tr>' ;
                    $sql = "SELECT * FROM issue_cod WHERE std_reg = '$user' ";
                    $result = mysqli_query($db, $sql);

                    while($row = mysqli_fetch_array($result, MYSQLI_NUM)){
                      $dept = 'COD';
                      echo '<td>'.$row[1].'</td>';
                      echo '<td>'.$dept.'</td>';
                      echo '<td>'.$row[2].'</td>';
                      echo '<td>'.$row[3].'</td>';
                      echo '<td>'.$row[4].'</td>';
                    }
                echo '</tr>';
            }
            if (mysqli_num_rows($resdeanofstudents) > 0) {
              echo '<tr>' ;
                  $sql = "SELECT * FROM issue_deanofstudents WHERE std_reg = '$user' ";
                  $result = mysqli_query($db, $sql);

                  while($row = mysqli_fetch_array($result, MYSQLI_NUM)){
                    $dept = 'Dean Of Students';
                    echo '<td>'.$row[1].'</td>';
                    echo '<td>'.$dept.'</td>';
                    echo '<td>'.$row[2].'</td>';
                    echo '<td>'.$row[3].'</td>';
                    echo '<td>'.$row[4].'</td>';
                  }
              echo '</tr>';
          }
          if (mysqli_num_rows($resfinance) > 0) {
            echo '<tr>' ;
                $sql = "SELECT * FROM issue_finance WHERE std_reg = '$user' ";
                $result = mysqli_query($db, $sql);

                while($row = mysqli_fetch_array($result, MYSQLI_NUM)){
                  $dept = 'Finance';
                  echo '<td>'.$row[1].'</td>';
                  echo '<td>'.$dept.'</td>';
                  echo '<td>'.$row[2].'</td>';
                  echo '<td>'.$row[3].'</td>';
                  echo '<td>'.$row[4].'</td>';
                }
            echo '</tr>';
        }
        if (mysqli_num_rows($reshousekeeper) > 0) {
          echo '<tr>' ;
              $sql = "SELECT * FROM issue_housekeeper WHERE std_reg = '$user' ";
              $result = mysqli_query($db, $sql);

              while($row = mysqli_fetch_array($result, MYSQLI_NUM)){
                $dept = 'HouseKeeper';
                echo '<td>'.$row[1].'</td>';
                echo '<td>'.$dept.'</td>';
                echo '<td>'.$row[2].'</td>';
                echo '<td>'.$row[3].'</td>';
                echo '<td>'.$row[4].'</td>';
              }
          echo '</tr>';
      }
      if (mysqli_num_rows($reslibrarian) > 0) {
        echo '<tr>' ;
            $sql = "SELECT * FROM issue_librarian WHERE std_reg = '$user' ";
            $result = mysqli_query($db, $sql);

            while($row = mysqli_fetch_array($result, MYSQLI_NUM)){
              $dept = 'Librarian';
              echo '<td>'.$row[1].'</td>';
              echo '<td>'.$dept.'</td>';
              echo '<td>'.$row[2].'</td>';
              echo '<td>'.$row[3].'</td>';
              echo '<td>'.$row[4].'</td>';
            }
        echo '</tr>';
    }
    if (mysqli_num_rows($resregistrar) > 0) {
      echo '<tr>' ;
          $sql = "SELECT * FROM issue_registrar WHERE std_reg = '$user' ";
          $result = mysqli_query($db, $sql);

          while($row = mysqli_fetch_array($result, MYSQLI_NUM)){
            $dept = 'Registrar';
            echo '<td>'.$row[1].'</td>';
            echo '<td>'.$dept.'</td>';
            echo '<td>'.$row[2].'</td>';
            echo '<td>'.$row[3].'</td>';
            echo '<td>'.$row[4].'</td>';
          }
      echo '</tr>';
      }
      if (mysqli_num_rows($ressportsofficer) > 0) {
        echo '<tr>' ;
            $sql = "SELECT * FROM issue_sportsofficer WHERE std_reg = '$user' ";
            $result = mysqli_query($db, $sql);

            while($row = mysqli_fetch_array($result, MYSQLI_NUM)){
              $dept = 'Sports Officer';
              echo '<td>'.$row[1].'</td>';
              echo '<td>'.$dept.'</td>';
              echo '<td>'.$row[2].'</td>';
              echo '<td>'.$row[3].'</td>';
              echo '<td>'.$row[4].'</td>';
            }
        echo '</tr>';
        }
      ?> 
        </tbody>
      </table>
        </div>
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
                    <i class="fa fa-angle-right"></i> <a href="#">DKUT Conservancy</a>
                  </li>
                  <li class="item-list-a">
                    <i class="fa fa-angle-right"></i> <a href="#">Enquiry</a>
                  </li>
                  <li class="item-list-a">
                    <i class="fa fa-angle-right"></i> <a href="#">Complaints and Compliments</a>
                  </li>
                  <li class="item-list-a">
                    <i class="fa fa-angle-right"></i> <a href="#">Media Center</a>
                  </li>
                  <li class="item-list-a">
                    <i class="fa fa-angle-right"></i> <a href="#">Affiliate</a>
                  </li>
                  <li class="item-list-a">
                    <i class="fa fa-angle-right"></i> <a href="#">Privacy Policy</a>
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
                  <i class="fa fa-angle-right"></i> <a href="#">student Portal</a>
                </li>
                <li class="item-list-a">
                  <i class="fa fa-angle-right"></i> <a href="#">staff Portal</a>
                </li>
                <li class="item-list-a">
                  <i class="fa fa-angle-right"></i> <a href="#">Office Extension Memmabers</a>
                </li>
                <li class="item-list-a">
                  <i class="fa fa-angle-right"></i> <a href="#">ICT Helpdesk</a>
                </li>
                <li class="item-list-a">
                  <i class="fa fa-angle-right"></i> <a href="#">Library Catallogue</a>
                </li>
                <li class="item-list-a">
                  <i class="fa fa-angle-right"></i> <a href="#">Institutional Repository</a>
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

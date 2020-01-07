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
            <th scope="col">id# </th>
            <th scope="col">RegNo</th>
            <th scope="col">Email</th>
            <th scope="col">Telephone</th>
            <th scope="col">Total Payments</th>
          </tr>
        </thead>
        <tbody>
          <!-- [ LOOP THE CLEARANCE STATUS OF THE STUDENTS ] -->
          <tr>
            <th scope="row"><?php echo $_SESSION['username'];?></th>
            <?php

              $user =$_SESSION['username'];
              echo $user;
				      $sql = "SELECT * FROM users WHERE username = '$user'";
              $result = mysqli_query($db, $sql);
              
              while($row = mysqli_fetch_array($result, MYSQLI_NUM)){
                $tpayment = $row[5];
                $dpay = number_format($row[5]*1000,2);
                echo '<td>'.$row[1].'</td>';
                echo '<td>'.$row[2].'</td>';
                echo '<td>'.$row[4].'</td>';
                echo '<td>'.$dpay.' Ksh</td>';
              }
            ?>

          </tr>
        </tbody>
      </table>
      <?php
        if( $tpayment>=5 ) {
              echo "<div style='padding: 6px 12px; border: 1px solid #ccc; background-color:rgba(10, 200, 0, 0.3);'>
                  <h4>Gawn Collection Form !!</h4>
                  <a href='#' ><i class='fa fa-download'></i><b>'.$user.'</b></a><br>
                  You can now download the Gawn Collection Form";
              echo '<a href="gawn/pdf/pdf.php?reg='.$user.'" target="0"><button class="btn btn-primary" style="width:100%"><i class="fa fa-download"></i>Download Gawn Form</button></a>';
              echo '</div>';
              echo '<br>';
        }else{
            echo "<div style='padding: 6px 12px; border: 1px solid #ccc; background-color:rgba(200,0,0, 0.4);'>
                  <h4>Make Payement for gawn Collection !!</h4>
                  <a href='pay.php' style='color:white;'><b>Pay Via M-PESA</b></a><br>
                  You can now download the Gawn Collection Form";
              echo '</div>';
              echo '<br>';
        }
      ?>
    </div>


    <br>

    <div class="container" >
        <div style="padding: 6px 12px; border: 1px solid #ccc;height:auto; verflow: auto;">
          <b>Payments  </b>
       
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
                  <i class="fa fa-angle-right"></i> <a href="https://www.dkut.ac.ke">ICT Helpdesk</a>
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

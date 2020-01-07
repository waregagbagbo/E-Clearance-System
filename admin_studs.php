<?php require('server.php');?>
<?php 
	//session_start(); 

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
  <title>Admin Clearance System</title>
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
      <a class="navbar-brand text-brand" href="index.html">Admin <span class="color-b"> Panel</span></a>
      
      <div class="navbar-collapse collapse justify-content-center" id="navbarDefault">
        <ul class="navbar-nav">
          <li class="nav-item">
            <a class="nav-link" href="admin_index.php">Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="admin_dept.php"> Officers</a>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown"
              aria-haspopup="true" aria-expanded="false">
              Others
            </a>
            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
              <a class="dropdown-item" href="admin_gawn.php">Gawn Officers</a>
              <a class="dropdown-item" href="admin_dd.php">Departments</a>
              <a class="dropdown-item" href="admin_studs.php">Students</a>
            </div>
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

    <div class="container" style="padding: 6px 12px; border: 1px solid #ccc;">
      <h2>STUDENTS REGISTERED IN THE CLEARANCE SYSTEM</h2>
       The following are all the students registered on the clearance system
    </div> 
    <br>
    <div class="container" style="padding: 6px 12px; border: 1px solid #ccc;" id="officers">
      <h2>STUDENTS</h2>
      The registered officers in the System
      <table class="table table-bordered table-striped">
        <thead>
          <tr>
            <th scope="col">Student ID. </th>
            <th scope="col">Registration Number</th>
          </tr>
        </thead>
        <tbody>
          <!-- [ LOOP THE REGISTERED OFFICERS ] -->
            <?php
              
              $user =$_SESSION['username'];
              
				      $sql = "SELECT * FROM users";
              $result = mysqli_query($db, $sql);
        

              while($row = mysqli_fetch_array($result, MYSQLI_NUM)){
                echo '<tr>';
                echo '<td>'.$row[0].'</td>';
                echo '<td>'.$row[1].'</td>';
                echo'</tr>';
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
                    <i class="fa fa-angle-right"></i> <a href="https://conservancy.dkut.ac.ke/">DKUT Conservancy</a>
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
                  <i class="fa fa-angle-right"></i> <a href="https://www.dkut.ac.ke/index.php/upcoming-events/53-uncategorised/192-student-portal">student Portal</a>
                </li>
                <li class="item-list-a">
                  <i class="fa fa-angle-right"></i> <a href="#">staff Portal</a>
                </li>
                <li class="item-list-a">
                  <i class="fa fa-angle-right"></i> <a href="#">Office Extension Memmabers</a>
                </li>
                <li class="item-list-a">
                  <i class="fa fa-angle-right"></i> <a href="https://www.dkut.ac.ke/#">ICT Helpdesk</a>
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

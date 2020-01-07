<?php 
    include ('server.php');
    include('connect-db.php');
    if (isset($_GET['id'])){
        $stdreg = $_GET['id'];
        $dept = $_GET['dept'];
    }
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
      <a class="navbar-brand text-brand" href="index.html">Clearance<span class="color-b">System</span></a>
      
      <div class="navbar-collapse collapse justify-content-center" id="navbarDefault">
        <ul class="navbar-nav">
          <li class="nav-item">
            <a class="nav-link active" href="#">MAP AN ISSUE FOR NOT CLEARING</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>
  <!--/ Nav End /-->


  

  <!--/ Testimonials Star /-->
  <section class="section-testimonials section-t8 nav-arrow-a">
    <div class="container" >
        <div style="padding: 6px 12px; border: 1px solid #ccc;height:auto; verflow: auto;">
        <style>
            .error {
                width: 92%; 
                margin: 0px auto; 
                padding: 10px; 
                border: 1px solid #a94442; 
                color: #a94442; 
                background: #f2dede; 
                border-radius: 5px; 
                text-align: left;
            }
        </style>
        <form action="issues.php" method="post">
            <?php include('errors.php'); ?>

                <!-- [ SELECT LOAN ID ] -->
                <div class="form-group">
                    <label for="student">STUDENT:&nbsp;&nbsp;<b><?php echo $stdreg; ?></b></label><br>
                    <label for="Department">DEPARTMENT: <b><?php echo strtoupper($dept); ?></b></label>
                    
                </div>

                <div class="form-group">
                    <label for="category">Select Category</label>
                    <select type="text" class="form-control" name="category">
                        <option value="DAMAGES">Damages</option>
                        <option value="ARREARS">Arrears</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="description">Description</label>
                    <textarea type="text" class="form-control" name="description"  placeholder="Insert a brief description" ></textarea>
                </div>
                <div class="form-group">
                    <label for="monetaryvalue">Monetary Equivalent</label>
                    <input type="number" class="form-control" name="monetaryvalue"  min="0" max="99999" maxlength="5" placeholder="insert monetary Equivalent" >
                </div>

                <input name="stdreg" value="<?=$stdreg?>" style="opacity: 0;" />
                <input name="dept" value="<?=$dept?>" style="opacity: 0;" />
                <div class="form-group">
                    <button type="submit"  style="width:100%;"class="btn btn-success" name="pin_issue">PIN ISSUE</button>
                </div>
                
            </form>
        </div>
     
    </div>
  </section>
  <!--/ Testimonials End /-->

  <!--/ footer Star /-->
  <section class="section-footer">
    
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

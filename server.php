<?php 
	session_start();

	// variable declaration
	$username = "";
	$email    = "";
	$errors = array(); 
	$_SESSION['success'] = "";
	$cdate =date("y-m-d");
	$ctime = date("h:i:s");
	

	// connect to database
	$db = mysqli_connect('localhost', 'root', '', 'dkut_clearance_system');

	// REGISTER USER
	if (isset($_POST['reg_user'])) {
		// receive all input values from the form
		$username = mysqli_real_escape_string($db, $_POST['username']);
		$email = mysqli_real_escape_string($db, $_POST['email']);
		$password_1 = mysqli_real_escape_string($db, $_POST['password_1']);
		$password_2 = mysqli_real_escape_string($db, $_POST['password_2']);

		// form validation: ensure that the form is correctly filled
		if (empty($username)) { array_push($errors, "Username is required"); }
		if (empty($email)) { array_push($errors, "Email is required"); }
		if (empty($password_1)) { array_push($errors, "Password is required"); }

		if ($password_1 != $password_2) {
			array_push($errors, "The two passwords do not match");
		}

		// register user if there are no errors in the form
		if (count($errors) == 0) {
			$password = md5($password_1);//encrypt the password before saving in the database
			$username = strtoupper($username);
			$status = "PENDING";
			$query = "INSERT INTO users (username, email, password) 
					  VALUES('$username', '$email', '$password')";
			mysqli_query($db, $query);

			$query2 = "INSERT INTO clearance (student_reg, cod, librarian, housekeeper, dean_of_students, sports_officer, registrar, finance) 
					  		VALUES('$username', '$status', '$status','$status', '$status','$status', '$status','$status')";
			mysqli_query($db, $query2);

			$_SESSION['username'] = $username;
			$_SESSION['success'] = "You are now logged in";
			header('location: index.php');
		}

	}

	// ... 

	// LOGIN USER
	if (isset($_POST['login_user'])) {
		$username = mysqli_real_escape_string($db, $_POST['username']);
		$password = mysqli_real_escape_string($db, $_POST['password']);

		if (empty($username)) {
			array_push($errors, "Username is required");
		}
		if (empty($password)) {
			array_push($errors, "Password is required");
		}

		if (count($errors) == 0) {
			$password = md5($password);
			$query = "SELECT * FROM users WHERE username='$username' AND password='$password'";
			$results = mysqli_query($db, $query);

			if (mysqli_num_rows($results) == 1) {
				$_SESSION['username'] = $username;
				$_SESSION['success'] = "You are now logged in";
				header('location: index.php');
			}else {
				array_push($errors, "Wrong username/password combination");
			}
		}
	}

	// :::::::::::: ADMIN ::::::::::::::::::::::::::
	//REGISTER ADMIN
	if (isset($_POST['admin_reg'])) {
		// receive all input values from the form
		$username = mysqli_real_escape_string($db, $_POST['username']);
		$email = mysqli_real_escape_string($db, $_POST['email']);
		$password_1 = mysqli_real_escape_string($db, $_POST['password_1']);
		$password_2 = mysqli_real_escape_string($db, $_POST['password_2']);

		// form validation: ensure that the form is correctly filled
		if (empty($username)) { array_push($errors, "Username is required"); }
		if (empty($email)) { array_push($errors, "Email is required"); }
		if (empty($password_1)) { array_push($errors, "Password is required"); }

		if ($password_1 != $password_2) {
			array_push($errors, "The two passwords do not match");
		}

		// register user if there are no errors in the form
		if (count($errors) == 0) {
			$password = md5($password_1);//encrypt the password before saving in the database
			$username = strtoupper($username);
			$status = "PENDING";
			$query = "INSERT INTO admins (username, email, password) 
					  VALUES('$username', '$email', '$password')";
			mysqli_query($db, $query);

			$_SESSION['username'] = $username;
			$_SESSION['success'] = "You are now logged in";
			header('location: admin_index.php');
		}

	}

	// LOGIN ADMIN
	if (isset($_POST['login_admin'])) {
		$username = mysqli_real_escape_string($db, $_POST['username']);
		$password = mysqli_real_escape_string($db, $_POST['password']);

		if (empty($username)) {
			array_push($errors, "Username is required");
		}
		if (empty($password)) {
			array_push($errors, "Password is required");
		}

		if (count($errors) == 0) {
			$password = md5($password);
			$query = "SELECT * FROM admins WHERE username='$username' AND password='$password'";
			$results = mysqli_query($db, $query);

			if (mysqli_num_rows($results) == 1) {
				$_SESSION['username'] = $username;
				// $_SESSION['success'] = "You are now logged in";
				header('location: admin_index.php');
			}else {
				array_push($errors, "Wrong username/password combination");
			}
		}
	}

	//REGISTER DEPERTMENT
	if (isset($_POST['add_dept'])) {
		// receive all input values from the form
		$username = mysqli_real_escape_string($db, $_POST['username']);
		$password_1 = mysqli_real_escape_string($db, $_POST['password_1']);
		$password_2 = mysqli_real_escape_string($db, $_POST['password_2']);
		$dept = mysqli_real_escape_string($db, $_POST['dept']);

		// form validation: ensure that the form is correctly filled
		if (empty($username)) { array_push($errors, "Username is required"); }
		if (empty($password_1)) { array_push($errors, "Password is required"); }
		if (empty($password_1)) { array_push($errors, "you must confirm password"); }

		if ($password_1 != $password_2) {
			array_push($errors, "The two passwords do not match");
		}

		// register user if there are no errors in the form
		if (count($errors) == 0) {
			$password = md5($password_1);//encrypt the password before saving in the database
			$username = strtoupper($username);
			$query = "INSERT INTO depertment_officers(username, password, departmment,dateadded) 
						VALUES('$username', '$password', '$dept', '$cdate')";
			mysqli_query($db, $query);
			

			header('location: admin_dept.php');
		}


	}

	//LOGIN DEPERTMENT
	if (isset($_POST['login_dept'])) {
		$username = mysqli_real_escape_string($db, $_POST['username']);
		$password = mysqli_real_escape_string($db, $_POST['password']);

		if (empty($username)) {
			array_push($errors, "Username is required");
		}
		if (empty($password)) {
			array_push($errors, "Password is required");
		}

		if (count($errors) == 0) {
			$password = md5($password);
			$username = strtoupper($username);
			$query = "SELECT * FROM depertment_officers WHERE username='$username' AND password='$password'";
			$results = mysqli_query($db, $query);

			if (mysqli_num_rows($results) == 1) {
				$_SESSION['username'] = $username;
				$_SESSION['success'] = "You are now logged in";
				header('location: dept_index.php');
			}else {
				array_push($errors, "Wrong username/password combination");
			}
		}
	}
	
	if (isset($_POST['pin_issue'])){
		$stdreg = mysqli_real_escape_string($db, $_POST['stdreg']);
		$dept = mysqli_real_escape_string($db, $_POST['dept']);
		$category = mysqli_real_escape_string($db, $_POST['category']);
		$description = mysqli_real_escape_string($db, $_POST['description']);
		$money = mysqli_real_escape_string($db, $_POST['monetaryvalue']);

		if (empty($description)) { array_push($errors, "Insert a brief Description"); }
		if (empty($money)) { array_push($errors, "Insert Monetary Equivalent"); }

		if(count($errors)==0){
			$query = "INSERT INTO issues (std_reg, department, description, category, monetary_value, datecreated,  timecereated) 
						 VALUES('$stdreg', '$dept', '$description','$category', '$money','$cdate', '$ctime')";
			mysqli_query($db, $query);

			$query1 ="UPDATE clearance SET $dept='ISSUE' where student_reg='$stdreg'";
			mysqli_query($db, $query1);


			header('location: dept_index.php');
		}
	}

	if (isset($_POST['add_gawn'])) {
		// receive all input values from the form
		$username = mysqli_real_escape_string($db, $_POST['username']);
		$email = mysqli_real_escape_string($db, $_POST['email']);
		$password_1 = mysqli_real_escape_string($db, $_POST['password_1']);
		$password_2 = mysqli_real_escape_string($db, $_POST['password_2']);

		// form validation: ensure that the form is correctly filled
		if (empty($username)) { array_push($errors, "Username is required"); }
		if (empty($password_1)) { array_push($errors, "Password is required"); }
		if (empty($password_1)) { array_push($errors, "you must confirm password"); }

		if ($password_1 != $password_2) {
			array_push($errors, "The two passwords do not match");
		}

		// register user if there are no errors in the form
		if (count($errors) == 0) {
			$password = md5($password_1);//encrypt the password before saving in the database
			//$username = strtoupper($username);
			$query = "INSERT INTO gawnofficer (username, email, password, dateadded) 
						VALUES('$username','$email','$password','$cdate')";
			mysqli_query($db, $query);
			

			header('location: admin_gawn.php');
		}


	}
?>
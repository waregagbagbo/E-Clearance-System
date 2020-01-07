<?php include('server.php') ?>
<!DOCTYPE html>
<html>
<head>
	<title>Dedan Kimathi Clearance System</title>
	<link rel="stylesheet" type="text/css" href="style2.css">
</head>
<body>
	<div class="header">
		<h2>Login</h2>
	</div>
	
	<form method="post" action="login.php">

		<?php include('errors.php'); ?>

		<div class="input-group">
			<label>Registration No</label>
			<input type="text" name="username" value="<?php echo $username; ?>">
		</div>
		<div class="input-group">
			<label>Password</label>
			<input type="password" name="password">
		</div>
        <div class="input-group">
			<button type="submit" class="btn" name="login_user">Login</button>
		</div>
        
		<p>
			Not  a Member <a href="register.php">Register</a>
		</p>
	</form>
</body>
</html>
<?php include('server.php') ?>
<!DOCTYPE html>
<html>
<head>
	<title>Register Admin</title>
	<link rel="stylesheet" type="text/css" href="style2.css">
</head>
<body>
	<div class="header">
		<h2>Admin Registration</h2>
	</div>
	
	<form method="post" action="register.php">

		<?php include('errors.php'); ?>

		<div class="input-group">
			<label>Username</label>
			<input type="text" name="username" value="<?php echo $username; ?>">
		</div>
		<div class="input-group">
			<label>Email</label>
			<input type="email" name="email" value="<?php echo $email; ?>">
		</div>
		<div class="input-group">
			<label>Password</label>
			<input type="password" name="password_1">
		</div>
		<div class="input-group">
			<label>Confirm password</label>
			<input type="password" name="password_2">
		</div>
		<div class="input-group">
			<button type="submit" class="btn" name="admin_reg">Register</button>
		</div>
		<p>
			Already an admin? <a href="admin_login.php">Sign in</a>
		</p>
	</form>
</body>
</html>
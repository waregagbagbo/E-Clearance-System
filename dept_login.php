<?php include('server.php') ?>
<!DOCTYPE html>
<html>
<head>
	<title>Registration system PHP and MySQL</title>
	<link rel="stylesheet" type="text/css" href="style2.css">
</head>
<body>

	<div class="header">
		<h2>Login</h2>
	</div>
	
	<form method="post" action="dept_login.php">

		<?php include('errors.php'); ?>

		<div class="input-group">
			<label>Department UserName.</label>
			<input type="text" name="username" >
		</div>
		<div class="input-group">
			<label>Password</label>
			<input type="password" name="password">
		</div>
		<div class="input-group">
			<button type="submit" class="btn" name="login_dept">Login</button>
		</div>
		<p>
			Login in as Student<a href="login.php"> here </a>
		</p>
	</form>


</body>
</html>
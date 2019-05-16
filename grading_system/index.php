<?php
ob_start();
session_start();
if ($_SESSION['logged'] == true) {
	header("Location: home.php");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Login page</title>
	<link href="css/bootstrap.min.css" rel="stylesheet">
	<link href="css/style.css" rel="stylesheet">


	<!--[if lt IE 9]>
	<script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
	<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
	<![endif]-->
</head>
<body>

<link href="//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">

<form method="post" action="login.php">
	<div class="container vertical-center">
		<div class="row">
			<div class="col-md-offset-5 col-md-3">
				<div class="form-login">
					<h4>Welcome Back</h4>
					<input type="text" id="username" class="form-control input-sm chat-input" name="username"
						   placeholder="username"/>
					</br>
					<input type="password" id="password" class="form-control input-sm chat-input" name="password"
						   placeholder="password"/>
					</br>
					<div class="wrapper">
            <span class="group-btn">
                <input type="submit" class="btn btn-primary btn-m" name="submit" value="Login"/>
				<a href="signup.php" class="btn btn-primary btn-m">Sign Up</a>
            </span>
					</div>
				</div>

			</div>
		</div>
	</div>
</form>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="js/bootstrap.min.js"></script>
</body>
</html>
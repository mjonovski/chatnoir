<?php
ob_start();
session_start();
if ($_SESSION['logged'] == true) {
	header("Location: home.php");
}

if (!isset($_POST['username']) || !isset($_POST['password']) || !isset($_POST['type'])) {
	header("Location: index.php");
}

include('inc/database.php');
include('inc/lib.php');

$page = 'login';
$username = mysqli_real_escape_string($link, $_POST['username']);
$result = mysqli_query($link, 'SELECT * FROM user WHERE username="' . $username . '"');
if (mysqli_num_rows($result) > 0) {
	$message = "Username already exists go back and choose different username";
	$page = 'signup';
} else {
	$salt = generateRandomString(10);
	$saltedPassword = $salt . mysqli_real_escape_string($link, $_POST['password']);
	$shaPassword = hash('sha512', $saltedPassword);
	$type = mysqli_real_escape_string($link, $_POST['type']);
	$username = mysqli_real_escape_string($link, $_POST['username']);
	mysqli_query($link, 'INSERT INTO user (`username`,`password`,`type`,`salt`) VALUES("' . $username . '","' . $shaPassword . '",' . $type . ',"' . $salt . '")');
	$message = "Successfull registration. You can proceed to login now.";
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Signup result</title>
	<link href="css/bootstrap.min.css" rel="stylesheet">
	<link href="css/style.css" rel="stylesheet">

	<!--[if lt IE 9]>
	<script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
	<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
	<![endif]-->
</head>
<body>

<div class="container vertical-center">
	<div class="row">
		<div class="col-md-offset-5 col-md-3">
			<?php echo $message; ?>
		</div>
		<br/>
		<hr/>
		<div class="clearfix"></div>
		<div class="col-md-offset-5 col-md-3">
			<a href="<?php echo $page; ?>.php"><?php echo ucfirst($page); ?></a>
		</div>
	</div>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="js/bootstrap.min.js"></script>
</body>
</html>
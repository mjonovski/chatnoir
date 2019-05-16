<?php
ob_start();
session_start();
if (!isset($_POST['username']) || !isset($_POST['password'])) {
	header("Location: index.php");
}

include('inc/database.php');

$username = mysqli_real_escape_string($link, $_POST['username']);
$result = mysqli_query($link, 'SELECT * FROM user WHERE username="' . $username . '"');

if (mysqli_num_rows($result) == 0) {
	$message = "Wrong username or password. Try again";
} else {
	$userData = mysqli_fetch_object($result);
	$password = $userData->salt . mysqli_real_escape_string($link, $_POST['password']);
	$saltedPassword = hash('sha512', $password);
	if ($saltedPassword == $userData->password) {
		$sessionId = session_id();
		$_SESSION['logged'] = true;
		$_SESSION['user_id'] = $userData->id;
		$_SESSION['username'] = $userData->username;
		$_SESSION['type'] = $userData->type;

		$sessionUser = mysqli_query($link, 'SELECT * FROM user_session WHERE user_id=' . $userData->id . ' AND valid=1 ORDER BY id DESC');
		if (mysqli_num_rows($sessionUser) > 0) {
			$differentSession = true;
			$sessionUser = mysqli_fetch_object($sessionUser);
			if($sessionUser->hash!=$sessionId) {
				mysqli_query($link,'UPDATE user_session SET valid=0 WHERE user_id=' . $userData->id);
				mysqli_query($link, 'INSERT INTO user_session (`user_id`,`hash`) VALUES(' . $userData->id . ',"' . $sessionId . '")');
			}
		} else {
			mysqli_query($link, 'INSERT INTO user_session (`user_id`,`hash`) VALUES(' . $userData->id . ',"' . $sessionId . '")');
		}

		header("Location: home.php");
	} else {
		$message = "Wrong username or password. Try again!";
	}
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

<div class="container vertical-center">
	<div class="row">
		<div class="col-md-offset-5 col-md-3">
			<?php echo $message; ?>
		</div>
	</div>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="js/bootstrap.min.js"></script>
</body>
</html>
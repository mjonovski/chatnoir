<?php
ob_start();
session_start();
include('database.php');
$sessionId = session_id();
$result = mysqli_query($link, 'SELECT * FROM user_session WHERE valid=1 AND user_id=' . $_SESSION['user_id']);
if (mysqli_num_rows($result) === 0) {
	header("Location: index.php");
} else {
	$userSession = mysqli_fetch_object($result);
	if ($userSession->hash != $sessionId) {
		session_destroy();
		header("Location: index.php");
	}
}
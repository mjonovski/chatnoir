<?php
ob_start();
session_start();
include("inc/database.php");
mysqli_query($link, "UPDATE user_session SET valid=0 WHERE user_id" . $_SESSION['user_id']);
session_destroy();
header("Location: index.php");
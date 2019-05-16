<?php

$db_user = "root";
$db_password = "spawner29";
$db_name = "grading_system";
$db_host = "localhost";

$password_salt = "petko";

$link = @mysqli_connect($db_host, $db_user, $db_password, $db_name);

if(!$link) {
	echo "Could not connect to mysql database";
	die();
}
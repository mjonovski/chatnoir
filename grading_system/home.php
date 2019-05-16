<?php
include('inc/validate_check.php');


if($_SESSION['type']==0) {
	include('inc/student.php');
} else {
	include('inc/profesor.php');
}
?>
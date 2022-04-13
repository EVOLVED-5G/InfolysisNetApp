<?php
require_once('functions.php');
session_start();


	unset($_SESSION['logged_in']);
	unset($_SESSION['username']);
	unset($_SESSION['SESS_MEMBER_ID']);
	unset($_SESSION['name']);
	unset($_SESSION['surname']);
	unset($_SESSION['role']);
	unset($_SESSION['LAST_ACTIVITY']);
	session_destroy();
	redirect('index.php');
?>


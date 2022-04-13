<?php
	//Start session
	session_start();

	include ('functions.php');

	if (isset($_SESSION['LAST_ACTIVITY']) && (time() - $_SESSION['LAST_ACTIVITY'] > 1800)) {
    // last request was more than 30 minutes ago
    	session_unset();     // unset $_SESSION variable for the run-time 
    	session_destroy();   // destroy session data in storage
    	redirect('login.php');
	}
	$_SESSION['LAST_ACTIVITY'] = time(); // update last activity time stamp

	
	//Check whether the session variable SESS_MEMBER_ID is present or not
	if(!isset($_SESSION['SESS_MEMBER_ID']) || (trim($_SESSION['SESS_MEMBER_ID']) == '')) {
		redirect('accessdenied.php');
		exit();
	}
?>

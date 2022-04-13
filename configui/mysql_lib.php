<?php

require_once('config.php');

function m_connect($host,$user,$pass,$db){
	$link = mysqli_connect($host, $user, $pass, $db);
	//$link->set_charset('utf16');
	//$link->query("SET collation_connection = utf8mb4_unicode_ci");
	if (!$link) {
	    die('Could not connect: ' . mysqli_connect_error());
	}
	return $link;
}

function m_execute_query($con, $query){
	$result = mysqli_query($con, $query);
	if (!$result) {
	    die('Invalid query: ' . mysqli_error($con));
	}
	return $result;
}



?>

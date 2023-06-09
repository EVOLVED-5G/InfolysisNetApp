<?php
require_once('config.php');
require_once('functions.php');
include('mysql_lib.php');

session_start();

	if  ( (!isset($_POST ['username'])) || (!isset($_POST['password'])) OR 
		(!ctype_alnum($_POST['username'])) ) {
			redirect('index.php');
	}
	
	

	$con = m_connect(DB_HOSTNAME, DB_USERNAME, DB_PASSWORD, DB_DATABASE);
	mysqli_set_charset($con,"utf8mb4");
	$username = $_POST['username'];
	$username = clean($con, $username);
	$password = $_POST['password'];
	$password = clean($con, $password);
	$password = sha1($password);

	

	$sql_chatbot_admins = "SELECT * FROM  admins WHERE username = '$username' AND  password='$password' limit 0,1";
	$result_chatbot_admins = m_execute_query($con, $sql_chatbot_admins);


	if (mysqli_num_rows($result_chatbot_admins) == 1) {
		while ($row_chatbot_admins = mysqli_fetch_assoc($result_chatbot_admins)) {
		$id = $row_chatbot_admins["id"];
		$role = $row_chatbot_admins['role'];
		}


		$name = 'INFOLYSiS';
		$surname = '';
		// if ($id == -99){
		// 	$name = 'INFOLYSiS';
		// 	$surname = '';
		// }
		// else{
		// 	$sql = "SELECT * FROM feedback_customers WHERE id = '$id' limit 0,1";
		// 	$result = m_execute_query($con, $sql);
		// 	while ($row = mysqli_fetch_assoc($result)) {
		// 		$name = $row["name"];
		// 		$surname = $row["surname"];
		// 	}
		// }
			session_regenerate_id();
			$_SESSION['SESS_MEMBER_ID']=$id;
			$_SESSION['logged_in'] = true;
			$_SESSION['username'] = $username;
			$_SESSION['name'] = $name;
			$_SESSION['surname'] = $surname;
			$_SESSION['role'] = $role;
			$_SESSION['LAST_ACTIVITY'] = time();
			
			// date_default_timezone_set("Europe/Athens");
			// $date = date("Y-m-d H:i:s");
			// $sql2 = "update feedback_admins set last_login='$date' where username='$username'";
			// $result2 = m_execute_query($con, $sql2);
			
			redirect('users.php');
	
	}else{

		redirect('index.php?failed=true');
	}
mysqli_close($con);

?>

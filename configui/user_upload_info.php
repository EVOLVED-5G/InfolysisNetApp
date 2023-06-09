
<?php 
include ('auth.php');
require_once('config.php');
require_once('functions.php');
include('mysql_lib.php');
	
	$con = m_connect(DB_HOSTNAME, DB_USERNAME, DB_PASSWORD, DB_DATABASE);
	mysqli_set_charset($con,"utf8mb4");

	$user_id = NULL;
	$user_name = NULL;
	$user_surname = NULL;
	$user_role = NULL;
	$user_email = NULL;
	$user_areas = NULL;
	if (isset($_POST['user_id'])){$user_id=$_POST['user_id'];}
	if (isset($_POST['user_name'])){$user_name=$_POST['user_name'];}
	if (isset($_POST['user_surname'])){$user_surname=$_POST['user_surname'];}
	if (isset($_POST['user_role'])){$user_role=$_POST['user_role'];}
	if (isset($_POST['user_email'])){$user_email=$_POST['user_email'];}
	if (isset($_POST['user_areas'])){$user_areas=$_POST['user_areas'];}


	if ($user_id != NULL) {
		$sql ="UPDATE users SET name='$user_name', surname='$user_surname', role='$user_role', email='$user_email', user_areas = '$user_areas' WHERE id='$user_id'";
		$result = m_execute_query($con, $sql);
		if($result){
			echo "user updated";
		}
		else{
			echo "Error in updating user";
		}
	}
	else{
		$sql = "INSERT INTO users VALUES (DEFAULT,'$user_name','$user_surname','$user_role','$user_email','$user_areas',1)";
		$result = m_execute_query($con, $sql);
		if($result){
			echo "New user created";
		}
		else{
			echo "Error in creating user";
		}
	}

?>

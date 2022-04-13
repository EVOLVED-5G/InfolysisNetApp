
<?php 
include ('auth.php');
require_once('config.php');
require_once('functions.php');
include('mysql_lib.php');
	
	$con = m_connect(DB_HOSTNAME, DB_USERNAME, DB_PASSWORD, DB_DATABASE);
	mysqli_set_charset($con,"utf8mb4");

	$area_id = NULL;
	$area_name = NULL;
	$antenna = NULL;
	$coordinates = NULL;
	if (isset($_POST['area_id'])){$area_id=$_POST['area_id'];}
	if (isset($_POST['area_name'])){$area_name=$_POST['area_name'];}
	if (isset($_POST['antenna'])){$antenna=$_POST['antenna'];}
	if (isset($_POST['coordinates'])){$coordinates=$_POST['coordinates'];}


	if ($area_id != NULL) {
		$sql ="UPDATE areas SET name='$area_name', antenna='$antenna', coordinates='$coordinates' WHERE id='$area_id'";
		$result = m_execute_query($con, $sql);
		if($result){
			echo "area updated";
		}
		else{
			echo "Error in updating area";
		}
	}
	else{
		$sql = "INSERT INTO areas VALUES (DEFAULT,'$area_name','$antenna','$coordinates',1)";
		$result = m_execute_query($con, $sql);
		if($result){
			echo "New area created";
		}
		else{
			echo "Error in creating area";
		}
	}

?>

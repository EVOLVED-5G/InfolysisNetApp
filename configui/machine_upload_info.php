
<?php 
include ('auth.php');
require_once('config.php');
require_once('functions.php');
include('mysql_lib.php');
	
	$con = m_connect(DB_HOSTNAME, DB_USERNAME, DB_PASSWORD, DB_DATABASE);
	mysqli_set_charset($con,"utf8mb4");

	$machine_id = NULL;
	$machine_name = NULL;
	$machine_area = NULL;
	$machine_status = NULL;
	if (isset($_POST['machine_id'])){$machine_id=$_POST['machine_id'];}
	if (isset($_POST['machine_name'])){$machine_name=$_POST['machine_name'];}
	if (isset($_POST['machine_area'])){$machine_area=$_POST['machine_area'];}
	if (isset($_POST['machine_status'])){$machine_status=$_POST['machine_status'];}


	if ($machine_id != NULL) {
		$sql ="UPDATE machines SET name='$machine_name', area='$machine_area', status='$machine_status' WHERE id='$machine_id'";
		$result = m_execute_query($con, $sql);
		if($result){
			echo "machine updated";
		}
		else{
			echo "Error in updating machine";
		}
	}
	else{
		$sql = "INSERT INTO machines VALUES (DEFAULT,'$machine_name','$machine_area','$machine_status',1)";
		$result = m_execute_query($con, $sql);
		if($result){
			echo "New machine created";
		}
		else{
			echo "Error in creating machine";
		}
		$sql_machine_id = 'SELECT id FROM machines ORDER BY id DESC LIMIT 1';
		$result_machine_id = m_execute_query($con, $sql_machine_id);
		$row_machine_id = mysqli_fetch_row($result_machine_id);
		$machine_id = $row_machine_id[0];
		$machine_folder = 'uploads/machine_id_'.$machine_id.'/';
		if (!is_dir('uploads')) {
			mkdir('uploads');
		}
		mkdir($machine_folder);

	}

?>


<?php 
include ('auth.php');
require_once('config.php');
require_once('functions.php');
include('mysql_lib.php');
	
	$con = m_connect(DB_HOSTNAME, DB_USERNAME, DB_PASSWORD, DB_DATABASE);
	mysqli_set_charset($con,"utf8mb4");

	$incident_id = NULL;
	$incident_name = NULL;
	$incident = NULL;
	$incidenttype = NULL;
	$incidentlocation = NULL;
	$incident_user = NULL;
	$incident_machine = NULL;
	if (isset($_POST['incident_id'])){$incident_id=$_POST['incident_id'];}
	if (isset($_POST['incident_name'])){$incident_name=$_POST['incident_name'];}
	if (isset($_POST['incident'])){$incident=$_POST['incident'];}
	if (isset($_POST['incidenttype'])){$incidenttype=$_POST['incidenttype'];}
	if (isset($_POST['incidentlocation'])){$incidentlocation=$_POST['incidentlocation'];}
	if (isset($_POST['incident_user'])){$incident_user=(int)$_POST['incident_user'];}
	if (isset($_POST['incident_machine'])){$incident_machine=$_POST['incident_machine'];}


	if ($incident_id != NULL) {
		$sql ="UPDATE incidents SET name='$incident_name', incident='$incident', incidenttype='$incidenttype', incidentlocation='$incidentlocation', user_id='$incident_user', machine_id='$incident_machine' WHERE id='$incident_id'";
		$result = m_execute_query($con, $sql);
		if($result){
			echo "incident updated";
		}
		else{
			echo "Error in updating incident";
		}
	}
	else{
		$sql = "INSERT INTO incidents VALUES (DEFAULT,'$incident_name',$incident,'$incidenttype','$incidentlocation',DEFAULT,'$incident_user','$incident_machine')";
		$result = m_execute_query($con, $sql);
		if($result){
			echo "New incident created";
		}
		else{
			echo "Error in creating incident";
		}
	}

?>

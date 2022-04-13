<?php 
include ('auth.php');
require_once('config.php');
require_once('functions.php');
include('mysql_lib.php');


$con = m_connect(DB_HOSTNAME, DB_USERNAME, DB_PASSWORD, DB_DATABASE);
mysqli_set_charset($con,"utf8mb4");
$machine_id = htmlspecialchars($_GET["machine_id"]);



if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  if (isset($_FILES['files'])) {
    $errors = [];
    $path = 'uploads/machine_id_'.$machine_id.'/';
    $extensions = ['jpg', 'jpeg', 'png', 'gif', 'txt', 'pdf', 'doc'];
    
    $all_files = count($_FILES['files']['tmp_name']);
    if (!is_dir('uploads')) {
      mkdir('uploads');
    }else{
      if (!is_dir($path)) {
        mkdir($path);
      }
    }

    for ($i = 0; $i < $all_files; $i++) {  
      $file_name = $_FILES['files']['name'][$i];
      $file_tmp = $_FILES['files']['tmp_name'][$i];
      $file_type = $_FILES['files']['type'][$i];
      $file_size = $_FILES['files']['size'][$i];
      $tmp = explode('.', $_FILES['files']['name'][$i]);
      $file_ext = strtolower(end($tmp));

      $file = $path . $file_name;

      if (!in_array($file_ext, $extensions)) {
        $errors[] = 'Extension not allowed: ' . $file_name . ' ' . $file_type;
      }

      if ($file_size > 2097152) {
        $errors[] = 'File size exceeds limit: ' . $file_name . ' ' . $file_type;
      }

      if (empty($errors)) {
        move_uploaded_file($file_tmp, $file);
      }


      if ($machine_id != NULL) {
        $sql = "INSERT INTO files VALUES (DEFAULT,'$file_name','$file','$machine_id',1)";
        $result = m_execute_query($con, $sql);
        if($result){
          echo "New file created";
        }
        else{
          echo "Error in creating file";
        }
      }
      else{
        echo "Error no machine id";
      }




    }

    if ($errors) print_r($errors);
  }

}
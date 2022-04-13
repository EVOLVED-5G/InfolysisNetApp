<?php


include ('auth.php');
require_once('config.php');
require_once('functions.php');
include('mysql_lib.php');

$con = m_connect(DB_HOSTNAME, DB_USERNAME, DB_PASSWORD, DB_DATABASE);
mysqli_set_charset($con,"utf8mb4");

$sql = "select * from users where id = ".htmlspecialchars($_GET["user_id"]);
$result = m_execute_query($con, $sql);
$row = mysqli_fetch_array($result);

?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>INFOLYSiS Nettapp Config| Αρχική</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="bower_components/bootstrap/dist/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="bower_components/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="bower_components/Ionicons/css/ionicons.min.css">
  <!-- Tables -->
  <link rel="stylesheet" href="bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">
  <link rel="stylesheet" href="bower_components/datatables.net-bs/css/dataTables.bootstrap.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/AdminLTE.min.css">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="dist/css/skins/_all-skins.min.css">
  <link rel="stylesheet" href="bower_components/select2/dist/css/select2.css">

  <style>

.select2-container--default .select2-results > .select2-results__options {
    max-height: 300px;
    min-height: 50px;
    overflow-y: auto;
}
  </style>

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<!-- ADD THE CLASS layout-top-nav TO REMOVE THE SIDEBAR. -->
<body class="hold-transition skin-purple layout-top-nav">
<div class="wrapper">

  <header class="main-header">
    <nav class="navbar navbar-static-top">
      <div class="container">
        <div class="navbar-header">
          <a href="index.php" class="navbar-brand"><b>INFOLYSiS</b></a>
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse">
            <i class="fa fa-bars"></i>
          </button>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse pull-left" id="navbar-collapse">
          <ul class="nav navbar-nav">
 
            <li class="active"><a href="users.php">Users <span class="sr-only">(current)</span></a></li>
            <li><a href="areas.php">Areas</a></li>
            <li><a href="machines.php">Machines</a></li>
            <li><a href="incidents.php">Incidents</a></li>
            <li><a href="files.php">Files</a></li>
          </ul>
          
        </div>
        <!-- /.navbar-collapse -->
        <!-- Navbar Right Menu -->
        <div class="navbar-custom-menu">
          <ul class="nav navbar-nav">
            

            
            <!-- User Account Menu -->
            <li class="dropdown user user-menu">
              <!-- Menu Toggle Button -->
              <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                <!-- The user image in the navbar-->
                <img src="dist/img/avatar2.png" class="user-image" alt="User Image">
                <!-- hidden-xs hides the username on small devices so only the image appears. -->
                <span class="hidden-xs"><?php echo $_SESSION['username']; ?></span>
              </a>
              <ul class="dropdown-menu">
                <!-- The user image in the menu -->
                <li class="user-header">
                  <img src="dist/img/avatar2.png" class="img-circle" alt="User Image">

                  <p>
                    <?php echo $_SESSION['username']; ?><br><?php echo $_SESSION['name']." ".$_SESSION['surname']; ?>
                  </p>
                </li>
                
                <!-- Menu Footer-->
                <li class="user-footer">
                  <div class="pull-left">
                    <a href="signout.php" class="btn btn-default btn-flat">Create new user</a>
                  </div>
                  <div class="pull-right">
                    <a href="signout.php" class="btn btn-default btn-flat">Log Out</a>
                  </div>
                </li>
              </ul>
            </li>
          </ul>
        </div>
        <!-- /.navbar-custom-menu -->
      </div>
      <!-- /.container-fluid -->
    </nav>
  </header>


  <!-- Full Width Column -->
  <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <section class="content-header">
        <div class="col-md-12">
          <?php 
            echo "<h1>
              User : ".$row['name']." ".$row['surname']."
            </h1>"; 
          ?>
        </div>
      </section>

      <!-- Main content -->
      <section class="content">
        <div class="row">
          <div class="col-md-12">
            <div class="box">
              <div id="user_selection">
                <nav class="navbar navbar-default">
                    <ul class="nav navbar-nav">
                      <?php
                      echo '<li class="active" id="user_info"><a href="user_info.php?user_id='.htmlspecialchars($_GET["user_id"]).'">Info<i class="fa fa-fw fa-info-circle"></i><span class="sr-only">(current)</span></a></li>';
                      echo '<li id="user_areas"><a href="user_profiles.php?user_id='.htmlspecialchars($_GET["user_id"]).'">Areas<i class="fa fa-fw fa-map"></i></a></li>';
                      echo '<li id="user_incidents"><a href="user_incidents.php?user_id='.htmlspecialchars($_GET["user_id"]).'">Incidents<i class="fa fa-fw fa-wrench"></i></a></li>';                      
                      ?>
                    </ul>         
                </nav>
              </div>
              <!-- /.box-header -->
              <div class="box-body">
                <div class="row">
                  <div class="col-md-12">
                    <div class="card">
                      <div class="card-header">
                        <h3 class="card-title text-center">User Information</h3>
                      </div>
                      <!-- /.card-header -->
                      <div class="card-body">
                          <form  role="form" method="post" id="user_form">
                            <div class="form-group">                              
                              <label>Name</label>
                        <?php echo "<input type='text' name='user_name' id='user_name_id' class='form-control' placeholder='Enter Name...' value='".$row["name"]."'>";?>
                            </div>
                            <div class="form-group">
                              <label>Surname</label>
                  <?php echo "<input type='text' name='user_surname' id='user_surname_id' class='form-control' placeholder='Enter Surname...' value='".$row["surname"]."'>";?>
                            </div>
                            <div class="form-group">
                              <label>User Role</label>
                              <select id="user_role_id" class="form-control" name="user_role">
                                <option value="-1">Choose...</option>
                                <option value="role_1" <?php if ($row["role"]=="role_1") echo "selected";?>>role_1</option>
                                <option value="role_2" <?php if ($row["role"]=="role_2") echo "selected";?>>role_2</option>
                                <option value="role_3" <?php if ($row["role"]=="role_3") echo "selected";?>>role_3</option>
                                <option value="role_4" <?php if ($row["role"]=="role_4") echo "selected";?>>role_4</option>
                              </select>
                            </div>
                            <div class="form-group">
                              <label>Email</label>
                    <?php echo "<input type='text' name='user_email' id='user_email_id' class='form-control' placeholder='Enter Email...' value='".$row["email"]."'>";?>
                            </div>

                            <div class="form-group">
                              <label>User Areas</label>
                              <?php

                                  echo "<select id=\"user_areas_id\" style=\"width: 100%;\" tabindex=\"-1\" class=\"form-control select2 select2-hidden-accessible\" name=\"user_areas\" data-placeholder=\"Choose Area\" multiple=\"\">";


                                  $sql_user_areas = "select * from areas";
                                  $result_user_areas = m_execute_query($con, $sql_user_areas);
                                  while($row_user_areas = mysqli_fetch_array($result_user_areas)){
                                    $area = (string)$row_user_areas["id"];
                                    if (strpos($row["user_areas"],$area)!== false) {
                                      $selected1=" selected";
                                    }
                                    else{
                                      $selected1="";
                                    }
                                    echo "<option value='".$row_user_areas['id']."'$selected1>".$row_user_areas['name']."</option>";
                                  }
                                ?>
                              </select>
                            </div>

                            
                          </form>
                          <div class="col-sm-2 col-sm-offset-2" id="cancel_button">
                            <button id="cancel_update_button" type="button" class="btn btn-block btn-warning" >Cancel</button>
                          </div>

                          <div class="col-sm-2 col-sm-offset-4" id="update_button">
                            <button type="button" class="btn btn-block btn-success" id="user_info_update"><i class="fa fa-fw fa-save"></i>Update</button>
                          </div>
                      </div>
                      <!-- /.card-body -->
                    </div>  
                  </div>
                  <!-- /.col -->          
                </div>
                <!-- /.row -->
              </div>
              <!-- ./box-body -->
            </div>
            <!-- /.box -->
          </div>
          <!-- /.col -->
        </div>
      </section>
      <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->


  <footer class="main-footer">
    <div class="container">
      <div class="pull-right hidden-xs">
        <b>Version</b> 1.0.0
      </div>
      <strong>Copyright &copy; 2021 <a href="https://infolysis.gr">INFOLYSiS</a>.</strong> All rights
      reserved.
    </div>
    <!-- /.container -->
  </footer>
</div>
<!-- ./wrapper -->

<!-- jQuery 3 -->
<script src="bower_components/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- SlimScroll -->
<script src="bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
<!-- FastClick -->
<script src="bower_components/fastclick/lib/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="dist/js/demo.js"></script>


<script src="bower_components/select2/dist/js/select2.full.min.js"></script>



<script>

  $(function () {
    //Initialize Select2 Elements
    $('.select2').select2();

    $(document.body).on("change",".select2",function(){
      console.log(this.value);
    });

  })

    function Completed_Inputs(){
    if($('#user_name_id')[0].value==''){
      $('#user_name_id')[0].style.borderColor='red';
      $('#user_name_id').focus();
      return false;
    }
    else{
      $('#user_name_id')[0].style.borderColor='';
    }
    if($('#user_surname_id')[0].value==''){
      $('#user_surname_id')[0].style.borderColor='red';
      $('#user_surname_id').focus();
      return false;
    }
    else{
      $('#user_surname_id')[0].style.borderColor='';
    }
    if($('#user_role_id')[0].value==-1){
      $('#user_role_id')[0].style.borderColor='red';
      $('#user_role_id').focus();
      return false;
    }
    else{
      $('#user_role_id')[0].style.borderColor='';
    }
    if($('#user_email_id')[0].value==''){
      $('#user_email_id')[0].style.borderColor='red';
      $('#user_email_id').focus();
      return false;
    }
    else{
      $('#user_email_id')[0].style.borderColor='';
    }
    if($('#user_areas_id')[0].value==''){
      $('#user_areas_id')[0].style.borderColor='red';
      $('#user_areas_id').focus();
      return false;
    }
    else{
      $('#user_areas_id')[0].style.borderColor='';
      return true;
    } 
  }
  
  urlParams = new URLSearchParams(window.location.search);
  user_id = urlParams.get('user_id');

  //Customer update
  $(document).on('click','#user_info_update',function(e) {
    if(Completed_Inputs()){
      var data1 = $("#user_form").serialize();
      var user_areas = 'user_areas=';
      data_fields =data1.split("&");
      data_fields.forEach(userAreas);
      user_areas = user_areas.slice(0, -1);
      data = data1.split("user_areas=")[0]+user_areas;
      data=data + "&user_id=" + user_id;


      function userAreas(item, index) {
        if (item.includes("user_areas=")) {
          user_areas = user_areas+item.split("user_areas=").pop()+","
        }
      }

      $.ajax({
        data: data,
        type: "post",
        url: "user_upload_info.php",
      });
      setTimeout(function () {
       var origin_url = document.referrer;
       window.location.href = origin_url ;
      }, 1000);
    }else{
      alert('Please fill the form we highlight and try again.')
    }
  });

  $(document).on('click','#cancel_update_button',function(e) {
    window.location.reload();
  }); 




</script>


</body>
</html>
<?php 
  mysqli_close($con);
?>
<?php


include ('auth.php');
require_once('config.php');
require_once('functions.php');
include('mysql_lib.php');

$con = m_connect(DB_HOSTNAME, DB_USERNAME, DB_PASSWORD, DB_DATABASE);
mysqli_set_charset($con,"utf8mb4");

$sql = "select * from incidents where id = ".htmlspecialchars($_GET["incident_id"]);
$result = m_execute_query($con, $sql);
$row = mysqli_fetch_array($result);
$sql_user = "select * from users where id = ".$row["user_id"];
$result_user = m_execute_query($con, $sql_user);
$row_user = mysqli_fetch_array($result_user);

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
 
            <li><a href="users.php">Users <span class="sr-only">(current)</span></a></li>
            <li><a href="areas.php">Areas</a></li>
            <li><a href="machines.php">Machines</a></li>
            <li class="active"><a href="incidents.php">Incidents</a></li>
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
            $sql = "SELECT * FROM incidents WHERE id = ".htmlspecialchars($_GET["incident_id"]);
            $result = m_execute_query($con, $sql);
            $row = mysqli_fetch_array($result);
            echo "<h1>
              Incident : ".$row['name']."
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
                      echo '<li id="Incident_info"><a href="incident_info.php?incident_id='.htmlspecialchars($_GET["incident_id"]).'">Info<i class="fa fa-fw fa-info-circle"></i><span class="sr-only">(current)</span></a></li>';
                      echo '<li class="active" id="incident_user"><a href="incident_user.php?user_id='.$row["user_id"].'">User<i class="fa fa-fw fa-user"></i></a></li>';
                                            
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
                        <h3 class="card-title text-center">Incident User</h3>
                      </div>
                      <!-- /.card-header -->
                      <div class="card-body">
                          <form  role="form" method="post" id="user_form">
                            <div class="form-group">                              
                              <label>Name</label>
                        <?php echo "<input type='text' name='user_name' class='form-control' placeholder='Enter Name...' value='".$row_user["name"]."'>";?>
                            </div>
                            <div class="form-group">
                              <label>Surname</label>
                  <?php echo "<input type='text' name='user_surname' class='form-control' placeholder='Enter Surname...' value='".$row_user["surname"]."'>";?>
                            </div>
                            <div class="form-group">
                              <label>User Role</label>
                              <select id="user_role" class="form-control" name="user_role">
                                <option value="-1">Choose...</option>
                                <option value="role_1" <?php if ($row_user["role"]=="role_1") echo "selected";?>>role_1</option>
                                <option value="role_2" <?php if ($row_user["role"]=="role_2") echo "selected";?>>role_2</option>
                                <option value="role_3" <?php if ($row_user["role"]=="role_3") echo "selected";?>>role_3</option>
                                <option value="role_4" <?php if ($row_user["role"]=="role_4") echo "selected";?>>role_4</option>
                              </select>
                            </div>
                            <div class="form-group">
                              <label>Email</label>
                    <?php echo "<input type='text' name='user_email' class='form-control' placeholder='Enter Email...' value='".$row_user["email"]."'>";?>
                            </div>
                            
                          </form>
      <!--                     <div class="col-sm-2 col-sm-offset-2" id="cancel_button">
                            <button id="cancel_update_button" type="button" class="btn btn-block btn-warning" >Cancel</button>
                          </div>

                          <div class="col-sm-2 col-sm-offset-4" id="update_button">
                            <button type="button" class="btn btn-block btn-success" id="user_info_update"><i class="fa fa-fw fa-save"></i>Update</button>
                          </div> -->
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


<script src="bower_components/chart.js/Chart.js"></script>



<script>
  
  urlParams = new URLSearchParams(window.location.search);
  machine_id = urlParams.get('incident_id');

  // $(document).on('click','#machine_info_update',function(e) {
  //   var data = $("#machine_form").serialize();
  //   data=data + "&machine_id=" + machine_id;
  //   $.ajax({
  //     data: data,
  //     type: "post",
  //     url: "machine_upload_info.php",
  //   });
  //   var origin_url = document.referrer;
  //   window.location.href = origin_url ;
  // });

  // $(document).on('click','#cancel_update_button',function(e) {
  //   window.location.reload();
  // }); 




</script>


</body>
</html>
<?php 
  mysqli_close($con);
?>
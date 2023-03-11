<?php
session_start();
/*
 * @author Balaji
 */
 
error_reporting(1);
if(isset($_SESSION['login']))
{

}
else
{
    header("Location: index.php");
    echo '<meta http-equiv="refresh" content="1;url=index.php">';
}
require_once('../config.php');

$date = date('jS F Y');
$ip = $_SERVER['REMOTE_ADDR'];

  $con = mysqli_connect($mysql_host,$mysql_user,$mysql_pass,$mysql_database);

  if (mysqli_connect_errno())
  {
  echo "<br>Failed to connect to MySQL: " . mysqli_connect_error();
  }
    $query =  "SELECT @last_id := MAX(id) FROM admin_history";
    
    $result = mysqli_query($con,$query);
    
    while($row = mysqli_fetch_array($result)) {
    $last_id =  $row['@last_id := MAX(id)'];
    }
    
    $query =  "SELECT * FROM admin_history WHERE id=".Trim($last_id);
    $result = mysqli_query($con,$query);
        
    while($row = mysqli_fetch_array($result)) {
    $last_date =  $row['last_date'];
    $last_ip =  $row['ip'];
    }

    if($last_ip == $ip )
    {
    if($last_date == $date)
    {
        
    }
    else
    {
    $query = "INSERT INTO admin_history (last_date,ip) VALUES ('$date','$ip')"; 
    mysqli_query($con,$query);
    }  
    }
    else
    {
    $query = "INSERT INTO admin_history (last_date,ip) VALUES ('$date','$ip')"; 
    mysqli_query($con,$query);
    }
    
    
    $query =  "SELECT * FROM site_info";
    $result = mysqli_query($con,$query);
        
    while($row = mysqli_fetch_array($result)) {
    $title =  Trim($row['title']);
    $des =   Trim($row['des']);
    $keyword =  Trim($row['keyword']);
    $site_name =   Trim($row['site_name']);
    $email =   Trim($row['email']);
    $twit =   Trim($row['twit']);
    $face =   Trim($row['face']);
    $gplus =   Trim($row['gplus']);
    $ga =   Trim($row['ga']);
    $req =   Trim($row['req']);
    $lm =   Trim($row['lm']);
    }
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8" />
        <title>Admin Section | Dashboard</title>
        <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport' />
        <!-- bootstrap 3.0.2 -->
        <link href="css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <!-- font Awesome -->
        <link href="css/font-awesome.min.css" rel="stylesheet" type="text/css" />
        <!-- Ionicons -->
        <link href="css/ionicons.min.css" rel="stylesheet" type="text/css" />
        <!-- Morris chart -->
        <link href="css/morris/morris.css" rel="stylesheet" type="text/css" />
        <!-- jvectormap -->
        <link href="css/jvectormap/jquery-jvectormap-1.2.2.css" rel="stylesheet" type="text/css" />
        <!-- Daterange picker -->
        <link href="css/daterangepicker/daterangepicker-bs3.css" rel="stylesheet" type="text/css" />
        <!-- bootstrap wysihtml5 - text editor -->
        <link href="css/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css" rel="stylesheet" type="text/css" />
        <!-- Theme style -->
        <link href="css/AdminLTE.css" rel="stylesheet" type="text/css" />

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
          <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
        <![endif]-->
    </head>
    <body class="skin-blue">
        <!-- header logo: style can be found in header.less -->
        <header class="header">
            <a href="manage.php" class="logo">
                <!-- Add the class icon to your logo image or logo icon to add the margining -->
                TurboSpinner
            </a>
            <!-- Header Navbar: style can be found in header.less -->
            <nav class="navbar navbar-static-top" role="navigation">
                <!-- Sidebar toggle button-->
                <a href="#" class="navbar-btn sidebar-toggle" data-toggle="offcanvas" role="button">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </a>
                <div class="navbar-right">
                    <ul class="nav navbar-nav">
                     
                                            <!-- User Account: style can be found in dropdown.less -->
                        <li class="dropdown user user-menu">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <i class="glyphicon glyphicon-user"></i>
                                <span>Admin<i class="caret"></i></span>
                            </a>
                            <ul class="dropdown-menu">
                                <!-- User image -->
                                <li class="user-header bg-light-blue">
                                    <img src="img/admin.jpg" class="img-circle" alt="User Image" />
                                                         <p>
                                        Welcome back, Admin
                                        <small>Manage your site</small>
                                    </p>
                                </li>
                                <!-- Menu Body -->
                                <!-- Menu Footer-->
                                <li class="user-footer">
                                    <div class="pull-left">
                                <a href="../index.php" class="btn btn-default btn-flat">Site Index</a>
                                    </div>
                                    <div class="pull-right">
                                        <a href="logout.php" class="btn btn-default btn-flat">Sign out</a>
                                    </div>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </nav>
        </header>
        <div class="wrapper row-offcanvas row-offcanvas-left">
            <!-- Left side column. contains the logo and sidebar -->
            <aside class="left-side sidebar-offcanvas">
                <!-- sidebar: style can be found in sidebar.less -->
                <section class="sidebar">
                    <!-- Sidebar user panel -->
                    <div class="user-panel">
                        <div class="pull-left image">
                            <img src="img/admin.jpg" class="img-circle" alt="User Image" />
                        </div>
                        <div class="pull-left info">
                            <p>Hello, Admin</p>

                            <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
                        </div>
                    </div>
                    <!-- sidebar menu: : style can be found in sidebar.less -->
                         <ul class="sidebar-menu">
                        <li>
                            <a href="dashboard.php">
                                <i class="fa fa-dashboard"></i> <span>Dashboard</span>
                            </a>
                        </li>
                        <li class="active">
                            <a href="site.php">
                                <i class="fa fa-th"></i> <span>Manage Site</span>
                            </a>
                        </li>
                        <li>
                            <a href="api.php">
                                <i class="fa fa-bar-chart-o"></i> <span>API Access</span> 
                            </a>
                        </li>
                        <li>
                            <a href="acc.php">
                                <i class="fa fa-laptop"></i> <span>Admin Account</span> 
                            </a>
                        </li>
                         <li>
                            <a href="ads.php">
                                <i class="fa fa-thumbs-up"></i> <span>Site Ads</span> 
                            </a>
                        </li>
                        <li>
                            <a href="ban_user.php">
                                <i class="fa fa-group"></i> <span>Ban User</span> 
                            </a>
                        </li>
                                <li>
                            <a href="capthca.php">
                                <i class="fa fa-desktop"></i> <span>Captcha</span> 
                            </a>
                        </li>
                                                                <li>
                            <a href="edit_page.php">
                                <i class="fa fa-sitemap"></i> <span>Pages</span> 
                            </a>
                        </li>
                                      <li>
                            <a href="synonyms.php">
                                <i class="fa fa-book"></i> <span>Add Synonyms</span> 
                            </a>
                        </li>
                    </ul>
                </section>
                <!-- /.sidebar -->
            </aside>

            <!-- Right side column. Contains the navbar and content of the page -->
            <aside class="right-side">
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1>
                        Manage Site
                        <small>Control panel</small>
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="#"><i class="fa fa-th"></i> Admin</a></li>
                        <li class="active">Manage Site</li>
                    </ol>
                </section>

                <!-- Main content -->
                <section class="content">


                            <!-- general form elements -->
                            <div class="box box-primary">
                                <div class="box-header">
                                    <h3 class="box-title">Site Info</h3>
                                </div><!-- /.box-header -->
                                <!-- form start -->
                                
                                
<?php
if ($_SERVER['REQUEST_METHOD'] == POST)
{
    $title =  htmlspecialchars(Trim($_POST['title']));
    $des =   htmlspecialchars(Trim($_POST['des']));
    $keyword =  htmlspecialchars(Trim($_POST['keyword']));
    $site_name =   htmlspecialchars(Trim($_POST['site_name']));
    $email =   htmlspecialchars(Trim($_POST['email']));
    $twit =   htmlspecialchars(Trim($_POST['twit']));
    $face =   htmlspecialchars(Trim($_POST['face']));
    $gplus =   htmlspecialchars(Trim($_POST['gplus'])); 
    $ga =   htmlspecialchars(Trim($_POST['ga'])); 
    $req =   htmlspecialchars(Trim($_POST['req'])); 
    $lm =   htmlspecialchars(Trim($_POST['lm'])); 
    
    $query = "UPDATE site_info SET title='$title', des='$des', keyword='$keyword', site_name='$site_name', email='$email', twit='$twit', face='$face', gplus='$gplus', ga='$ga', req='$req', lm='$lm' WHERE id='0'"; 
    mysqli_query($con,$query); 
      
    if (mysqli_errno($con)) {   
    echo '<div class="alert alert-danger alert-dismissable">
                                        <i class="fa fa-ban"></i>
                                        <button aria-hidden="true" data-dismiss="alert" class="close" type="button">x</button>
                                        <b>Alert!</b> '.mysqli_error($con).'
                                    </div>';
    }
    else
    {
        echo '
        <div class="alert alert-success alert-dismissable">
                                        <i class="fa fa-check"></i>
                                        <button aria-hidden="true" data-dismiss="alert" class="close" type="button">x</button>
                                        <b>Alert!</b> Site information saved successfully
                                    </div>';
    }
}
?> 
                                <form method="POST" action="site.php">
                                    <div class="box-body">
                                        <div class="form-group">
                                            <label for="site">Site Name</label>
                                            <input type="text" placeholder="Enter site name" name="site_name" id="site_name" value="<?php echo $site_name; ?>" class="form-control">
                                        </div>
                                        <div class="form-group">
                                            <label for="title">Title Tag</label>
                                            <input type="text" placeholder="Enter title of your site" id="title" name="title" value="<?php echo $title; ?>" class="form-control">
                                        </div>
                                        <div class="form-group">
                                            <label for="des">Description</label>
                                            <input type="text" placeholder="Enter description" id="des" name="des"  value="<?php echo $des; ?>" class="form-control">
                                        </div>
                                        <div class="form-group">
                                            <label for="keyword">Keyword's</label>
                                            <input type="text" placeholder="Enter keywords (separated by comma)" value="<?php echo $keyword; ?>"  id="keyword" name="keyword" class="form-control">
                                        </div>
                                        <div class="form-group">
                                            <label for="email">Email ID</label>
                                            <input type="text" placeholder="Enter email id of admin" id="email" value="<?php echo $email; ?>" name="email" class="form-control">
                                        </div>
                                       <br /> <h3 class="box-title">Social Stats</h3> <br />
                                        <div class="form-group">
                                            <label for="face">Facebook URL</label>
                                            <input type="text" placeholder="Enter facebook URL" id="face" name="face" value="<?php echo $face; ?>" class="form-control">
                                        </div>
                                       <div class="form-group">
                                            <label for="twit">Twitter URL</label>
                                            <input type="text" placeholder="Enter twitter URL" id="twit" name="twit" value="<?php echo $twit; ?>" class="form-control">
                                        </div>
                                           <div class="form-group">
                                            <label for="gplus">Gplus URL</label>
                                            <input type="text" placeholder="Enter gplus URL" id="gplus" name="gplus" value="<?php echo $gplus; ?>" class="form-control">
                                        </div>
                                        
                                          <br /> <h3 class="box-title">Other</h3> <br />
                                        <div class="form-group">
                                            <label for="ga">Google Analytics:</label>
                                            <input type="text" placeholder="Enter any domain name" id="ga" name="ga" value="<?php echo $ga; ?>" class="form-control">
                                        </div>
                                        <div class="form-group">
                                            <label for="req">HomePage - Spin request allowed per User (0 = unlimited):</label>
                                            <input type="text" placeholder="Enter Spin request allowed per User" id="req" name="req" value="<?php echo $req; ?>" class="form-control">
                                        </div>
                                        <div class="form-group">
                                            <label for="lm">HomePage - Word limit/per request (0 = unlimited):</label>
                                            <input type="text" placeholder="Enter Word limit/per request" id="lm" name="lm" value="<?php echo $lm; ?>" class="form-control">
                                        </div>
                                        <div style="text-algin: right;">
                                             <button class="btn btn-primary" type="submit">Submit</button></div>
                                    </div><!-- /.box-body -->
                                    <div class="box-footer">
                                   
                                    </div>
                                </form>
                            </div><!-- /.box -->

                          
                 
                </section><!-- /.content -->
            </aside><!-- /.right-side -->
        </div><!-- ./wrapper -->

        <!-- add new calendar event modal -->


          <!-- jQuery 2.0.2 -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.0.2/jquery.min.js"></script>
        <!-- jQuery UI 1.10.3 -->
        <script src="js/jquery-ui-1.10.3.min.js" type="text/javascript"></script>
        <!-- Bootstrap -->
        <script src="js/bootstrap.min.js" type="text/javascript"></script>
        <!-- Morris.js charts -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
        <script src="js/plugins/morris/morris.min.js" type="text/javascript"></script>
        <!-- Sparkline -->
        <script src="js/plugins/sparkline/jquery.sparkline.min.js" type="text/javascript"></script>
        <!-- jvectormap -->
        <script src="js/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js" type="text/javascript"></script>
        <script src="js/plugins/jvectormap/jquery-jvectormap-world-mill-en.js" type="text/javascript"></script>
        <!-- daterangepicker -->
        <script src="js/plugins/daterangepicker/daterangepicker.js" type="text/javascript"></script>
        <!-- Bootstrap WYSIHTML5 -->
        <script src="js/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js" type="text/javascript"></script>
        <!-- iCheck -->
        <script src="js/plugins/iCheck/icheck.min.js" type="text/javascript"></script>
        
        <!-- AdminLTE App -->
        <script src="js/AdminLTE/app.js" type="text/javascript"></script>
        <script src="js/AdminLTE/dashboard.js" type="text/javascript"></script>     


    </body>
</html>
<?php
mysqli_close($con);
?>
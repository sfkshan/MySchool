
<?php 
    
    error_reporting(E_ALL);
    ini_set('display_errors', TRUE);
    ini_set('display_startup_errors', TRUE);
    
    include_once "./Config/constants.php"; 
    include_once "./BO/Misc/menu.php"; 

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
  <!-- Twitter Bootstrap CSS -->
  <link href="asset/css/bootstrap.css" rel="stylesheet" type="text/css" />   
  <link href="asset/css/bootstrap-responsive.css" rel="stylesheet" type="text/css" />
  <link href="asset/css/main.css" rel="stylesheet" type="text/css" />  
</head>

<body>
    <div id="header" style="height: 70px;">
      <div class="logo" style="width: 250px; float: left">
          <img alt="" src="asset/img/mySchool_logo.png" style="height: 60px;">
      </div>

      <div class="fr pr10" style="float: right; margin-top: 25px; text-align: right; margin-right: 10px;">
        <label id="tdwelcome" class="lblDefault" style="color:#000">Welcome, 
          <a target="frmContent" id="lnkProfile" title="My Profile" 
             href="#">shanmugharaj k</a> | 

          <a target="frmContent" id="lnkChangePassword" title="Change Password" 
             href="#">Change Password</a> |

          <a title="Logout" href="#">Logout</a>
        </label>
      </div>
      <div style="display: none;">
          <a target="frmContent" id="lnkMyProfile" href="https://bo.bookmyshow.com/MyProfile.aspx">My Profile</a>
      </div>
  </div>
    <!-- =================== Start Dynamic Nav ============================ -->
    <div class="navbar">
      <div class="navbar-inner">
        <div class="container">
          <a data-target=".nav-collapse" data-toggle="collapse" class="btn btn-navbar">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </a>
          <!-- <a class="btn btn-navbar" data-toggle="collapse" data-target=".navbar-responsive-collapse">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </a> -->
          <div id ="menus" class="nav-collapse collapse navbar-responsive-collapse">
            <ul class="nav">

            <?php 

            getMenuResultSet();
            generateMenu(0);

            ?>

          <!-- =================== End Dynamic Nav ============================ -->

            </li>
          </ul>
          </div><!-- /.nav-collapse -->
        </div>
      </div><!-- /navbar-inner -->
    </div>  

    <script src="asset/js/jquery-1.9.1.min.js"></script>
    <script src="asset/js/bootstrap.js" type="text/javascript"></script>
</body>
</html>

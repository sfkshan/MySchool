
<?php 
    
    error_reporting(E_ALL);
    ini_set('display_errors', TRUE);
    ini_set('display_startup_errors', TRUE);
    
    // include "./Library/testMenu.php"; 
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
  <style type="text/css">
    body, #InnerDiv, .container-fluid, .container
    {
        position: relative;
    }
    /*  shows the dropdown on hover*/
    .navbar ul.nav li:hover > ul.dropdown-menu
    {
        display: block;
    }
    
    
    /* before and after */
    .navbar .nav > li > .dropdown-menu::before, .navbar .nav > li > .dropdown-menu::after
    {
        display: none;
    }
  </style>
</head>

<body>
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

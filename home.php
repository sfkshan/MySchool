
<?php 
    
    error_reporting(E_ALL);
    ini_set('display_errors', TRUE);
    ini_set('display_startup_errors', TRUE);
    
    include "./Library/testMenu.php"; 
    include_once "./Library/MySqlEngine.php"; 

    $objDb = new MySQL_Engine();
    if($objDb->blnGetResultSet("select * from tblStudentDetails;select * from tblMenu")){
      while ($objDb->blnResultsMoveNextRow()) {
        echo $objDb->objResultsValue('StudentD_strName');
      }

      if($objDb->blnMoveNextResultSet()){
        while ($objDb->blnResultsMoveNextRow()) {
          echo $objDb->objResultsValue('Menu_strName');
        }
      }
    }

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
  <!-- Twitter Bootstrap CSS -->
  <link href="asset/css/bootstrap.css" rel="stylesheet" type="text/css" />   
  <link href="asset/css/bootstrap-responsive.css" rel="stylesheet" type="text/css" />
</head>

<body>
    <!-- =================== Start Dynamic Nav ============================ -->
    <div class="navbar navbar-inverse">
      <div class="navbar-inner navbar-inverse">
        <div class="container">
          <a class="btn btn-navbar" data-toggle="collapse" data-target=".navbar-responsive-collapse">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </a>
          <a class="brand" href="#">Title</a>
          <div class="nav-collapse collapse navbar-responsive-collapse">
            <ul class="nav">

            <?php 
            
            getMenuResultSet();
            generate_menu(0);

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

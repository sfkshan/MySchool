<?php

  error_reporting(E_ALL);
  ini_set('display_errors', TRUE);
  ini_set('display_startup_errors', TRUE);
  // ini_set('display_errors', '1');


  include "./Library/menu.php"; 

  

?>

<!DOCTYPE html>
<html>
<head>
 <title>Responsive Menu - ProgrammingFree</title>
<!-- Mobile viewport optimized: h5bp.com/viewport -->
  <meta name="viewport" content="width=device-width">
<!-- CSS -->
    <link href="asset/css/bootstrap.css" rel="stylesheet" type="text/css" />   
    <link href="asset/css/bootstrap-responsive.css" rel="stylesheet" type="text/css" />
<!--Scripts-->
 <script src="asset/js/jquery-1.9.1.min.js"></script>
 <script src="asset/js/bootstrap.js" type="text/javascript"></script>

</head>
<body>
<div class="container-fluid">
  <header>
    <br/>
    <div class="navbar navbar-inverse">
      <div class="navbar-inner">
        <div class="container-fluid">
          <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          </a>

          <!-- ======================== MENU PART START =====================================-->
          <div class="nav-collapse collapse">
            <?php echo $menuHTML; ?>
          </div>
          <!-- ======================== MENU PART START =====================================-->
        </div>  
      </div>
    </div>
  </header>
</div>

  <form action="Library/DbEngine.php" class="simple_form form-horizontal" id="new_article" method="post" novalidate="novalidate">

  <legend>Student Details</legend>

  <div class="control-group">
    <label class="string required control-label" for="article_name">Name</label>
    <div class="controls">
      <input class="string required span3" id="student_name" name="studentName" type="text">
    </div>
  </div>
  
  <div class="control-group">
    <label class="string required control-label" for="article_name">Father Name</label>
    <div class="controls">
      <input class="string required span3" id="fathet_name" name="fatherName" type="text">
    </div>
  </div>

  <div class="control-group">
    <label class="string required control-label" for="article_name">Mother Name</label>
    <div class="controls">
      <input class="string required span3" id="mother_name" name="motherName" type="text">
    </div>
  </div>

  <div class="control-group">
    <label class="string required control-label" for="article_name">Address</label>
    <div class="controls">
      <input class="string required span3" id="student_address" name="address" type="text">
    </div>
  </div>
  
  <div class="form-actions">
    <input class="btn btn-primary" name="commit" type="submit" value="Add Student">
    <input class="btn btn-danger" name="commit" type="reset" value="Cancel Entry">
  </div>

</form>

<div>
</body>
</html>




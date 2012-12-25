<?php
  defined('__NOT_DIRECT') || define('__NOT_DIRECT',1);
  include '../cek-akses.php'; 
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta charset="utf-8">
    <title>iKRS | Admin</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- Le styles -->
    <link href="../css/bootstrap.min.css" rel="stylesheet">
    <link href="../css/custom.css" rel="stylesheet">
    <style>
      body {
        padding-top: 60px; /* 60px to make the container go all the way to the bottom of the topbar */
      }
    </style>
    <link href="../css/bootstrap-responsive.min.css" rel="stylesheet">
    <link href="../css/font-awesome.css" rel="stylesheet">
    <!-- Le HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
      <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->

    <!-- Le fav and touch icons -->
    <link rel="shortcut icon" href="../ico/favicon.ico" />
  </head>

  <body>
     <div class="navbar navbar-inverse navbar-fixed-top">
      <div class="navbar-inner">
        <div class="container" style="text-shadow:none;">
          <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </a>
          <a class="brand" href="">iKRS</a>
          <div class="nav-collapse collapse">
            <ul class="nav">
              <li class="active"><a href="index.php"><i class="icon-home"></i> Home</a></li>
              <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">Mahasiswa <b class="caret"></b></a>
                        <ul class="dropdown-menu">
                          <li><a href="add-mhs.php"><i class="icon-plus"></i> Input Mahasiswa</a></li>
                          <li class="divider"></li>
                          <li><a href="list-mhs.php"><i class="icon-user"></i> Daftar Mahasiswa</a></li>
                        </ul>
              </li>
              <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">Dosen <b class="caret"></b></a>
                        <ul class="dropdown-menu">
                          <li><a href="add-dosen.php"><i class="icon-plus"></i> Input Dosen</a></li>
                          <li class="divider"></li>
                          <li><a href="list-dosen.php"><i class="icon-user"></i> Daftar Dosen</a></li>
                        </ul>
              </li>
              <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">Matakuliah <b class="caret"></b></a>
                        <ul class="dropdown-menu">
                          <li><a href="add-matkul.php"><i class="icon-plus"></i> Input Matakuliah</a></li>
                          <li class="divider"></li>
                          <li><a href="list-matkul.php"><i class="icon-list"></i> Daftar Matakuliah</a></li>
                        </ul>
              </li>
              <li><a href="../logout.php"><i class="icon-signout"></i>Logout</a></li>
            </ul>
          </div><!--/.nav-collapse -->
        </div>
      </div>
    </div>

    
    <div class="container">
      <div class="jumbotron masthead">
        <div class="container" style="cursor:default;">
          <h1><span class="i">i</span>KRS</h1>
        </div>
      </div>
    </div> <!-- /container -->

    <!-- Le javascript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="../js/jquery-1.8.2.min.js"></script>
	  <script src="../js/bootstrap.min.js"></script>
  </body>
</html>
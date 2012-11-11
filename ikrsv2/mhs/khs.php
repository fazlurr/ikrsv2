<?php
  defined('__NOT_DIRECT') || define('__NOT_DIRECT',1);
  include '../cek-akses.php';
  include 'tahunajaran.php';

  mysql_connect(DB_HOST,DB_USER,DB_PASS);
  mysql_select_db(DB_NAME);

  $nrp = $_SESSION['user_id'];

?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta charset="utf-8">
    <title>iKRS</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- Le styles -->
    <link href="../css/bootstrap.min.css" rel="stylesheet">
    <link href="../css/custom.css" rel="stylesheet">
    <link href="../font/stylesheet.css" rel="stylesheet">
    <style>
      body {
        padding-top: 60px; /* 60px to make the container go all the way to the bottom of the topbar */
      }      
      .bebas {font: 50px/58px 'BebasNeueRegular', Arial, sans-serif;letter-spacing: 0;}
    </style>
    <link href="../css/bootstrap-responsive.min.css" rel="stylesheet">
    <link href="../css/font-awesome.css" rel="stylesheet">
    <!-- Le HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
      <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->

    <!-- Le fav and touch icons -->
    <link rel="shortcut icon" href="../ico/favicon.ico" /> 
    <script type="text/javascript" src="chrome-extension://bfbmjmiodbnnpllbbbfblcplfjjepjdn/js/injected.js"></script>
  </head>

  <body  >
    <div class="navbar navbar-inverse navbar-fixed-top">
      <div class="navbar-inner">
        <div class="container">
          <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </a>
          <a class="brand" href="index.php">iKRS</a>
          <div class="nav-collapse collapse">
            <ul class="nav">
              <li><a href="index.php"><i class="icon-home"></i> Home</a></li>
              <li><a href="inputkrs.php"><i class="icon-check"></i> KRS Online</a></li>
              <li class="active"><a href="khs.php"><i class="icon-list"></i> KHS</a></li>
              <li><a href="../logout.php"><i class="icon-signout"></i>Logout</a></li>
            </ul>
          </div><!--/.nav-collapse -->
        </div>
      </div>
    </div>

    <div class="container">
        <h2>KHS :</h2>
        <table class="table table-hover table-bordered">
          <tr>
            <th>Nama Matakuliah</th>
            <th>Semester</th>
            <th>Tahun</th>
            <th>SKS</th>
            <th>Nilai</th>
          </tr>
      <?
        $krs = mysql_query("SELECT matakuliah.nama_matkul, krs.semester, krs.tahun, matakuliah.sks, krs.nilai FROM matakuliah, krs WHERE krs.nrp='$nrp' AND krs.kode_matkul = matakuliah.kode_matkul AND krs.semester='$semester' AND krs.tahun='$tahun'") or die(mysql_error());
        while ($k = mysql_fetch_array($krs)){
      ?>
          <tr>
            <td><?=$k['nama_matkul']?></td>
            <td><?=$k['semester']?></td>
            <td><?=$k['tahun']?></td>
            <td><?=$k['sks']?></td>
            <td><?=$k['nilai']?></td>
          </tr>
      <?
        }
      ?>
    </div> <!-- /container -->

    <!-- Le javascript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="../js/jquery-1.8.2.min.js"></script>	    
    <script src="../js/bootstrap.min.js"></script>
  </body>
</html>
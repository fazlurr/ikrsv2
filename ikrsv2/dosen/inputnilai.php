<?php
  defined('__NOT_DIRECT') || define('__NOT_DIRECT',1);
  include '../cek-akses.php';

  mysql_connect(DB_HOST,DB_USER,DB_PASS);
  mysql_select_db(DB_NAME);

  if (isset($_POST['nomor'])){
    $nomor = $_POST['nomor'];
  }

  if ($_POST && (isset($_POST['nilai'])) ){
    $nilai = mysql_real_escape_string($_POST['nilai']);
    $nomor2 = mysql_real_escape_string($_POST['nomor2']);
    $input = "UPDATE krs SET nilai='$nilai' WHERE nomor='$nomor2'";
    $mulai = mysql_query($input) or die(mysql_error());
    header('Location: nilai.php');
  }

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
    <style>
      body {
        padding-top: 60px; /* 60px to make the container go all the way to the bottom of the topbar */
      }
    </style>
    <link href="../css/bootstrap-responsive.min.css" rel="stylesheet">
    <link href="../css/font-awesome.css" rel="stylesheet">
    <link href="../css/custom.css" rel="stylesheet">
    <!-- Le HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
      <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->

    <!-- Le fav and touch icons -->
    <link rel="shortcut icon" href="../ico/favicon.ico" /> 
    <script type="text/javascript" src="chrome-extension://bfbmjmiodbnnpllbbbfblcplfjjepjdn/js/injected.js"></script>
</head>

  <body>
    <div class="navbar navbar-inverse navbar-fixed-top">
      <div class="navbar-inner">
        <div class="container">
          <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </a>
          <a class="brand" href="">iKRS</a>
          <div class="nav-collapse collapse">
            <ul class="nav">
              <li><a href="index.php"><i class="icon-home"></i> Home</a></li>
              <li><a href="nilai.php">Nilai</a></li>
              <li><a href="pa.php">PA</a></li>
              <li><a href="../logout.php"><i class="icon-signout"></i>Logout</a></li>
            </ul>
          </div><!--/.nav-collapse -->
        </div>
      </div>
    </div>

    <div class="container">

      <h1>iKRS Institut Teknologi Indonesia</h1>
      <div class="row">
      	<div class="span5">
          <?
          if (isset($nomor)){
            $info = mysql_query("SELECT mhs.nrp, mhs.nama, krs.nomor, krs.semester, krs.tahun FROM mhs LEFT JOIN krs ON mhs.nrp=krs.nrp WHERE krs.nomor='$nomor' AND krs.status='Y' ");
            while($k = mysql_fetch_array($info)){
          ?>
            <table class="table table-hover">
              <tr>
                <th>User ID</th>
                <th>Nama</th>
                <th>Semester</th>
                <th>Tahun</th>
              </tr>
               <tr>
                <td><?php echo $k['nrp']; ?></td>
                <td><?php echo $k['nama']; ?></td>
                <td><?php echo $k['semester']; ?></td>
                <td><?php echo $k['tahun']; ?></td>
              </tr>
            </table>
            <form name="isinilai" method="post" action="">
              <input type="text" name="nilai" placeholder="A, B, C, D, E" />
              <input type="hidden" name="nomor2" value="<?php echo $k['nomor'];?>" />
              <button type="submit" class="btn btn-primary"><i class="icon-pencil icon-white icon-large"></i></button>
            </form>
            <?
              }
            }
            ?>
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
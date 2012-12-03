<?php
  defined('__NOT_DIRECT') || define('__NOT_DIRECT',1);
  include '../cek-akses.php';
  
  mysql_connect(DB_HOST,DB_USER,DB_PASS);
  mysql_select_db(DB_NAME);

  $userId = $_SESSION['user_id'];

  //melakukan query ke matkul
  $sqlmatkul = mysql_query("SELECT kode_matkul, nama_matkul FROM matakuliah WHERE dosen='$userId' ");
  while($k = mysql_fetch_array($sqlmatkul)){
    $kode_matkul = $k['kode_matkul'];
    $nama_matkul = $k['nama_matkul'];
  }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta charset="utf-8">
<title>iKRS | Nilai</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- Le styles -->
    <link href="../css/bootstrap.min.css" rel="stylesheet">
    <link href="../css/sorter.style.css" rel="stylesheet">
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
    <script src="../js/jquery-1.8.2.min.js"></script>
    <script src="../js/bootstrap.min.js"></script>
    <script src="../js/jquery.tablesorter.min.js"></script>
    <script src="../js/jquery.tablesorter.pager.js"></script>
    <script>
        $(document).ready(function() 
          { 
            $("#myTable").tablesorter()
            .tablesorterPager({container: $("#pager")});
          } 
        );
      </script>
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
          <a class="brand" href="index.php">iKRS</a>
          <div class="nav-collapse collapse">
            <ul class="nav">
              <li><a href="index.php"><i class="icon-home"></i> Home</a></li>
              <li class="active"><a href="nilai.php">Nilai</a></li>
              <li><a href="pa.php">PA</a></li>
              <li><a href="../logout.php"><i class="icon-signout"></i>Logout</a></li>
            </ul>
          </div><!--/.nav-collapse -->
        </div>
      </div>
    </div> 

    <div class="container">
      <h3>Mata Kuliah : <?=$nama_matkul?></h3>
      <div class="row">
      <div class="span9">
        <table class="table table-hover table-bordered tablesorter" id="myTable">
          <thead>
            <tr>
              <th class="header">NRP</th>
              <th class="header">Nama</th>
              <th class="header">Semester</th>
              <th class="header">Tahun</th>
              <th class="header">Nilai</th>
              <th class="header"><center>Fungsi<center></th>
            </tr>
          </thead>
          <tbody>
        <?
        $daftar = mysql_query("SELECT mhs.nrp, mhs.nama, krs.nomor, krs.semester, krs.tahun, nilai FROM mhs LEFT JOIN krs ON mhs.nrp = krs.nrp WHERE krs.kode_matkul='$kode_matkul' AND krs.status='Y' ");
        while($k = mysql_fetch_array($daftar)){
        ?>
          <tr>
            <td><?=$k['nrp'];?></td>
            <td><?=$k['nama'];?></td>
            <td><?=$k['semester'];?></td>
            <td><?=$k['tahun'];?></td>
            <td><?=$k['nilai'];?></td>
            <td>
              <center>
              <form name="isinilai" method="post" action="inputnilai.php">
                <input type="hidden" name="nomor" value="<?php echo $k['nomor']; ?>">
                <input type="hidden" name="kode_matkul" value="<?php echo $kode_matkul;?>">
                <button title="Isi Nilai" type="submit" class="btn btn-primary"><i class="icon-pencil icon-white icon-large"></i></button>
              </form>
              </center>
            </td>
          </tr>
        <?
        }
        ?>
          </tbody>
        </table>
          <div id="pager" class="pager" style="position: absolute;">
            <form>
              <img src="../img/first.png" class="first">
              <img src="../img/prev.png" class="prev">
              <input type="text" class="pagedisplay">
              <img src="../img/next.png" class="next">
              <img src="../img/last.png" class="last">
              <select class="pagesize">
                <option selected="selected" value="10">10</option>
                <option value="20">20</option>
                <option value="30">30</option>
                <option value="40">40</option>
              </select>
            </form>
          </div>
        </div>
      </div>
    </div> <!-- /container -->

    <!-- Le javascript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
	    <script src="../js/bootstrap.min.js"></script>
  </body>
</html>
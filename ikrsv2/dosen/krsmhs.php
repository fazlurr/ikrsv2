<?php
  defined('__NOT_DIRECT') || define('__NOT_DIRECT',1);
  include '../cek-akses.php';

  mysql_connect(DB_HOST,DB_USER,DB_PASS);
  mysql_select_db(DB_NAME);

  $userId = $_SESSION['user_id'];

  if (isset($_POST['nrp'])){
    $nrp = mysql_real_escape_string($_POST['nrp']);
    $list2 = mysql_query("SELECT nama FROM mhs WHERE nrp = '$nrp'") or die(mysql_error());
    while($k2 = mysql_fetch_array($list2)){
      $nama = $k2['nama'];
    }
  }
  else {
    header( 'Location: pa.php' );
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
      .slideThree::before {
        content: 'Ya';
      }
      .slideThree::after {
        content: 'Tidak';
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
              <li class="active"><a href="pa.php">PA</a></li>
              <li><a href="../logout.php"><i class="icon-signout"></i>Logout</a></li>
            </ul>
          </div><!--/.nav-collapse -->
        </div>
      </div>
    </div>

    <div class="container">
      <h1>KRS Mahasiswa</h1>
      <div class="row">
        <div class="span9">
          <h3>Nama : <?=$nama;?></h3>
          <h3>NRP : <?=$nrp;?></h3>
          <form name="setuju" method="post" action="inputpa.php" onSubmit="return confirm('Kalau sudah disetujui tidak bisa diubah kembali, Lanjut?');">
            <table class="table table-hover table-bordered">
              <tr>
                <th>Nama Matakuliah</th>
                <th>SKS</th>
                <th>Setuju</th>
              </tr>
              <?php
              $i = 0;
              $j = 0;
              $list = mysql_query("SELECT krs.nomor, matakuliah.nama_matkul, matakuliah.sks, krs.status 
                FROM krs, matakuliah WHERE matakuliah.kode_matkul = krs.kode_matkul AND krs.nrp = '$nrp'");
              while($k = mysql_fetch_array($list)){
              ?>
                <tr>
                  <td><?=$k['nama_matkul'];?></td>
                  <td><?=$k['sks'];?></td>
                  <td>
                    <?
                      //Kalau sudah disetujui
                      if ($k['status'] == 'Y'){
                    ?>
                        <input type="checkbox" id="slideThree<?=$i?>" name="nomor[]" value="<?=$k['nomor'];?>" checked="checked">
                    <?
                      }
                      //Kalau belum disetujui
                      else {
                    ?>
                        <input type="checkbox" id="slideThree<?=$i?>" name="nomor[]" value="<?=$k['nomor'];?>">
                    <?
                      }
                    ?>
                  </td>
                </tr>
              <?
                $i++;
                $j++;
              }
              ?>
              <tr>
                <td colspan="3">
                  <center><button type="submit" class="btn btn-success">Submit</button></center>
                </td>
              </tr>
            </table>
          </form>
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
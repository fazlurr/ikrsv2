<?php
  defined('__NOT_DIRECT') || define('__NOT_DIRECT',1);
  include '../cek-akses.php';

  mysql_connect(DB_HOST,DB_USER,DB_PASS);
  mysql_select_db(DB_NAME);

  //Panggil Nomor KRS, Kode Matkul, dan Nama Matkul
  if (isset($_POST['nomor'])){
    $nomor = $_POST['nomor'];
    $kode_matkul = $_POST['kode_matkul'];
    $sqlmatkul = mysql_query("SELECT nama_matkul FROM matakuliah WHERE kode_matkul='$kode_matkul' ");
    while($k = mysql_fetch_array($sqlmatkul)){
      $nama_matkul = $k['nama_matkul'];
    }
  }

  if ($_POST && (isset($_POST['nilai_uts'])) ){
    $nilai_uts = $_POST['nilai_uts'];
    $nilai_uas = $_POST['nilai_uas'];
    $tugas = $_POST['tugas'];
    $absensi = $_POST['absensi'];
    $nomor2 = $_POST['nomor2'];
    //Hitung Nilai Akhir
    $ps_uts = 30/100;
    $ps_uas = 40/100;
    $ps_tugas = 20/100;
    $ps_absensi = 10/100;

    $nilai_akhir = ($nilai_uts*$ps_uts)+($nilai_uas*$ps_uas)+($tugas*$ps_tugas)+($absensi*$ps_absensi);
    if ($nilai_akhir>79){
      $nilai = 'A';
    }
    elseif ($nilai_akhir>76&&$nilai_akhir<80){
      $nilai = 'A-';
    }
    elseif ($nilai_akhir>73&&$nilai_akhir<77){
      $nilai = 'B+';
    }
    elseif ($nilai_akhir>67&&$nilai_akhir<74){
      $nilai = 'B';
    }
    elseif ($nilai_akhir>64&&$nilai_akhir<68){
      $nilai = 'B-';
    }
    elseif ($nilai_akhir>61&&$nilai_akhir<65){
      $nilai = 'C+';
    }
    elseif ($nilai_akhir>55&&$nilai_akhir<62){
      $nilai = 'C';
    }
    elseif ($nilai_akhir>45&&$nilai_akhir<56){
      $nilai = 'D';
    }
    elseif ($nilai_akhir<46&&$nilai_akhir) {
      $nilai = 'E';
    } 
    $input = "UPDATE krs SET nilai='$nilai', nilai_uts='$nilai_uts', nilai_uas='$nilai_uas', tugas='$tugas', absensi='$absensi' WHERE nomor='$nomor2'";
    $mulai = mysql_query($input) or die(mysql_error());
    header('Location: nilai.php');
  }

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta charset="utf-8">
<title>iKRS | Input Nilai</title>
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

      <h2>Matakuliah :<?php echo $nama_matkul;?> (<?php echo $kode_matkul;?>)</h2>
      <div class="row">
      	<div class="span5">
          <?
          if (isset($nomor)){
            $info = mysql_query("SELECT mhs.nrp, mhs.nama, krs.nomor, krs.semester, krs.tahun, krs.nilai_uts, krs.nilai_uas, krs.tugas, krs.absensi FROM mhs LEFT JOIN krs ON mhs.nrp=krs.nrp WHERE krs.nomor='$nomor' AND krs.status='Y' ");
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
              <table class="table">
                <tr>
                  <td>Nilai UTS :</td>
                  <td>
                    <!--<input type="text" name="nilai" placeholder="A, B, C, D, E" />-->
                    <input type="number" min=0 max=100 name="nilai_uts" placeholder="Nilai UTS" value="<?echo $k['nilai_uts'];?>" required />
                  </td>
                </tr>
                <tr>
                  <td>Nilai UAS :</td>
                  <td>
                    <input type="number" min=0 max=100 name="nilai_uas" placeholder="Nilai UAS" value="<?echo $k['nilai_uas'];?>" required />
                  </td>
                </tr>
                <tr>
                  <td>Tugas :</td>
                  <td>
                    <input type="number" min=0 max=100 name="tugas" placeholder="Tugas" value="<?echo $k['tugas'];?>" required />
                  </td>
                </tr>
                <tr>
                  <td>Absensi :</td>
                  <td>
                    <input type="number" min=0 max=100 name="absensi" placeholder="Absensi" value="<?echo $k['absensi'];?>" required />
                  </td>
                </tr>
                  <td colspan=2>
                    <center><input type="hidden" name="nomor2" value="<?php echo $k['nomor'];?>" />
                    <button type="submit" class="btn btn-success" title="Submit">Submit</button>
                    <a href="nilai.php"><div class="btn btn-danger">Cancel</div></a>
                    </center>
                  </td>
                </tr>
              </table>
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
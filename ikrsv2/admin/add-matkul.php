<?php
  defined('__NOT_DIRECT') || define('__NOT_DIRECT',1);
  include '../cek-akses.php'; 

  mysql_connect(DB_HOST,DB_USER,DB_PASS);
  mysql_select_db(DB_NAME);

  //melakukan query dosen ke database
  $sqldosen = mysql_query("SELECT * FROM dosen");
  while($k = mysql_fetch_array($sqldosen)){
    $nidn[] = $k['nidn'];
    $nama_dosen[] = $k['nama'];
  }
if (!function_exists("GetSQLValueString")) {
function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "") 
{
  if (PHP_VERSION < 6) {
    $theValue = get_magic_quotes_gpc() ? stripslashes($theValue) : $theValue;
  }

  $theValue = function_exists("mysql_real_escape_string") ? mysql_real_escape_string($theValue) : mysql_escape_string($theValue);

  switch ($theType) {
    case "text":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;    
    case "long":
    case "int":
      $theValue = ($theValue != "") ? intval($theValue) : "NULL";
      break;
    case "double":
      $theValue = ($theValue != "") ? doubleval($theValue) : "NULL";
      break;
    case "date":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;
    case "defined":
      $theValue = ($theValue != "") ? $theDefinedValue : $theNotDefinedValue;
      break;
  }
  return $theValue;
}
}

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form1")) {
	$errors = array();
  $insertSQL = sprintf("INSERT INTO matakuliah (kode_matkul, nama_matkul, sks, dosen) VALUES (%s, %s, %s, %s)",
                       GetSQLValueString($_POST['kode_matkul'], "text"),
                       GetSQLValueString($_POST['nama_matkul'], "text"),
                       GetSQLValueString($_POST['sks'], "int"),
                       GetSQLValueString($_POST['dosen'], "text"));


  $Result1 = mysql_query($insertSQL);
  if (!$Result1 && mysql_errno() == 1062) {
      $errors[] = $_POST['kode_matkul'] . ' sudah ada.';
  } 
  elseif (mysql_error()) {
    $errors[] = 'Sorry, there was a problem with the database. Please try later.';
  }

}

if (!function_exists("GetSQLValueString")) {
	function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "") 
	{
	  if (PHP_VERSION < 6) {
		$theValue = get_magic_quotes_gpc() ? stripslashes($theValue) : $theValue;
	  }
	
	  $theValue = function_exists("mysql_real_escape_string") ? mysql_real_escape_string($theValue) : mysql_escape_string($theValue);
	
	  switch ($theType) {
		case "text":
		  $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
		  break;    
		case "long":
		case "int":
		  $theValue = ($theValue != "") ? intval($theValue) : "NULL";
		  break;
		case "double":
		  $theValue = ($theValue != "") ? doubleval($theValue) : "NULL";
		  break;
		case "date":
		  $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
		  break;
		case "defined":
		  $theValue = ($theValue != "") ? $theDefinedValue : $theNotDefinedValue;
		  break;
	  }
	  return $theValue;
	}
}

?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta charset="utf-8">
    <title>iKRS | Input Matakuliah</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- Le styles -->
    <link href="../css/bootstrap.min.css" rel="stylesheet">
    <link href="../css/custom.css" rel="stylesheet">
    <link href="../form/styles.css" rel="stylesheet">
    <style>
      body {
        padding-top: 60px; /* 60px to make the container go all the way to the bottom of the topbar */
      }
    </style>
    <link href="../css/bootstrap-responsive.min.css" rel="stylesheet">
    <link href="../css/font-awesome.css" rel="stylesheet">
    <link href="../css/notifstyle.css" rel="stylesheet">
    <link href="../css/animate.min.css" rel="stylesheet">
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
        <div class="container" style="text-shadow:none;">
          <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </a>
          <a class="brand" href="">iKRS</a>
          <div class="nav-collapse collapse">
            <ul class="nav">
              <li><a href="index.php"><i class="icon-home"></i> Home</a></li>
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
      <h1>Input Matakuliah</h1>
      <div class="row">
        <div class="span4">
          <span class="required_notification">* Field tidak boleh kosong</span>
          <form class="contact_form" method="post" name="form1" action="<?php echo $editFormAction; ?>">
            <table class="table">
              <tbody>
                <tr>
                  <td>Kode Matakuliah:</td>
                  <td><input type="text" name="kode_matkul" value="" size="32" required></td>
                </tr>
                <tr>
                  <td>Nama Matakuliah:</td>
                  <td><input type="text" name="nama_matkul" value="" size="32" required></td>
                </tr>
                <tr>
                  <td>SKS :</td>
                  <td><input type="text" name="sks" value="" size="32" required></td>
                </tr>
                <tr>
                  <td>Dosen :</td>
                  <td>
                        <select name="dosen">
                          <?php
                            for($i=0; $i<count($nidn); $i++){
                          ?>
                                <option value=<?=$nidn[$i];?>><?=$nama_dosen[$i];?></option>
                          <?
                            }
                          ?>
                        </select>
                      </td></tr>
                <tr>
                  <td>&nbsp;</td>
                  <td><button type="submit" class="btn btn-success">Masukkan Data</button></td>
                </tr>
              </tbody>
            </table>
            <input type="hidden" name="MM_insert" value="form1">
          </form>
          <p>&nbsp;</p>
        </div>
        <div class="span3" name="notif">
          <?php
          if ($_POST && $errors) {
            echo '<div class="label label-important" style="font-size: 20px;">';
            echo '<ul>';
            foreach ($errors as $error) {
              echo "<li>$error</li>";
            }
            echo '</ul>';
            echo '</div>';
          } elseif ($_POST && !$errors) {
            echo '<div class="tn-box tn-box-color-2 tn-box-active">';
            echo '<p>Data berhasil dimasukkan</p>';
            echo '</div>';
          }
          ?>
        </div>
      </div>
    </div> 
    <!-- /container -->

    <!-- Le javascript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="../js/jquery-1.8.2.min.js"></script>
	<script src="../js/bootstrap.min.js"></script>
  </body>
</html>
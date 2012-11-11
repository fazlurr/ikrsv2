<?php
  defined('__NOT_DIRECT') || define('__NOT_DIRECT',1);
  include '../cek-akses.php'; 

  mysql_connect(DB_HOST,DB_USER,DB_PASS);
  mysql_select_db(DB_NAME);

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

if($_POST) { //Buat Output KRS
	$_SESSION['fromMain'] = "true";//Session Khusus buat redirect
}

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form1")) {
  $errors = array();

  $insertSQL2 = sprintf("INSERT INTO `user` (user_id, password, type) VALUES (%s, %s, %s)",
                       GetSQLValueString($_POST['nidn'], "text"),
                       GetSQLValueString (md5($_POST['password']), "text"),
                       GetSQLValueString($_POST['type'], "text"));

  $Result2 = mysql_query($insertSQL2);

if (!$Result2 && mysql_errno() == 1062) {
      $errors[] = $_POST['user_id'] . ' sudah ada.';
    } 
elseif (mysql_error()) {
    $errors[] = mysql_errno(). 'Maaf terjadi kesalahan database.';
    }

  $insertSQL = sprintf("INSERT INTO `dosen` (nidn, nama) VALUES (%s, %s)",
                       GetSQLValueString($_POST['nidn'], "text"),
                       GetSQLValueString($_POST['name'], "text"));

  $Result1 = mysql_query($insertSQL);
}

?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta charset="utf-8">
  <title>iKRS | Input Dosen</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- Le styles -->
    <link href="../css/bootstrap.min.css" rel="stylesheet">
    <link href="../css/custom.css" rel="stylesheet">
    <link href="../form/styles.css" rel="stylesheet" />
    <style>
      body {
        padding-top: 60px; /* 60px to make the container go all the way to the bottom of the topbar */
      }
    </style>
    <link href="../css/bootstrap-responsive.min.css" rel="stylesheet" />
    <link href="../css/notifstyle.css" rel="stylesheet">
    <link href="../css/font-awesome.css" rel="stylesheet">
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
          <a class="brand" href="index.php">iKRS</a>
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
      <h1>Input Dosen</h1>
      <div class="row">
        <div class="span4" name="isi">
          <span class="required_notification">* Field tidak boleh kosong</span>
          <form class="contact_form" action="<?php echo $editFormAction; ?>" method="post" name="form1" id="form1">
            <table class="table">
              <tr>
                <td>NIDN  :</td>
                <td><input type="text" name="nidn" value="" size="32" required /></td>
              </tr>
              <tr>
                <td>Nama  :</td>
                <td><input type="text" name="name" value="" size="32" required /></td>
              </tr>
              <tr>
                <td>Password  :</td>
                <td>
                	<input type="text" name="password" value="" size="32" required />
                	<input type="hidden" name="type" value="dosen">
                </td>
              </tr>
              <tr>
                <td>&nbsp;</td>
                <td><button class="btn btn-success" type="submit">Masukkan Data</button></td>
              </tr>
            </table>
            <input type="hidden" name="MM_insert" value="form1" />
          </form>
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
    </div> <!-- /container -->

    <!-- Le javascript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="../js/modernizr.custom.39460.js"></script>
    <script src="../js/jquery-1.8.2.min.js"></script>
	  <script src="../js/bootstrap.min.js"></script>
  </body>
</html>
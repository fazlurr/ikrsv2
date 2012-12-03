<?php require_once('../Connections/LocalCoy.php'); ?>
<?php
  defined('__NOT_DIRECT') || define('__NOT_DIRECT',1);
  include '../cek-akses.php';

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

if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "form1")) {
  $updateSQL = sprintf("UPDATE matakuliah SET nama_matkul=%s, sks=%s, dosen=%s WHERE kode_matkul=%s",
                       GetSQLValueString($_POST['nama_matkul'], "text"),
                       GetSQLValueString($_POST['sks'], "int"),
                       GetSQLValueString($_POST['dosen'], "text"),
                       GetSQLValueString($_POST['kode_matkul'], "text"));

  mysql_select_db($database_LocalCoy, $LocalCoy);
  $Result1 = mysql_query($updateSQL, $LocalCoy) or die(mysql_error());

  $updateGoTo = "list-matkul.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $updateGoTo .= (strpos($updateGoTo, '?')) ? "&" : "?";
    $updateGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $updateGoTo));
}

$colname_mk = "-1";
if (isset($_GET['km'])) {
  $colname_mk = $_GET['km'];
}
mysql_select_db($database_LocalCoy, $LocalCoy);
$query_mk = sprintf("SELECT * FROM matakuliah WHERE kode_matkul = %s", GetSQLValueString($colname_mk, "text"));
$mk = mysql_query($query_mk, $LocalCoy) or die(mysql_error());
$row_mk = mysql_fetch_assoc($mk);
$totalRows_mk = mysql_num_rows($mk);

//melakukan query dosen ke database
  $sqldosen = mysql_query("SELECT * FROM dosen");
  while($k = mysql_fetch_array($sqldosen)){
    $nidn[] = $k['nidn'];
    $nama_dosen[] = $k['nama'];
  }
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>iKRS | Edit Matkul</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <meta name="Description" content="" />
  <meta name="author" content="" />

<!-- Le styles -->
    <link href="../css/bootstrap.min.css" rel="stylesheet">
    <link href="../css/custom.css" rel="stylesheet">
    <style>
      body {
        padding-top: 60px; /* 60px to make the container go all the way to the bottom of the topbar */
      }
    </style>
<link href="../css/bootstrap-responsive.min.css" rel="stylesheet" />

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
      <h1>iKRS Institut Teknologi Indonesia</h1>
      <div class="row">
        <div class="span5">
          <form method="post" name="form1" action="<?php echo $editFormAction; ?>">
            <table class="table table-hover table-bordered">
              <tr>
                <td nowrap align="right">Kode Matkul</td>
                <td><?php echo $row_mk['kode_matkul']; ?></td>
              </tr>
              <tr>
                <td>Nama Matakuliah</td>
                <td><input type="text" name="nama_matkul" value="<?php echo htmlentities($row_mk['nama_matkul'], ENT_COMPAT, ''); ?>" size="32"></td>
              </tr>
              <tr>
                <td>SKS</td>
                <td><input type="text" name="sks" value="<?php echo htmlentities($row_mk['sks'], ENT_COMPAT, ''); ?>" size="32"></td>
              </tr>
              <tr valign="baseline">
                <td nowrap align="right">Dosen</td>
                <td>
                  <select name="dosen">
                    <option value="-">-</option>
                    <?php
                      for($i=0; $i<count($nidn); $i++){
                    ?>
                          <option value=<?=$nidn[$i];?>><?=$nama_dosen[$i];?></option>
                    <?
                      }
                    ?>
                  </select>
                </td>              </tr>
              <tr valign="baseline">
                <td nowrap align="right">&nbsp;</td>
                <td><input type="submit" class="btn btn-success" value="Update record">
                <a href="list-matkul.php"><div class="btn btn-danger">Cancel</div></a></td>
              </tr>
            </table>
            <input type="hidden" name="MM_update" value="form1">
            <input type="hidden" name="kode_matkul" value="<?php echo $row_mk['kode_matkul']; ?>">
          </form>
          <p>&nbsp;</p>
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
<?php
mysql_free_result($mk);
?>

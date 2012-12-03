<?php require_once('../Connections/LocalCoy.php'); ?>
<?php
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
  $updateSQL = sprintf("UPDATE dosen SET nama=%s WHERE nidn=%s",
                       GetSQLValueString($_POST['nama'], "text"),
                       GetSQLValueString($_POST['nidn'], "text"));

  mysql_select_db($database_LocalCoy, $LocalCoy);
  $Result1 = mysql_query($updateSQL, $LocalCoy) or die(mysql_error());

  $updateGoTo = "list-dosen.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $updateGoTo .= (strpos($updateGoTo, '?')) ? "&" : "?";
    $updateGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $updateGoTo));
}

$colname_dosen = "-1";
if (isset($_GET['nidn'])) {
  $colname_dosen = $_GET['nidn'];
}
mysql_select_db($database_LocalCoy, $LocalCoy);
$query_dosen = sprintf("SELECT * FROM dosen WHERE nidn = %s", GetSQLValueString($colname_dosen, "text"));
$dosen = mysql_query($query_dosen, $LocalCoy) or die(mysql_error());
$row_dosen = mysql_fetch_assoc($dosen);
$totalRows_dosen = mysql_num_rows($dosen);

  defined('__NOT_DIRECT') || define('__NOT_DIRECT',1);
  include '../cek-akses.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>iKRS</title>
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
                <td>NIDN</td>
                <td><?php echo $row_dosen['nidn']; ?></td>
              </tr>
              <tr>
                <td>Nama</td>
                <td><input type="text" name="nama" value="<?php echo htmlentities($row_dosen['nama'], ENT_COMPAT, ''); ?>" size="32"></td>
              </tr>
              <tr>
                <td>&nbsp;</td>
                <td><input type="submit" class="btn btn-success" value="Update record">
                <a href="list-dosen.php"><div class="btn btn-danger">Cancel</div></a></td>
              </tr>
            </table>
            <input type="hidden" name="MM_update" value="form1">
            <input type="hidden" name="nidn" value="<?php echo $row_dosen['nidn']; ?>">
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
mysql_free_result($dosen);
?>
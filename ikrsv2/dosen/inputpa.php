<?php
	defined('__NOT_DIRECT') || define('__NOT_DIRECT',1);
	include '../cek-akses.php';

  	mysql_connect(DB_HOST,DB_USER,DB_PASS);
  	mysql_select_db(DB_NAME);

  	$userId = $_SESSION['user_id'];
  	$nomor = $_POST['nomor'];
  	$cek = $_POST['cek'];

	//Mengecek persetujuan dan nomor krs
	foreach ($nomor as $value){
		$input = mysql_query("UPDATE krs SET status='Y' WHERE nomor='$value'") or die(mysql_error());
	}
    header('Location: krsmhs.php');
?>
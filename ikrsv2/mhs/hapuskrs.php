<?php
  defined('__NOT_DIRECT') || define('__NOT_DIRECT',1);
  include '../cek-akses.php';

	mysql_connect(DB_HOST,DB_USER,DB_PASS);
	mysql_select_db(DB_NAME);

	//Pelempar Balik
	if($_SESSION['fromMain'] == "false"){
 		//kirim balik
   		header('Location: ' . $_SERVER['HTTP_REFERER']);
	}
	else{
   		//reset the variable
   		$_SESSION['fromMain'] = "false";
		header('Location: ' . $_SERVER['HTTP_REFERER']);
	}

	$userId = $_SESSION['user_id'];
	$km = $_POST['km'];
	
	if(!empty($km)){
		$sql = "DELETE FROM krs WHERE nrp='$userId' AND kode_matkul='$km'";
		$result = mysql_query($sql) or die(mysql_error());
		header('Location: ' . $_SERVER['HTTP_REFERER']);
	}
?>

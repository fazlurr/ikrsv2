<?php
  defined('__NOT_DIRECT') || define('__NOT_DIRECT',1);
  include '../cek-akses.php';

	mysql_connect(DB_HOST,DB_USER,DB_PASS);
	mysql_select_db(DB_NAME);

	$userId = $_SESSION['user_id'];
	$id = $_POST['id'];
	
	if(!empty($id)){
		$sql = "DELETE  FROM user WHERE user_id='$id'";
		$result = mysql_query($sql) or die(mysql_error());
		$sql2 = "DELETE  FROM dosen WHERE nidn='$id'";
		$result2 = mysql_query($sql2) or die(mysql_error());
		header('Location: ' . $_SERVER['HTTP_REFERER']);
	}
?>

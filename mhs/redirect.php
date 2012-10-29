<?php
	defined('__NOT_DIRECT') || define('__NOT_DIRECT',1);
	include '../cek-akses.php';

	if($_SESSION['fromMain'] == "false"){
 		//kirim balik
   		header('Location: ' . $_SERVER['HTTP_REFERER']);
	}
	else{
   		//reset the variable
   		$_SESSION['fromMain'] = "false";
		header('Location: ' . $_SERVER['HTTP_REFERER']);
	}
?>
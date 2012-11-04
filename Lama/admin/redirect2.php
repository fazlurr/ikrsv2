<?php
	defined('__NOT_DIRECT') || define('__NOT_DIRECT',1);
	include '../cek-akses.php';

	if($_SESSION['fromMain'] == "false"){
 		//kirim balik
   		header("Location: add-mhs.php");
	}
	else{
   		//reset the variable
   		$_SESSION['fromMain'] = "false";
	}
	
	header( 'Location: add-mhs.php' );
?>
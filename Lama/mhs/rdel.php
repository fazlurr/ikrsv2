<?php
	defined('__NOT_DIRECT') || define('__NOT_DIRECT',1);
	include '../cek-akses2.php';

	if($_SESSION['fromMain'] == "false"){
 		//kirim balik
   		header("Location: inputkrs.php");
	}
	else{
   		//reset the variable
   		$_SESSION['fromMain'] = "false";
	}

	mysql_connect(DB_HOST,DB_USER,DB_PASS);
	mysql_select_db(DB_NAME);	
	

	$userId = $_SESSION['user_id'];
	$dia = $_GET['del'];

	if($_GET['del']){
    	deletebooking($userId, $dia);
   	}    
	//FUNGSI - FUNGSI 
	function deletebooking($userId, $dia){
    	mysql_query("DELETE * FROM krs WHERE user_id=''".$userId."'");
    	header( 'Location: inputkrs.php' );
	}
?>
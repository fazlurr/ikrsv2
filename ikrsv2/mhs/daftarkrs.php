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

	mysql_connect(DB_HOST,DB_USER,DB_PASS);
	mysql_select_db(DB_NAME);

	//CARA BARU
	$bulan = date('n');

	if ($bulan > 8){
		$bulan_ini = 'Ganjil';
		$tahun_ini = date('Y');
		$tahun_depan = $tahun_ini + 1;
		$tahun = $tahun_ini."/".$tahun_depan;
	}
	else {
		$bulan_ini = 'Genap';
		$tahun_ini = date('Y');
		$tahun_kemarin = $tahun_ini - 1;
		$tahun = $tahun_kemarin."/".$tahun_ini;
	}

	$semester = $bulan_ini;

	$userId = $_SESSION['user_id'];
	$mk = $_POST['mk'];

	foreach($mk as $value){
		$input = mysql_query("INSERT INTO krs (nrp, kode_matkul, semester, tahun) VALUES('$userId', '$value', '$semester', '$tahun')") or die(mysql_error());		
	}
	//header('Location: ' . $_SERVER['HTTP_REFERER']);
?>
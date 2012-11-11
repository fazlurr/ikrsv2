<?php
	//CARA BARU untuk Tahun Ajaran
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
?>
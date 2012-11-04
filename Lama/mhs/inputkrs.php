<?php
	defined('__NOT_DIRECT') || define('__NOT_DIRECT',1);
	include '../cek-akses.php';

	mysql_connect(DB_HOST,DB_USER,DB_PASS);
	mysql_select_db(DB_NAME);

	$nrp = $_SESSION['user_id'];

	$sqlmhs = mysql_query("SELECT * FROM mhs WHERE nrp='".$nrp."'");
	$mhs = mysql_fetch_array($sqlmhs);

	//melakukan query ke database
	$sqlmatkul = mysql_query("SELECT * FROM matakuliah");
	while($k = mysql_fetch_array($sqlmatkul)){
		$kode_matkul[] = $k['kode_matkul'];
		$nama_matkul[] = $k['nama_matkul'];
		$sks[] = $k['sks'];
	}

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

	//cek sudah isi atau belum
	$cek = mysql_query("SELECT * FROM krs WHERE nrp='$nrp' AND semester='$semester' AND tahun='$tahun'");
	if(mysql_num_rows($cek) > 0){
		$trigger = 1;
	}

	if($_POST) { //Buat Output KRS
		$_SESSION['fromMain'] = "true";//Session Khusus buat redirect
	}
?>
<html>
	<head>
		<title>KRS</title>
		<link href="../css/bootstrap-edit.min.css" rel="stylesheet">
		<link href="../css/bootstrap-responsive.min.css" rel="stylesheet">
    	<link href="../css/font-awesome.css" rel="stylesheet">		
    	<!-- Le fav icons -->
    	<link rel="shortcut icon" href="../ico/favicon.ico" />
		<script>
			<?php
				echo "var jumlah = ".count($kode_matkul).";\n";
				echo "var sks = new Array();\n";
				//mengambil sks matakuliah dan memasukkan ke array javascript
				for($j=0; $j<count($kode_matkul); $j++){
					echo "sks['".$kode_matkul[$j]."'] = ".$sks[$j].";\n";
				}
			?>
			
			function hitungtotal(){
				jum = 0;
				for(i=0;i<jumlah;i++){
					id = "mk"+i;
					td1 = "k1"+i;
					td2 = "k2"+i;
					td3 = "k3"+i;
					td4 = "k4"+i;
					if(document.getElementById(id).checked){
						kode_matkul = document.getElementById(id).value
						jum = jum + sks[kode_matkul];
						//untuk mengubah warna latar tabel apabila diceklist
						document.getElementById(td1).style.backgroundColor = "white";
						document.getElementById(td2).style.backgroundColor = "white";
						document.getElementById(td3).style.backgroundColor = "white";
						document.getElementById(td4).style.backgroundColor = "white";
					}
					else {
						document.getElementById(td1).style.backgroundColor = "transparent";
						document.getElementById(td2).style.backgroundColor = "transparent";
						document.getElementById(td3).style.backgroundColor = "transparent";
						document.getElementById(td4).style.backgroundColor = "transparent";
					}
				}
				//menampilkan total jumlah SKS yang diambil
				document.getElementById("jsks").innerHTML = jum;
			}
		</script>
	</head>
	<body style="background: url(../img/cubes.png);">
		<div class="navbar navbar-inverse navbar-fixed-top"><!--NAVBAR-->
      		<div class="navbar-inner">
	        	<div class="container">
	          		<a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
			            <span class="icon-bar"></span>
			            <span class="icon-bar"></span>
			            <span class="icon-bar"></span>
	          		</a>
		        	<a class="brand" href="http://localhost/ikrs">iKRS</a>
		        	<div class="nav-collapse collapse">
	            		<ul class="nav">
	              			<li><a href="index.php"><i class="icon-home"></i> Home</a></li>
	              			<li class="active"><a href="inputkrs.php"><i class="icon-check"></i> KRS Online</a></li>
	              			<li><a href="../logout.php"><i class="icon-signout"></i>Logout</a></li>
	            		</ul>
	          		</div><!--/.nav-collapse -->
        		</div>
      		</div>
    	</div><!--Navbar End-->

    	<div style="margin-top: 50px;"></div>
		<?php
			if (!empty($trigger)){
		?>
			<div class="container"> <!--Output-->
				<!--<div class="row-fluid" style="padding: 10px;">-->
					<h2>Berikut KRS yang anda ambil :</h2>					
					<table class="table table-hover table-bordered">
						<tr>
							<th height="25">No.</th>
							<th>Kode Mata Kuliah</th>
							<th>Nama Mata Kuliah</th>
							<th>Semester</th>
							<th>Tahun</th>
							<th>SKS</th>
							<th>Fungsi</th>
						</tr>
						<?php
							$krs = mysql_query("SELECT a.kode_matkul, a.semester, a.tahun, b.nama_matkul, b.sks FROM krs a LEFT JOIN matakuliah b ON b.kode_matkul = a.kode_matkul WHERE a.nrp='$nrp' AND a.semester='$semester' AND a.tahun='$tahun'");
							$jum = 0;
							$i = 1;
							while($k = mysql_fetch_array($krs)){
						?>
								<tr>
									<td><?=$i;?></td>
									<td><?=$k['kode_matkul'];?></td>
									<td><?=$k['nama_matkul'];?></td>
									<td><?=$k['semester'];?></td>
									<td><?=$k['tahun'];?></td>
									<td><?=$k['sks'];?></td>
									<td>
										<form name="hapuskrs" method="post" action="hapuskrs.php" onSubmit="return confirm('Click OK or Cancel to Continue');">
            								<input type="hidden" name="km" value="<?php echo $k['kode_matkul']; ?>"> 
            								<button type="submit" class="btn btn-danger btn-large"><i class="icon-trash icon-white icon-large"></i></button>
          								</form>
									</td>
								</tr>
						<?php
								$jum = $jum + $k['sks'];
								$i++;
							}
						?>
						<tr>
							<td colspan="5">
								<b>JUMLAH SKS</b>
							</td>
							<td>
								<b><?=$jum;?></b>
							</td>
							<td></td>
						</tr>
					</table>
					<p>
					<center>
						<input class="btn btn-info" type="button" value="Cetak" onClick="window.print();" style="cursor:pointer;">
					</center>
				<!--</div>-->
			</div><!--Output Selesai-->
		<?php
			}
		?>	
		<div class="container"><!--Menampilkan Mata Kuliah -->
			<!--<div class="row-fluid" style="padding: 10px;">-->
				<form name="inputkrs" method="post" action="daftarkrs.php">
					<input type="hidden" name="user_id" value="<?=$mhs['nrp'];?>">
					<br>
					<h3>Nama : <?=$mhs['nama'];?></h3>
					<div id="bottom-shadow"></div>
					<table class="table table-hover">
						<tr>
							<th>Kode Mata Kuliah</th>
							<th>Nama Mata Kuliah</th>
							<th>SKS</th>
							<th><center>Ambil</center></th>
						</tr>
						<?php
						//menampilkan matakuliah ke dalam tabel
						for($i=0; $i<count($kode_matkul); $i++){
							
							$cek2 = mysql_query("SELECT * FROM krs WHERE nrp='$nrp' AND kode_matkul='$kode_matkul[$i]' AND tahun='$tahun'");
							if(mysql_num_rows($cek2) < 1){
						?>
						<tr>
							<td id="k1<?=$i;?>"><?=$kode_matkul[$i];?></td>
							<td id="k2<?=$i;?>"><?=$nama_matkul[$i];?></td>
							<td id="k3<?=$i;?>"><?=$sks[$i];?></td>
							<td id="k4<?=$i;?>">
								<div class="roundedTwo">
									<input type="checkbox" id="roundedTwo<?=$i?>" name="mk[]" onClick="hitungtotal()" value="<?=$kode_matkul[$i];?>" id="mk<?=$i;?>">
									<label for="roundedTwo<?=$i?>"></label>
								</div>
							</td>
						</tr>
						<?php
							}
						}
						?>
						<!--<tr>
							<td colspan="3"><b>JUMLAH YANG DIAMBIL</b></td>
							<td align="center"><span id="jsks"></span></td>
						</tr>-->
						<tr>
							<td colspan="4" align="center">
								<input class="btn btn-primary" type="submit" value="Daftarkan" style="cursor:pointer;">
							</td>
						</tr>
					</table>
					<div id="top-shadow"></div>
				</form>
			<!--</div>-->

		<!-- Le javascript
	    ================================================== -->
	    <!-- Placed at the end of the document so the pages load faster-->
	    <script src="../js/jquery-1.8.2.min.js"></script>
	    <script src="../js/bootstrap-transition.js"></script>
	    <script src="../js/bootstrap-alert.js"></script>
	    <script src="../js/bootstrap-modal.js"></script>
	    <script src="../js/bootstrap-dropdown.js"></script>
	    <script src="../js/bootstrap-scrollspy.js"></script>
	    <script src="../js/bootstrap-tab.js"></script>
	    <script src="../js/bootstrap-tooltip.js"></script>
	    <script src="../js/bootstrap-popover.js"></script>
	    <script src="../js/bootstrap-button.js"></script>
	    <script src="../js/bootstrap-collapse.js"></script>
	    <script src="../js/bootstrap-carousel.js"></script>
	    <script src="../js/bootstrap-typeahead.js"></script>
	</body>
</html>
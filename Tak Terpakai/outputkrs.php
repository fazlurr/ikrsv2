<html>
<head>
<title>Output KRS</title>
<style>
body { margin:0; padding:0; font-family:sans-serif; }
#wrapper { background:#9900cc; width:795px; height:650px; margin:0 auto; text-align:center; padding-top:5px; }
#tabel_krs { background:#ffffff; width:700px; margin:0 auto; text-align:left; }
</style>
<?php
mysql_connect("localhost","root","");
mysql_select_db("rpl");

/* Start = menentukan semester ganjil/genap */
$nama_bulan = array('Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember');
$bulan = date('n') - 1;
$bulan_ini = $nama_bulan[$bulan];
$data_arr = array(0 => array("semester" => 0, "month" => "Agustus September Oktober November Desember"),
1 => array("semester" => 1, "month" => "Januari Februari Maret April Mei Juni Juli")
);
for ($i=0; $i<count($data_arr); $i++) {
if ($bulan_ini == $data_arr[$i]['month']){
$bulan_ini = 'Ganjil';
}
else {
$bulan_ini = 'Genap';
}
}
$semester = $bulan_ini;
/* End = menentukan semester ganjil/genap */

/* Start = menentukan tahun ajaran sekarang */
$tahun_ini = date('Y');
$tahun_kemarin = $tahun_ini - 1;
$tahun = $tahun_kemarin."/".$tahun_ini;
/* Start = menentukan tahun ajaran sekarang */

$npm = $_POST['npm'];
$mk = $_POST['mk'];

//cek apakah mahasiswa sudah pernah isi KRS di semester sekarang atau belum
$cek = mysql_query("SELECT * FROM krs WHERE npm='$npm' AND semester='$semester' AND tahun='$tahun'");
if(mysql_num_rows($cek) > 0){
?>
<script>
alert("No NPM <?=$npm;?> sudah pernah mengisi KRS pada semester ini");
window.close();
if (window.close){
window.location = "index.php"
}
</script>
<?php
}
else {
foreach($mk as $value){
$input = mysql_query("INSERT INTO krs (npm, kode_matkul, semester, tahun) VALUES('$npm', '$value', '$semester', '$tahun')");
}
?>
<script>
alert("Data berhasil dimasuka ke database");
</script>
<?php
}
?>
</head>
<body>
<div id="wrapper">
<h2>Berikut KRS yang anda ambil :</h2>
<div id="tabel_krs">
<table border="1" width="100%" cellpadding="1" cellspacing="1">
<tr align="center" style="background:#9966FF">
<th height="25">No.</th>
<th>Kode Mata Kuliah</th>
<th>Nama Mata Kuliah</th>
<th>Semester</th>
<th>Tahun</th>
<th>SKS</th>
</tr>
<?php
$krs = mysql_query("SELECT a.kode_matkul, a.semester, a.tahun, b.nama_matkul, b.sks FROM krs a LEFT JOIN matakuliah b ON b.kode_matkul = a.kode_matkul WHERE a.npm='$npm' AND a.semester='$semester' AND a.tahun='$tahun'");
$jum = 0;
$i = 1;
while($k = mysql_fetch_array($krs)){
?>
<tr>
<td><?=$i;?></td>
<td><?=$k['kode_matkul'];?></td>
<td><?=$k['nama_matkul'];?></td>
<td align="center"><?=$k['semester'];?></td>
<td align="center"><?=$k['tahun'];?></td>
<td align="center"><?=$k['sks'];?></td>
</tr>
<?php
$jum = $jum + $k['sks'];
$i++;
}
?>
<tr><td colspan="5"><b>JUMLAH SKS</b></td><td align="center"><b><?=$jum;?></b></td></tr>
</table>
<p>
<center><input type="button" value="Cetak" onclick="window.print();" style="cursor:pointer;" /></center>
</div>
</div>
</body>
</html>
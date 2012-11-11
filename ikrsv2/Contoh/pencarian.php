<!-- form quick search -->
<form name="form1" method="get" action="">
Search : <input type="text" name="q" id="q"/> <input type="submit" value="Search"/>
</form>
<!-- menampilkan hasil pencarian -->
<?php
if(isset($_GET['q']) && $_GET['q']){
	$conn = mysql_connect("localhost", "root", "");
	mysql_select_db("belajar2");
	$q = $_GET['q'];
	$sql = "select * from mahasiswa where nama like '%$q%' ";
	$result = mysql_query($sql);
	if(mysql_num_rows($result) > 0){
		?>
		<table>
			<tr>
				<td>Nama</td>
			<?php
			while($mahasiswa = mysql_fetch_array($result)){?>
			<tr>
				<td><?php echo $mahasiswa['nama'];?></td>
			</tr>
			<?php }?>
		</table>
		<?php
	}else{
		echo 'Pencarian tidak ditemukan!';
	}
}
?>
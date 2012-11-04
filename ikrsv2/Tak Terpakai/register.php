<?php
defined('__NOT_DIRECT') || define('__NOT_DIRECT',1);
include 'cek-akses.php';
if($_POST){
	mysql_connect(DB_HOST,DB_USER,DB_PASS);
	mysql_select_db(DB_NAME);
	if($_POST['password'] != $_POST['password2']){
		echo 'Silahkan ketik ulang password!';
	}else if(!$_POST['user_id']){
		echo 'ID User tidak boleh kosong!';
	}else if(mysql_num_rows(mysql_query("select * from user where user_id='".mysql_real_escape_string($_POST['user_id'])."'"))){
		echo 'User id sudah di pakai, masukkan yang lain!';
	}else{
		mysql_query("insert into user (user_id,name,password,type) values 
		('".mysql_real_escape_string($_POST['user_id'])."','".mysql_real_escape_string($_POST['name'])."',
		'".md5($_POST['password'])."','user')");
		echo "Registrasi berhasil";
	}
}
?>
<form action="" method="post">
	<dl>
		<dt>ID User: </dt>
		<dd><input type"text" name="user_id"/></dd>
		<dt>Nama: </dt>
		<dd><input type="text" name="name"/></dd>
		<dt>Password: </dt>
		<dd><input type="password" name="password"/></dd>
		<dt>Ketik Ulang Password: </dt>
		<dd><input type="password" name="password2"/></dd>
		<dt></dt>
		<dd><input type="submit" value="Register"/></dd>
	</dl>
</form>

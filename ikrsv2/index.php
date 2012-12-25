<?php
	defined('__NOT_DIRECT') || define('__NOT_DIRECT',1);
	include 'cek-akses2.php';
	if($_POST){
		mysql_connect(DB_HOST,DB_USER,DB_PASS);
		mysql_select_db(DB_NAME);
		$userId = mysql_real_escape_string($_POST['user_id']);
		$data = mysql_fetch_array(mysql_query("SELECT * from user where user_id='".$userId."'"));
		if($data !== false && $data['password'] == md5($_POST['password'])){
			//login berhasil
			$_SESSION['tipe_user'] = $data['type'];
			$_SESSION['user_id'] = $data['user_id'];
			$_SESSION['my_user_agent'] = md5($_SERVER['HTTP_USER_AGENT']);
			header("Location: admin/index.php");
			//tambahan kalau user langsung ke /user/
			if($_SESSION['tipe_user']=="mhs"){
				header("Location: mhs/index.php");
			}
			elseif($_SESSION['tipe_user']=="dosen"){
				header("Location: dosen/index.php");
			}
		}
		else {
			$errors = 1;
		}  
	}
?>

<!DOCTYPE html>
<html lang="en">
	<head>
	    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	    <meta charset="utf-8">
	    <title>iKRS</title>
	    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	    <meta name="description" content="">
	    <meta name="author" content="">

	    <!-- Le styles -->
	    <link href="css/bootstrap.min.css" rel="stylesheet">
	    <style>
	    	body {
	    		padding-top: 20px; /* 60px to make the container go all the way to the bottom of the topbar */
	      	}
	    </style>
	    <link href="css/bootstrap-responsive.min.css" rel="stylesheet">
	    <link href="css/font-awesome.css" rel="stylesheet">
	   	<link href="css/custom.css" rel="stylesheet">
	    <link href="css/animate.min.css" rel="stylesheet">
	    <!-- Le HTML5 shim, for IE6-8 support of HTML5 elements -->
	    <!--[if lt IE 9]>
	      <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
	    <![endif]-->

    	<!-- Le fav and touch icons -->
    	<link rel="shortcut icon" href="ico/favicon.ico" /> 
  	</head>

 	<body style="background: url(img/cubes.png);">
	    <div class="container" style="width: 300px;">
	    	<div class="row">
    			<center>
    				<img src="img/logo-ikrs.png">
    				<h1 class="ikrs" style="cursor:default;"><span class="i">i</span>KRS</h1>
    			</center>
    			<div style="text-align : center; background : whiteSmoke;">
	    			<div id="bottom-shadow"></div>
	    			<div class="well">
		    			<br>
		    			<?php //Kalau Error
		    			if ( !empty($errors) )
							echo '<div class="label label-important">User ID atau Password Salah </div><br>';
						?>
				    	<form method="post" action="">
							<input type="text" name="user_id" placeholder="User ID" /><br>
							<input type="password" name="password" placeholder="Password" /><br>
							<button type="submit" class="btn btn-primary"><i class="icon-signin"></i> Login</button>
						</form>
						<br>
					</div>
					<div id="top-shadow"></div>
				<div>
			</div>
	    </div> <!-- /container -->

	    <!-- Le javascript
	    ================================================== -->
	    <!-- Placed at the end of the document so the pages load faster -->
	    <script src="js/jquery-1.8.2.min.js"></script>
	    <script src="js/bootstrap.min.js"></script>
  	</body>
</html>
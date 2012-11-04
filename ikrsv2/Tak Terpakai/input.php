<?php 
  session_start();
  //session_destroy();
  $user = isset($_REQUEST['user']) ? $_REQUEST['user'] : '';
  $pass = isset($_REQUEST['pass']) ? $_REQUEST['pass'] : '';
  if ($user=="" || $pass=="") {
    $err="1";
  }
  else {
    $err="2";
  }
  if ($err=="1")
    $pesan="<script>alert('isi username dan password anda');</script>";
  if ($err=="2") {
       //$nm="admin"; $pw="123";
      
      if ($user=="admin" && $pass=="123")
       {
       session_start();
       $_SESSION['user']="admin";
       $_SESSION['pass']="123";
       header("location:inputkrs.php");
       }
       else
       {
       $err="3";
       }
  }
  if ($err=="3")
  $pesan="<script>alert('isi username dan password anda');</script>";
?>
<html>
<head>
<title>input</title>
<style type="text/css">
<!--
.style3 {font-family: Geneva, Arial, Helvetica, sans-serif; font-weight: bold; }
.style5 {font-family: Geneva, Arial, Helvetica, sans-serif; font-weight: bold; color: #FFFFFF; }
-->
</style>
</head>
<body>
<form id="form1" name="form1" action="">
  <table width="40%" border="0" align="center">
    <tr>
      <td colspan="2" align="center" bgcolor="#000000"><span class="style5">Login</span></td>
    </tr>
    <tr>
      <td width="35%"><span class="style3">Username</span></td>
      <td width="65%"><input name="user" type="text" id="user" value="<?php echo $user; ?>" /></td>
    </tr>
    <tr>
      <td><span class="style3">Password</span></td>
      <td><input name="pass" type="password" id="pass" value="<?php echo $pass; ?>" /></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td><input name="Submit" type="submit" value="Submit" /><?php echo $pesan; ?></td>
    </tr>
  </table>
</form>
</body>
</html>

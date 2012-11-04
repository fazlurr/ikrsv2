<?php
# FileName="Connection_php_mysql.htm"
# Type="MYSQL"
# HTTP="true"
$hostname_LocalCoy = "localhost";
$database_LocalCoy = "ikrs";
$username_LocalCoy = "root";
$password_LocalCoy = "";
$LocalCoy = mysql_pconnect($hostname_LocalCoy, $username_LocalCoy, $password_LocalCoy) or trigger_error(mysql_error(),E_USER_ERROR); 
?>
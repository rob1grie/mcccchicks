<?php
# FileName="Connection_php_mysql.htm"
# Type="MYSQL"
# HTTP="true"
$hostname_dbConn = "localhost";
$database_dbConn = "iglesiav_chicks";
$username_dbConn = "iglesiav_chickdb";
$password_dbConn = "ChickDb1";
$dbConn = mysql_pconnect($hostname_dbConn, $username_dbConn, $password_dbConn) or trigger_error(mysql_error(),E_USER_ERROR); 
?>
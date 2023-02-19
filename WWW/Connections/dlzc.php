<?php
# FileName="Connection_php_mysql.htm"
# Type="MYSQL"
# HTTP="true"
$hostname_dlzc = "localhost";
$database_dlzc = "lsww11";
$username_dlzc = "ls";
$password_dlzc = "123456";
$dlzc = mysql_pconnect($hostname_dlzc, $username_dlzc, $password_dlzc) or trigger_error(mysql_error(),E_USER_ERROR); 
?>
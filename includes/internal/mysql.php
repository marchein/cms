<?php
$mysqli_connect = new mysqli($mysql_server,  $mysql_username,  $mysql_password, $mysql_database);
$GLOBALS["mysqli_connect"] = $mysqli_connect;
$mysqli = $mysqli_connect;
$GLOBALS["mysqli"] = $mysqli;
?>
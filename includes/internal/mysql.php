<?php
@$mysqli = new mysqli($mysql_server,  $mysql_username,  $mysql_password, $mysql_database);
if(isset($mysqli->connect_error)) {
    die($mysqli->connect_error);
} else {
    $GLOBALS["mysqli"] = $mysqli;
    $mysqli_connect = $mysqli;
    $GLOBALS["mysqli_connect"] = $mysqli_connect;

}
?>
<?php
@$mysqli = new mysqli($mysql_server,  $mysql_username,  $mysql_password, $mysql_database);
if(isset($mysqli->connect_error)) {
    die("<h3>MySQL Fehler: ". $mysqli->connect_error ."</h3>\n<br/>Eventuell falschen Host in '/includes/internal/config.php' eingestellt? [In 99% der Fälle ist 'localhost' korrekt.]");
} else {
    $GLOBALS["mysqli"] = $mysqli;
    $mysqli_connect = $mysqli;
    $GLOBALS["mysqli_connect"] = $mysqli_connect;

}
?>
<?php
@$mysqli = new mysqli($mysql_server,  $mysql_username,  $mysql_password, $mysql_database);
if(isset($mysqli->connect_error)) {
    die("<h3>".$GLOBALS["lang"]["mysql_error"].": ". $mysqli->connect_error ."</h3>\n<br/>".$GLOBALS["lang"]["mysql_error_help"]);
} else {
    $GLOBALS["mysqli"] = $mysqli;
}

function doQuery($query) {
    $result = $GLOBALS["mysqli"]->query($query);
    return $result;
}

function mySQLfetch($result) {
    $row = $result->fetch_object();
}
?>
﻿<?php
function getRights($user) {
    $user = mysqli_real_escape_string($GLOBALS["mysqli"], $user);
    $query   = "SELECT rights FROM `user` WHERE `name` ='".$user."' OR `ID` = '".$user."'";
    $result = $GLOBALS["mysqli"]->query($query);
    $data = mysqli_fetch_object($result);
    if(mysqli_num_rows($result) > 0) {
        $userrights = $data->rights;
    } else {
        $userrights = 0;
    }
    return $userrights;
}

session_start();
if(isset($_POST['login']))  {
    $query   = "SELECT name, password FROM `user` WHERE name ='" . $_POST['login'] . "'";
    $result = $mysqli->query($query);
    $data = mysqli_fetch_object($result);
    @$login = $data->name;
    @$pw    = $data->password;
}

/*if (!isset($_SESSION['is_login'])) {
    $_SESSION['is_login'] = false;
}


if (!isset($_SESSION['username'])) {
    $_SESSION['username'] = null;
}*/

$loginsend = 0;


if (@$_POST["log_in"]) {
    if (getHash($_POST['pw']) == $pw) {
        $is_login  = true;
        $loginsend = 1;
        //Sessions
        $_SESSION['is_login'] = true;
        $_SESSION['username'] = $login;
    } else {
        $loginsend = 2;
    }
}

if (isset($_GET["log_out"]) && $_GET["log_out"]) {
    $is_login  = false;
    $loginsend = 3;
    unset($_SESSION['is_login']);
    unset($_SESSION['username']);
}


if(isset($_SESSION["is_login"]) && isset($_SESSION["is_login"])) {
	$is_login = $_SESSION["is_login"];
	$username = $_SESSION["username"];
	$userrights = getRights($username);
	$GLOBALS["is_login"] = $is_login;
	$GLOBALS["loginsend"] = $loginsend;
}

?>
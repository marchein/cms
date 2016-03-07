<?php
include("includes/themes/bootstrap/theme.config.php");
echo '<!DOCTYPE html>
<html lang=de>
<head>
    <meta charset="utf-8"/>
    <title>'.getCurrentPageName($_GET["id"], $_GET["newsid"]).'</title>';
getCSS();
echo'</head>';
?>
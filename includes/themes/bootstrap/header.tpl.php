<?php
include("includes/themes/bootstrap/theme.config.php");
$currentNewsID = null;
if(isset($_GET["newsid"])) {
    $currentNewsID = $_GET["newsid"];
}
echo '<!DOCTYPE html>
<html lang=de>
<head>
    <meta charset="utf-8"/>
    <title>'.getCurrentPageName($_GET["id"], $currentNewsID).'</title>';
getCSS();
echo'</head>';
?>
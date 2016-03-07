<?php
include("includes/templates/theme.config.php");
echo "<!DOCTYPE html>
<html lang=de>
<head>
<meta charset='utf-8'/>";
echo '<title>'.getCurrentPageName($_GET["id"], $_GET["newsid"]).'</title>';
getCSS();
echo'</head>';
?>
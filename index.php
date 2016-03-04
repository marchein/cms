<?php
require_once ("includes/internal/config.php");
require_once ("includes/internal/mysql.php");
require_once ("includes/internal/features.php");
require_once ("includes/internal/admin_login.php");

date_default_timezone_set('Europe/Berlin');
mb_internal_encoding('UTF-8');

getHeaders();

echo "<!DOCTYPE html>
<html>
<head>
<meta charset='utf-8'/>
<title>" . getPageName() . "</title>\n";
getLoggedIn();
echo "</head>
<body>\n";
getNavigation();
getContent();
echo "\n</body>\n";
echo "</html>";
echo "\n<!-- HeinCMS - Version: ".getVersion()." ".getVersionName()." -->";
$mysqli_connect->close();

?>
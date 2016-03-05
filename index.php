<?php
require_once ("includes/internal/config.php");
require_once ("includes/internal/mysql.php");
require_once ("includes/internal/features.php");
require_once ("includes/internal/admin_login.php");

date_default_timezone_set('Europe/Berlin');
mb_internal_encoding('UTF-8');

getHeaders();

include('includes/templates/header.tpl.php');
echo"\n<body>\n";
getNavigation();
getContent();
echo "\n</body>\n";
include('includes/templates/footer.tpl.php');

?>
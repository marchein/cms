<?php
if(file_exists("includes/internal/config.php")) {
    require_once ("includes/internal/config.php");
    require_once ("includes/internal/languageFunctions.php");   
    require_once ("includes/internal/mysql.php");
    require_once ("includes/internal/internalFeatures.php");
    require_once ("includes/internal/admin_login.php");

    date_default_timezone_set('Europe/Berlin');
    mb_internal_encoding('UTF-8');
    ini_set ('display_errors',1);
    error_reporting(E_ALL);

    getLanguage();
    getHeaders();

    include($path.'/header.tpl.php');
    echo"\n<body>\n";
    getNavigation();
    getContent();
    echo "\n</body>\n";
    include($path.'/footer.tpl.php');
    echo "\n<!-- HeinCMS - Version: ".getVersion()." ".getVersionName()." -->";
    $mysqli->close();
} else {
    die("includes/internal/config.php not found");
}
?>
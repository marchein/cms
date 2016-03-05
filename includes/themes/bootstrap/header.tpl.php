<?php
include("includes/themes/bootstrap/theme.config.php");
echo "<!DOCTYPE html>
<html>
<head>
<meta charset='utf-8'/>
<title>" . getPageName() . "</title>\n";
getLoggedIn();
foreach(glob("includes/themes/bootstrap/*.css") as $css) {
    echo '<link rel="stylesheet" href="'.$css.'">';
}
echo'
    <link rel="stylesheet" type="text/css" href="//netdna.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap-theme.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
</head>';
?>
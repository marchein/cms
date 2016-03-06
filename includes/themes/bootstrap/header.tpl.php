<?php
include("includes/themes/bootstrap/theme.config.php");
echo "<!DOCTYPE html>
<html>
<head>
<meta charset='utf-8'/>
<title>" . getPageName() . "</title>\n";
getLoggedIn();
foreach(glob("includes/themes/bootstrap/*.css") as $css) { // local css
    echo '<link rel="stylesheet" href="'.$css.'">';
    echo "\n";
}
foreach($theme["bootstrap"]["css"] as $css) { // remote css
    echo '<link rel="stylesheet" href="'.$css.'">';
    echo "\n";
}

echo'</head>';
?>
<?php
include("includes/themes/bootstrap/theme.config.php");
echo "<!DOCTYPE html>
<html lang=de>
<head>
<meta charset='utf-8'/>";
echo '<title>'.getCurrentPageName($_GET["id"], $_GET["newsid"]).'</title>';
foreach(glob("includes/themes/".$theme["bootstrap"]["url"]."/*.css") as $css) { // local css
    echo '<link rel="stylesheet" href="'.$css.'">';
    echo "\n";
}
if(!empty($theme[$theme["bootstrap"]["url"]]["css"])) {
    foreach($theme[$theme["bootstrap"]["url"]]["css"] as $css) { // remote css
        echo '<link rel="stylesheet" href="'.$css.'">';
        echo "\n";
    }
}

echo'</head>';
?>
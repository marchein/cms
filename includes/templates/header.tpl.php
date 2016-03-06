<?php

echo '<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8"/>';
echo '<title>'.getCurrentPageName($_GET["id"], $_GET["newsid"]).'</title>';
foreach(glob("includes/themes/".$theme["default"]["url"]."/*.css") as $css) { // local css
    echo '<link rel="stylesheet" href="'.$css.'">';
    echo "\n";
}
if(!empty($theme[$theme["default"]["url"]]["css"])) {
    foreach($theme[$theme["default"]["url"]]["css"] as $css) { // remote css
        echo '<link rel="stylesheet" href="'.$css.'">';
        echo "\n";
    }
}
echo'</head>';
?>
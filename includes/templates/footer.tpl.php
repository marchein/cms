<?php
if(!empty($theme[$theme["default"]["url"]]["js"])) {
    foreach($theme[$theme["default"]["url"]]["js"] as $js) { // remote css
        echo '<script src="'.$js.'"></script>';
        echo "\n";
    }
}
echo "</html>";
echo "\n<!-- HeinCMS - Version: ".getVersion()." ".getVersionName()." -->";
$mysqli->close();
?>
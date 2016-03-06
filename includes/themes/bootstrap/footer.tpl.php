<?php
foreach($theme[$theme["bootstrap"]["url"]]["js"] as $js) { // remote css
    echo '<script src="'.$js.'"></script>';
    echo "\n";
}
echo "</html>";
echo "\n<!-- HeinCMS - Version: ".getVersion()." ".getVersionName()." -->";
$mysqli_connect->close();
?>
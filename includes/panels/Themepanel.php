<?php
$panelnames["Theme"] = "Design"; // set panel name
if(!isset($isinclude)) { $isinclude = true; } // if unset, set it to true

if($isinclude) { // if included don't run this code, if $isinclude is true -> run code
    if ($handle = opendir('includes/themes')) { // open theme folder and look for themes
        $themes = array(); // initiate array
        $themes[0] = "default"; // set default to [0]
        while (($entry = readdir($handle)) !== false) { // check if handle is dir or file
            if ($entry != "." && $entry != "..") { // exclude current and parent folder
                $themes[] = $entry; // set array entrys to folder entrys
            }
        }
        closedir($handle); // close handle
    }

    $sql = "SELECT theme FROM config"; // fetch current theme
    $currenttheme = mysqli_fetch_object($mysqli_connect->query($sql))->theme; // store it in $currenttheme
    echo'<form action="#">
      <select name="theme">';
        foreach($themes as $theme) {
            ($theme == $currenttheme) ? $option = "<option selected>" : $option =  "<option>"; // pre select current theme
            echo $option.$theme.'</option>'; // show options
        }
      echo'</select>
    </form>';
}
?>
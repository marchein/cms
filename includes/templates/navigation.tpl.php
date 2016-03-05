<?php
$is_login = $GLOBALS["is_login"];

$query = $GLOBALS["mysqli_connect"]->query("SELECT id, name FROM `pages` ORDER BY `pages`.`position` ASC");
    $i = 0;

    while($result = mysqli_fetch_object($query)) {
        {
        if($result->id == 0 && $is_login) {
            echo "<a href='".url()."/?id=0'>".$result->name."</a>";
        } elseif($result->id == 0 && !$is_login) {
            echo "<a href='".url()."/?id=0'>Anmelden</a>";
        } else {
            echo "<a href='".url()."/?id=".$result->id."'>".$result->name."</a>";
        }
            if(mysqli_num_rows($query) > ($i+1)) { echo " || \n"; }
            $i++;
        }

    }

    echo "\n";

    if(getDebug()) {
        if($is_login == 1) {
            echo "<br />Eingeloggt.";
        } else {
            echo "<br />Nicht eingeloggt.";
        }
    }
    ?>
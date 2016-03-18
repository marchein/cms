<?php

    $is_login = $GLOBALS["is_login"];
    $query = $GLOBALS["mysqli"]->query("SELECT id, name FROM `pages` ORDER BY `pages`.`position` ASC");
    $i = 0;

    while($result = mysqli_fetch_object($query)) {
        {
        if($result->id == 0 && $is_login) {
            echo "<a href='".url()."/?id=0'>".$result->name."</a>";
        } elseif($result->id == 0 && !$is_login) {
            echo "<a href='".url()."/?id=0'>".$GLOBALS["lang"]["login"]."</a>";
        } else {
            echo "<a href='".url()."/?id=".$result->id."'>".$result->name."</a>";
        }
            if(mysqli_num_rows($query) > ($i+1)) { echo " || \n"; }
            $i++;
        }

    }
    ?>
<?php

function escapeUser($userid) {
    if(isset($_GET["userid"])) {
        return preg_replace('/\D/', '', $userid);
    }
}

function userExists($user) {
    $query   = "SELECT ID FROM `user` WHERE ID ='".$user."'";
    $result = doQuery($query);
    return $result->num_rows > 0;
}

function editUser($userid) {
    // TODO
    if(isset($userid)) {
        if(isset($_GET["save"]) && $_GET["save"]) {
            saveEditChanges();
        } else {
            if(!userExists($userid)) {
                echo 'User existiert nicht!';
            } else {
                //$userid = escapeUser($userid);

                $query = "SELECT * FROM `user` WHERE `id` = ".$userid;
                $result = doQuery($query);
                $user = $result->fetch_object();
                $fullname = $user->full_name;
                if(!isset($fullname)) { $fullname = "Nicht angegeben"; }
                echo'<form method=\'post\' name=\'form2\' action=\'?id=0&amp;ap=User&amp;userFunction='.$_GET["userFunction"].'&amp;userid='.$_GET["userid"].'&amp;edit=true&amp;save=true\'>
                ID:<br />
                <input type="text" value="'.$user->ID.'" readonly> <br />
                Username:<br />
                <input type="text" value="'.$user->name.'" name="username"/> <br />
                Voller Name:<br />
                <input type="text" value="'.$fullname.'" name="fullname"/> <br />
                E-Mail Adresse:<br />
                <input type="text" value="'.$user->email.'" name="email"/> <br />';
                echo "Rechte:<br />
                " . getRightsName($user->rights) . "<br />
                <input type='submit'>";
                echo '</form>';
            }
        }
    } else {
         echo "User ID nicht gesetzt";
    }
}

function saveEditChanges() {
    // TODO
    var_dump($_POST);
}

function showUser($userid) {
    $userid = escapeUser($userid);
    if(isset($userid)) {
        $query = "SELECT * FROM `user` WHERE `id` = ".$userid;
        $result = doQuery($query);
        $user = $result->fetch_object();
        $fullname = $user->full_name;
        if(!isset($fullname)) { $fullname = "Nicht angegeben"; }
        echo "ID: " . $user->ID . "<br />
        Username: " . $user->name . "<br />
        Voller Name: " . $fullname . "<br />
        E-Mail Adresse: " . $user->email . "<br />
        Rechte: " . getRightsName($user->rights) . "<br />
        <a href='?id=0&ap=User&userFunction=editUser&amp;userid=".$user->ID."&amp;edit=true'>Bearbeiten</a>";
    } else {
        echo "User ID nicht gesetzt";
    }
}

function getUserID($username) {
    $query = "SELECT `ID` FROM `user` WHERE `name` = '".$username."'";
    $result = doQuery($query);
    $user = $result->fetch_object();
    return $user->ID;
}

?>
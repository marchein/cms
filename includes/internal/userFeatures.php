<?php

function escapeUser($userid) {
    if(isset($_GET["userid"])) {
       return $GLOBALS["mysqli"]->real_escape_string($_GET["userid"]);
    }
}

function userExists($user) {
    $user = escapeUser($user);
    $query   = "SELECT ID FROM `user` WHERE ID ='".$user."'";
    $result = doQuery($query);
    return ($result->num_rows != 0);
}

function editUser($userid) {
    if(isset($userid)) {
        if(!userExists($userid)) {
            echo 'User existiert nicht!';
        } else {
            if(getRights($username) >= 2) {
                $userid = getUserID($username);
            }
            $userid = escapeUser($userid);

            $query = "SELECT * FROM `user` WHERE `id` = ".$userid;
            $result = doQuery($query);
            $user = $result->fetch_object();
            $fullname = $user->full_name;
            if(!isset($fullname)) { $fullname = "Nicht angegeben"; }
            echo 'ID:<br />
            <input type="text" value="'.$user->ID.'" readonly> <br />
            Username:<br />
            <input type="text" value="'.$user->name.'"/> <br />
            Voller Name:<br />
            <input type="text" value="'.$fullname.'"/> <br />
            E-Mail Adresse:<br />
            <input type="text" value="'.$user->email.'"/> <br />';
            echo "Rechte:<br />
            " . getRightsName($user->rights) . "<br />";
            }
    } else {
         echo "User ID nicht gesetzt";
    }
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
        <a href='?id=0&amp;ap=User&amp;userlist=true&amp;userid=".$user->ID."&amp;edit=true'>Bearbeiten</a>";
    } else {
        echo "User ID nicht gesetzt";
    }
}

function getUserID($username) {
    $query = 'SELECT name, ID FROM `user` WHERE `name` = ' . $username;
    $result = doQuery($query);
    $user = $result->fetch_object();
    return $user->ID;
}

?>
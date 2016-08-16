<?php

function escapeUser($userid) {
    if(isset($_GET["userid"])) {
       return $GLOBALS["mysqli"]->real_escape_string($_GET["userid"]);
    }
}

function userExists($user) {
    $user = escapeUser($user);
    $query   = "SELECT * FROM `user` WHERE ID ='".$user."'";
    $result = $GLOBALS["mysqli"]->query($query);
    $data = mysqli_fetch_object($result);
    var_dump($data);
    return (mysqli_num_rows($result) == 0);
}

function editUser($userid) {
    if(isset($userid)) {
        var_dump(userExists($userid));
        if(!userExists($userid)) {
            echo 'User existiert nicht!';
        } else {
            if(getRights($username) >= 2) {
                $userid = getUserID($username);
            }
            $userid = escapeUser($userid);

            $query = "SELECT * FROM `user` WHERE `id` = ".$userid;
            $result = $GLOBALS["mysqli"]->query($query);
            $user = mysqli_fetch_object($result);
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
        $result = $GLOBALS["mysqli"]->query($query);
        $user = mysqli_fetch_object($result);
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
    $query = 'SELECT name FROM `user` WHERE `name` = ' . $username;
    $result = $GLOBALS["mysqli"]->query($query);
    $row = $result->fetch_object();
    var_dump($row);
}

?>
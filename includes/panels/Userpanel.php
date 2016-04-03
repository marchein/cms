<?php
$panelname = "User";
$panelnames[$panelname] = $GLOBALS['lang']['user'];
if(!isset($isinclude)) { $isinclude = true; }
if($isinclude) {
    
    /*
    if(isset($_GET["userid"])) {
            $userid = $mysqli->real_escape_string($_GET["userid"]);
        }
        if(isset($userid)) {
            $query = "SELECT * FROM `user` WHERE `id` = ".$userid;
            $result = $mysqli->query($query);
            $user = mysqli_fetch_object($result);
            $fullname = $user->full_name;
            if(!isset($fullname)) { $fullname = "Nicht angegeben"; }
            echo "ID: " . $user->ID . "<br />
            Username: " . $user->name . "<br />
            Voller Name: " . $fullname . "<br />
            E-Mail Adresse: " . $user->email . "<br />
            Rechte: " . getRightsName($user->rights) . "<br />";
        } else {
            $query = "SELECT * FROM `user`";
            $result = $mysqli->query($query);
            // if($debug) { var_dump($result); }
            echo "<table class='table'>
            <tr>
                <th>Name</th>
                <th>Rechte</th>
            </tr>";
            while ($row = mysqli_fetch_object($result)) {
                $fullname = $row->full_name;
                if(!isset($fullname)) { $fullname = "Nicht angegeben"; }
                echo "<tr>
                    <td><a href='?id=0&ap=User&userlist=true&amp;userid=".$row->ID."'>".$row->name."</a> (".$fullname.")</td>
                    <td>".getRightsName($row->rights)."</td>
                </tr>";
            }
            echo "</table>";
        }
        */
}
?>
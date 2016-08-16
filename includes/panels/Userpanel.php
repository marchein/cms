<?php
$panelname = "User";
$panelnames[$panelname] = $GLOBALS['lang']['user']; // set panel name
if(!isset($isinclude)) { $isinclude = true; } // if unset, set it to true

if($isinclude) { // if included don't run this code, if $isinclude is true -> run code

    if ($userrights == "1" && ($_GET["userlist"])) {
        if(isset($_GET["userid"])) {
            $userid = $mysqli->real_escape_string($_GET["userid"]);
        }
        if(isset($userid)) {
            if($_GET["edit"]) {
                editUser($userid);
            } else {
                showUser($userid);
            }
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
    } else if($userrights == 1) {
        echo '<a href="?id=0&ap=User&amp;userlist=true">Nutzerliste anzeigen</a>';
    } else {
        echo "Nicht genügend Rechte. Nur Option eigenes Profil zu bearbeiten.";
    }
}
?>
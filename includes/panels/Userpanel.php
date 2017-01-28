<?php
$panelname = "User";
$panelnames[$panelname] = $GLOBALS['lang']['user']; // set panel name
if(!isset($isinclude)) { $isinclude = true; } // if unset, set it to true

if($isinclude) { // if included don't run this code, if $isinclude is true -> run code

    if(isset($_GET["userFunction"])) {
    if ($userrights == "1" && $_GET["userFunction"] == "showList") {
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
                if (!isset($fullname)) {
                    $fullname = "Nicht angegeben";
                }
                echo "<tr>
                    <td><a href='?id=0&ap=User&userFunction=showUser&amp;userid=" . $row->ID . "'>" . $row->name . "</a> (" . $fullname . ")</td>
                    <td>" . getRightsName($row->rights) . "</td>
                </tr>";
            }
            echo "</table>";
    } elseif ($_GET["userFunction"] == "showUser") {
        if (isset($_GET["userid"])) {
            showUser($mysqli->real_escape_string($_GET["userid"]));
        }
    } elseif ($_GET["userFunction"] == "editUser") {
        if (isset($_GET["userid"])) {
            editUser($mysqli->real_escape_string($_GET["userid"]));
        }
    } elseif ($_GET["userFunction"] == "editSelf") {
        editUser(getUserID($_SESSION["username"]));
    } else {
        echo "Fehler";
    }
    } else {
        if ($userrights == 1) {
            echo '<a href="?id=0&ap=User&amp;userFunction=showList">Nutzerliste anzeigen</a><br />';
        }
        echo '<a href="?id=0&ap=User&amp;userFunction=editSelf">Eigenes Profil bearbeiten</a><br />';
    }
}
?>
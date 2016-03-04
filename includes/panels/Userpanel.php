<?php

$panelnames["User"] = "Nutzer Verwaltung";
if(!isset($isinclude)) { $isinclude = true; }
if($isinclude) {
    if(isset($_GET["userlist"]) && $_GET["userlist"]) {
        if(isset($_GET["userid"])) {
            $userid = $mysqli_connect->real_escape_string($_GET["userid"]);
        }
        if($rechte == 1) {
            if(isset($userid)) {
                $query = "SELECT * FROM `user` WHERE `id` = ".$userid;
                $result = $mysqli_connect->query($query);
                $user = mysqli_fetch_object($result);
                $fullname = $user->full_name;
                if(!isset($fullname)) { $fullname = "Nicht angegeben"; }
                echo "ID: " . $user->ID . "<br />
                Username: " . $user->name . "<br />
                Voller Name: " . $fullname . "<br />
                E-Mail Adresse: " . $user->email . "<br />
                Rechte: " . getRechteName($user->rechte) . "<br />";
            } else {
                $query = "SELECT * FROM `user`";
                $result = $mysqli_connect->query($query);
                // if($debug) { var_dump($result); }
                echo "<table>
                <tr>
                    <th>Name</th>
                    <th>Rechte</th>
                </tr>";
                while ($row = mysqli_fetch_object($result)) {
                    $fullname = $row->full_name;
                    if(!isset($fullname)) { $fullname = "Nicht angegeben"; }
                    echo "<tr>
                        <td><a href='?id=0&ap=User&userlist=true&amp;userid=".$row->ID."'>".$row->name."</a> (".$fullname.")</td>
                        <td>".getRechteName($row->rechte)."</td>
                    </tr>";
                }
                echo "</table>";
            }
        } else {
            $showAccountSettings = true;
        }
    } else {
        echo "<a href='?id=0&amp;ap=User&amp;userlist=true'>Nutzerliste</a><br />\n";
    }
}
?>
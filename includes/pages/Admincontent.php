<?php
$username = $_SESSION["username"];
$rechte = getRechte($username);

echo "<h1>Interner Bereich</h1>\n";
if(getLoginsend() == 1) {
        echo'Erfolgreich angemeldet! Klicke <a href="?id=0">hier</a> um fortzufahren.';
    } else if(getLoginsend() == 2) {
        echo'Falscher Benutzername und/oder falsches Passwort! Klicke <a href="?id=0">hier</a> um\'s erneut zu versuchen.';
    } else if(getLoginsend() == 3) {
        echo'Erfolgreich abgemeldet! Klicke <a href="?id=1">hier</a> um fortzufahren.';
    } else {

        if ($is_login) {
            @$ap = $_GET["ap"];
            if(file_exists("includes/panels/".$ap."panel.php") && isset($ap)) {
                include("includes/panels/".$ap."panel.php");
            } else {
                if ($handle = opendir('includes/panels')) {
                    while (($entry = readdir($handle))!== false) {
                        if ($entry != "." && $entry != "..") {
                            $panel = str_replace("panel.php","", $entry);
                            $panelnames = getPanelNames();
                            if(isset($ap) && $ap == $panel) {
                                include("includes/panels/".$entry);
                            } else {
                                echo "<a href='".url()."/?id=0&amp;ap=".$panel."'>".$panelnames[$panel]."</a><br />\n";
                            }
                        }
                    }
                    closedir($handle);
                }
                echo"<br />\n<a href='".url()."/?id=0&amp;log_out=true'>Log out</a>";
            }
        } else {
            if(@$_GET["sp"]=="lost") {
                include("plugins/forgot.php");
            } elseif(@$_GET["sp"]=="register") {
                include("plugins/register.php");
            } else {
                include ($GLOBALS["path"]."/login.tpl.php");
            }
        }
}
?>
<?php
$username = null;
if(isset($_SESSION["username"])) {
    $username = $_SESSION["username"];
    $userrights = getRights($username);
}

echo "<h1>".$GLOBALS['lang']['intern']."</h1>\n";
    if(getLoginsend() == 1) {
        echo $GLOBALS['lang']['loggedin'];
    } else if(getLoginsend() == 2) {
        echo $GLOBALS['lang']['error_logging_in'];
    } else if(getLoginsend() == 3) {
        echo $GLOBALS['lang']['loggedout'];
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
                echo "<br />\n<a href='".url()."/?id=0&amp;log_out=true'>".$GLOBALS["lang"]["logout"]."</a>";
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
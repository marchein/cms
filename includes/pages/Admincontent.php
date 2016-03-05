<?php
$username = $_SESSION["username"];
$rechte = getRechte($username);

echo "<h1>Interner Bereich</h1>\n";

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
    if(getLoginsend() == 0) {
        echo '<form method="POST">
        <input type="hidden" size="24" maxlength="50" name="id" value="0">
        <input type="hidden" size="24" maxlength="50" name="log_in" value="1">
        Dein User-Name:<br />
        <input type="text" size="24" maxlength="50" name="login" value="">     <br />
        Dein Passwort:<br />
        <input type="password" size="24" maxlength="50" name="pw" value="">     <br />
        <br />
        <input type="submit" value="Anmelden">
        </form>
        <br /><br />
        <a href="?id=0&amp;sp=lost">Passwort vergessen?</a> || <a href="?id=0
        &amp;sp=register">Registrieren</a>';
    }

    if(getLoginsend() == 1) {
        echo'Erfolgreich angemeldet! Klicke <a href="?id=0">hier</a> um fortzufahren.';
    }
    if(getLoginsend() == 2) {
        echo'Falscher Benutzername und/oder falsches Passwort! Klicke <a href="?page=Login">hier</a> um\'s erneut zu versuchen.';
    }
    if(getLoginsend() == 3) {
        echo'Erfolgreich abgemeldet! Klicke <a href="?page=Home">hier</a> um fortzufahren.';
    }
}
}
?>
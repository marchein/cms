<?php
$panelname = "Config";
$panelnames[$panelname] = $GLOBALS['lang']['config'];
if(!isset($isinclude)) { $isinclude = true; }
if($isinclude) {
    if (isset($_POST["action"]) && $_POST["action"] == "write") {
        $name = htmlspecialchars($_POST["name"]);
        $mail = $mysqli->real_escape_string($_POST["mail"]);
        $debugging = htmlspecialchars($_POST["debug"]);
        $version = htmlspecialchars($_POST["version"]);
        $query = "UPDATE `config` SET `name` = '" . $name . "', `mail` = '" . $mail . "', `debug` = " . $debugging . " WHERE `ID` = '1'";
        $mysqli->query($query);
        setVersion($version);
        echo '<br />Seiten Daten ge&auml;ndert';
    } else {
        $query = "SELECT * FROM `config` WHERE `id` = 1";
        $result = $mysqli->query($query);
        $ergebnis = mysqli_fetch_object($result);
        echo "<form method='post' action='?id=0&ap=Config'>
        <input type='hidden' name='action' value='write'>
        Name<br />
        <input name='name' size='30' value='" . ($ergebnis->name) . "'> <br />
        Admin E-Mail<br />
        <input name='mail' size='30' value='" . $ergebnis->mail . "'> <br />
        CMS Version:<br />
        <input name='version' size='30' value='" . $ergebnis->version . "'> <br />
        Debug:<br /><select name='debug'>";
        if ($ergebnis->debug) {
            echo '<option value="true" selected>Aktiviert</option>';
        } else {
            echo '<option value="true">Aktivieren?</option>';
        }
        if (!$ergebnis->debug) {
            echo '<option value="false" selected>Deaktiviert</option>';
        } else {
            echo '<option value="false">Deaktivieren?</option>';
        }
        echo "</select>";

        echo"<br /><br /><input type='submit' value='Absenden'>";
    }
}
?>

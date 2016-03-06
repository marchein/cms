<?php
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
        </form>';
    }
?>
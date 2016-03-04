<?php
echo "<form method='post' name='form2' action='?page=Login&sp=lost'>
			  <input type='hidden' name='action' value='write'>
			  Name<br /><input required type='text' name='name' size='40' placeholder='Dein Username'><br />
			  E-Mail Adresse<br /><input required type='email' name='email' size='40' placeholder='z.B. info@xan-mania.de'><br />
			  <input type='submit' value='Neues Passwort senden'>";

if ($_POST["action"] == "write") {
        $characters = array(
"A","B","C","D","E","F","G","H","J","K","L","M",
"N","P","Q","R","S","T","U","V","W","X","Y","Z",
"1","2","3","4","5","6","7","8","9");

//make an "empty container" or array for our keys
$keys = array();

//first count of $keys is empty so "1", remaining count is 1-6 = total 7 times
while(count($keys) < 7) {
    //"0" because we use this to FIND ARRAY KEYS which has a 0 value
    //"-1" because were only concerned of number of keys which is 32 not 33
    //count($characters) = 33
    $x = mt_rand(0, count($characters)-1);
    if(!in_array($x, $keys)) {
       $keys[] = $x;
    }
}

foreach($keys as $key){
   $random_chars .= $characters[$key];
}

    $pw     = md5($random_chars);
    $name =  $_POST["name"];
            $sql      = "SELECT * FROM `user` WHERE `Name` = '".$name."' AND `Email` = '".$_POST["email"]."'";
            $result   = $mysqli_connect->query( $connect, $sql);
            $ergebnis = mysqli_fetch_array($result);
    if ($ergebnis["Name"] !== $name and $ergebnis["Email"] !==  $_POST["email"]) {
      echo"<br />Falsche Angaben!";
    } else {
        $updatesql = "UPDATE `user` SET `Passwort` = '" . $pw . "' WHERE `Name` = '".$name."' AND `Email` = '".$_POST["email"]."'";
        $mysqli_connect->query($updatesql);
        $empfaenger = $_POST["email"];
        $absendername = "Xan Mania";
        $absendermail = "info@xan-mania.de";
        $betreff = "Neues Passwort für Xan Mania";
        $name2   = explode(".", $_POST["name"]);
        $text = "<html>
        <head>
        <title>".$betreff."</title>
        </head>
        <body>Hallo " . $ergebnis["Name"] . "!<br />
        Dein Passwort wurde geändert.<br />
        Bitte logge dich <a href='http://xan-mania.de/?page=Login'>hier</a> ein und ändere unter „Passwort &auml;ndern“ dein Passwort.<br />
        Die Zugangsdaten sind:<br />
        User-Name: ".$ergebnis["Name"]."<br />
        Passwort: $random_chars<br />
        Mit freundlichen Grüßen<br />
        Marc Hein<br />
        Web-Administration</body>
        </html>";
        $header  = "MIME-Version: 1.0\r\n";
$header .= "Content-type: text/html; charset=utf-8\r\n";

$header .= "From: ".$absendermail."\r\n";
$header .= "Reply-To: ".$absendermail."\r\n";
// $header .= "Cc: $cc\r\n";  // falls an CC gesendet werden soll
$header .= "X-Mailer: PHP ". phpversion();
mail($empfaenger, $betreff, $text, $header);
    echo '<br />Neues Passwort wurde an '.$_POST["email"].' gesendet!';
    }

}
?>
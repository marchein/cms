<?php
echo "<form method='post' name='form2' action='?page=Login&sp=register'>
			  <input type='hidden' name='action' value='write'>
			  Name<br /><input required type='text' name='name' size='40' placeholder='Dein späterer Username' value='$_POST[name]'><br />
			  E-Mail Adresse<br /><input required type='email' name='email' size='40' placeholder='z.B. info@xan-mania.de' value='$email'><br />
			  <input type='submit' value='Registrierung anfordern'>";

if ($_POST["action"] == "write") {
	$name =  htmlspecialchars($_POST["name"]);
	$email = $_POST["email"];
	$sql      = "SELECT * FROM `user`";
	$result   = $mysqli_connect->query( $connect, $sql);
	$ergebnis = mysqli_fetch_array($result);
	$sql2      = "SELECT * FROM `register`";
	$result2   = $mysqli_connect->query( $connect, $sql2);
	$ergebnis2 = mysqli_fetch_array($result2);
	if(trim($email)=='')
	{$errors[] = "Bitte geben Sie Ihre E-Mail-Adresse ein.";}
	elseif(!preg_match('/^(?:[\w\!\#\$\%\&\'\*\+\-\/\=\?\^\`\{\|\}\~]+\.)*[\w\!\#\$\%\&\'\*\+\-\/\=\?\^\`\{\|\}\~]+@(?:(?:(?:[a-zA-Z0-9_](?:[a-zA-Z0-9_\-](?!\.)){0,61}[a-zA-Z0-9_-]?\.)+[a-zA-Z0-9_](?:[a-zA-Z0-9_\-](?!$)){0,61}[a-zA-Z0-9_]?)|(?:\[(?:(?:[01]?\d{1,2}|2[0-4]\d|25[0-5])\.){3}(?:[01]?\d{1,2}|2[0-4]\d|25[0-5])\]))$/', trim($email)))
	{$errors[] = "Ihre E-Mail Adresse hat eine falsche Syntax.";}
	elseif ($name == $ergebnis["Name"] or $email == $ergebnis["Email"]) {
		$errors[] = 'Der Account „'.$name.'“ ist bereits vorhanden. Hast du vielleicht dein <a href="?page=Login&sp=lost">Passwort vergessen?</a>';
	}
	elseif ($name == $ergebnis2["Name"] or $email == $ergebnis2["Email"])
	{ $errors[] = 'Es wurde bereits eine Anfrage für <b>'.$ergebnis2['Name'].'</b> am '.date("d.m.Y",$ergebnis2['Datum']).' erstellt.'; }
	if(count($errors)){
             echo "<br />Ihr Account konnte nicht erstellt werden.<br>\n".
                  "<br>\n";
             foreach($errors as $error)
                 echo $error."<br>\n";
        }
	else
	{


		$empfaenger = "info@xan-mania.de";
		$absendername = "Xan Mania";
		$absendermail = "register@xan-mania.de";
		$betreff = "Registrierunganfrage von " . $_POST["name"] . "";
		$text = "<html>
        <head>
        <title>".$betreff."</title>
        </head>
        <body>Der User " . $_POST["name"] . " möchte einen Account mit den folgenden Login-Daten:<br /><br />
        E-Mail Adresse: $email<br />
        Name: $name<br /><br />
        Mit freundlichen Grüßen<br />
        Marc Hein<br />
        Web-Administration</body>
        </html>";
		$header  = "MIME-Version: 1.0\r\n";
		$header .= "Content-type: text/html; charset=utf-8\r\n";

		$header .= "From: $absendermail\r\n";
		$header .= "Reply-To: $email\r\n";
		// $header .= "Cc: $cc\r\n";  // falls an CC gesendet werden soll
		$header .= "X-Mailer: PHP ". phpversion();
		mail($empfaenger, $betreff, $text, $header);

		$empfaenger = $_POST["email"];
		$absendername = "Xan Mania";
		$absendermail = "info@xan-mania.de";
		$betreff = "Registrierunganfrage bei Xan Mania";
		$text = "<html>
        <head>
        <title>".$betreff."</title>
        </head>
        <body>Hallo " . $_POST["name"] . ",<br />
        dein Antrag für einen Account mit den folgenden Login-Daten:<br /><br />
        E-Mail Adresse: $email<br />
        Name: $name<br /><br />
        wird derzeit bearbeitet.<br /><br />
        Mit freundlichen Grüßen<br />
        Marc Hein<br />
        Web-Administration</body>
        </html>";
		$header  = "MIME-Version: 1.0\r\n";
		$header .= "Content-type: text/html; charset=utf-8\r\n";

		$header .= "From: $absendermail\r\n";
		$header .= "Reply-To: $absendermail\r\n";
		// $header .= "Cc: $cc\r\n";  // falls an CC gesendet werden soll
		$header .= "X-Mailer: PHP ". phpversion();
		mail($empfaenger, $betreff, $text, $header);
		$sql      = "INSERT INTO `register` (Name, Email, Datum) values('" . $name . "', '" . $email . "', '" . time() . "')";
		$result   = $mysqli_connect->query( $connect, $sql);
		echo '<br />Deine Anfrage wurde gesendet!';
	}
}
?>
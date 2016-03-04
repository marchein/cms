<?php
$panelnames["Pages"] = "Seiten Verwaltung";
if(!isset($isinclude)) { $isinclude = true; }
if($isinclude) {
    if (isset ($_GET["neu"])) {
    	if ($rechte == "1") {
    		if (@ $_POST["action"] == "write") {
    			$titel = $_POST['titel'];
    			$titel = htmlspecialchars($titel);
    			$autor = $_POST['user'];
    			$content = $_POST['pagecontent'];
    			$content = htmlspecialchars($content);
    			$query = "SELECT MAX(position) FROM `pages` WHERE `position` >= 0 AND `position` < 99";
    			$result = $mysqli_connect->query($query);
    			$position = mysqli_fetch_array($result);
    			$position = $position['MAX(position)'];
    			$pageincludes = mysqli_real_escape_string($mysqli_connect, $_POST['include']);
    			if (!$pageincludes) {
    				$pageincludes = "false";
    			}
    			$query = "INSERT INTO `pages` (name, content,position,include) values('" . $titel . "','" . $content . "', '" . ($position + 1) . "', '" . $pageincludes . "')";
    			$mysqli_connect->query($query);
    			echo 'Seite erfolgreich angelegt<br />Klicke <a href="?id=0&amp;ap=Pages">hier</a> um fortzufahren.';
    		} else {
    			echo "<form method='post' name='form2' action='?id=0&ap=Pages&neu=true'>
                <input type='hidden' name='id' value='0'>
                <input type='hidden' name='ap' value='Pages'>
                <input type='hidden' name='action' value='write'>
                Username:<br />
                <input name='user' size='20' value='" . $username . "' readonly>
                <br />
                Titel:<br /><input name='titel' size='20'><br />
                Seite aus /includes/: <input type='checkbox' name='include' value='true'> (Wenn dieses Feld ausgewählt wurde, muss die Datei im /includes/pages/ mit dem Dateinamen \"&#60;Seitentitel&#62;content.php\" liegen. Außerdem wird der Inhalt im Feld \"Seiteninhalt\" ignoriert.<br />
                Seiteninhalt:<br />
                <textarea name='pagecontent' cols='70' rows='35'></textarea> <br />
                <input type='submit' value='Absenden'>";
    		}
    	} else {
    	    echo "Nicht ausreichende Rechte!";
    	}
    } else if (isset ($_GET["delete"])) {
    	if ($rechte == "1") {
    	    if(!isset($_GET["page"])) {
                $query = "SELECT * FROM `pages` WHERE `position` >= 0 AND `position` < 99 ORDER BY `id` ASC";
        		$result = $mysqli_connect->query($query);
                // if($debug) { var_dump($result); }
        		while ($row = mysqli_fetch_object($result)) {
        		    // if($debug) { var_dump($row); }
        			$titel = $row->name;
                    $id = $row->id;
        			echo "<a href='?id=0&amp;ap=Pages&amp;delete=true&amp;page=".$id."'>".$titel."</a><br />\n";
        		}
            } else {
                $pageid = $mysqli_connect->real_escape_string($_GET["page"]);

                $query = "SELECT * FROM `pages` WHERE `id` = ".$pageid;
        		$result = $mysqli_connect->query($query);
                $row = mysqli_fetch_object($result);

                echo "ID der Seite: ". $row->id ." <br /> \n
                Name: " . $row->name . "<br /> \n
                Erstellungsdatum: " . $row->date_created . "<br /> \n
                Seite aus /includes/?: " . $row->include . "<br /> \n";

                echo "<a href='?id=0&ap=Pages&pageid=".$pageid."&action=delete'>L&ouml;schen</a>";

            }
    	} else {
    	    echo "Nicht ausreichende Rechte!";
    	}
    } elseif (isset ($_GET["reihenfolge"]) && $_GET["reihenfolge"]) {
    	echo "Reihenfolge<br />";
    	if (!isset ($_POST['update'])) {
    		$query = "SELECT * FROM `pages` WHERE `position` >= 0 AND `position` < 99 ORDER BY `id` ASC";
    		$result = $mysqli_connect->query($query);
            // if($debug) { var_dump($result); }
    		echo "<form method='post'>
            <input type='hidden' name='id' value='0'>
            <input type='hidden' name='ap' value='Pages'>
            <input type='hidden' name='reihenfolge' value='true'>
            <input type='hidden' name='update' value='true'>\n";
    		$i = 1;
    		while ($row = mysqli_fetch_object($result)) {
    		    // if($debug) { var_dump($row); }
    			$titel = $row->name;
    			$position = $row->position;
    			echo "" . $titel . ": <input name='position[" . $i . "]' value='" . $position . "' size='3'><br />\n";
    			$i++;
    		}
    		echo "<input type='submit' value='Absenden'>";
    	} else {
    		$query = "SELECT * FROM `pages` WHERE `position` >= 0 AND `position` < 99";
    		$result = $mysqli_connect->query($query);
    		$i = 1;
    		while ($row = mysqli_fetch_object($result)) {
    			$id = $row->id;
    			$position = $row->position;
                $pageposition = mysqli_real_escape_string($mysqli_connect, $_POST['position'][$i]) ;
    			if ($pageposition < 99 && $pageposition > 0 && $id != 0) {
    				$updatesql = "UPDATE `pages` SET `position` = '" . $pageposition . "' WHERE `id` = " . $id . "";
    				$mysqli_connect->query($updatesql);
    			} else {
    				var_dump($pageposition);
    				echo "<br />" . $id;
    				echo "<br />Fehler: Position muss zwischen 1-98 liegen!";
    			}
    			$i++;
    		}
    		echo '<br />Reihenfolge erfolgreich bearbeitet!
            Klicke <a href="?id=0&ap=Pages">hier</a> um fortzufahren.';
    	}
    } else {
    	if (isset ($_GET['pageid'])) {
    		$pageid = mysqli_real_escape_string($mysqli_connect, $_GET['pageid']);
    		$query = "SELECT * FROM pages WHERE `position` >= 0 AND `position` < 99 AND `id` = " . $pageid;
    		$result = $mysqli_connect->query($query);
    		if (mysqli_num_rows($result) == 0) {
    			echo "Fehler!";
    		} else {
    			$row = mysqli_fetch_object($result);
                if($debug) { var_dump($row); }
    			if (@$_POST["action"] == "update") {
    				$pagecontent = mysqli_real_escape_string($mysqli_connect, $_POST['pagecontent']);
    				$pagetitle = mysqli_real_escape_string($mysqli_connect, $_POST['titel']);
    				@$pageincludes = mysqli_real_escape_string($mysqli_connect, $_POST['include']);
    				if (!$pageincludes) {
    					$pageincludes = "false";
    				}
    				$updatesql = "UPDATE `pages` SET `content` = '" . $pagecontent . "', `name` = '" . $pagetitle . "', `include` = '" . $pageincludes . "' WHERE `ID` = " . $pageid . ";";
    				$mysqli_connect->query($updatesql);
                    if($debug) { var_dump($updatesql); }
    				echo 'Seite erfolgreich bearbeitet! Klicke <a href="?id=0&ap=Pages">hier</a> um fortzufahren.';
    			} elseif(@$_GET["action"] == "delete") {
                    $updatesql = "delete from `pages` WHERE `ID` = " . $pageid . " limit 1;";
    				$mysqli_connect->query($updatesql);
    				echo 'Seite erfolgreich gelöscht! Klicke <a href="?id=0&ap=Pages">hier</a> um fortzufahren.';

                } else {
                    echo "<form method='post' name='form2' action='?id=0&ap=Pages&pageid=" . $pageid . "'>
                    <input type='hidden' name='id' value='0'>
                    <input type='hidden' name='ap' value='Pages'>
                    <input type='hidden' name='pageid' value='" . $pageid . "'>
                    <input type='hidden' name='action' value='update'>
                    Titel:<br /><input name='titel' value='" . $row->name . "' size='20'><br />
                    Seite aus /includes/: <input type='checkbox' name='include' value='true'";
                    if ($row->include == "true") {
                        echo " checked";
                    }
                    echo "><br />
                    Seiteninhalt:<br />
                    <textarea name='pagecontent' cols='60' rows='25'>" . $row->content . "</textarea> <br />
                    <input type='submit' value='Absenden'>";
                }
    		}
    	} else {
    		if ($rechte == "1") {
    			echo '<a href="?id=0&ap=Pages&neu=true">Neue Seite erstellen</a><br />';
                echo '<a href="?id=0&ap=Pages&delete=true">Bestehende Seite löschen</a><br />';
    			echo '<a href="?id=0&ap=Pages&reihenfolge=true">Reihenfolge der Seiten ändern</a>';
    		}
    		$query = "SELECT * FROM `pages`";
    		$num_res = $mysqli_connect->query($query);
    		$numrows = mysqli_num_rows($num_res);
    		$query = "SELECT id, name, date_created FROM `pages` WHERE `position` >= 0 AND `position` < 99 ORDER BY `id` DESC";
    		$result = $mysqli_connect->query($query);
    		$i = 0;
    		while ($row = mysqli_fetch_object($result)) {
    			$titel = $row->name;
    			$datum = mysqlDate($row->date_created);
    			echo "<h2 class='title'><a href='?id=0&ap=Pages&pageid=" . $row->id . "'>" . $titel . "</a> on " . $datum . "</h2>";
    			$i++;
    		}
    	}
    }
}
?>
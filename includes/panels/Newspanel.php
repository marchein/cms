﻿<?php
$panelname = "News";
$panelnames[$panelname] = $GLOBALS['lang']['news'];
if(!isset($isinclude)) { $isinclude = true; }
if($isinclude) {
    if (isset($_GET["neu"])) {
    	if ($userrights == "1") {
    		if (@ $_POST["action"] == "write") {
    			$titel = htmlspecialchars($_POST['titel']);
    			$content = htmlspecialchars($_POST['newscontent']);
    			$query = "INSERT INTO `news` (`id`, `date_created`, `author`, `title`, `content`) VALUES(NULL, CURRENT_TIMESTAMP, '" . $username . "', '" . $titel . "','" . $content . "');";
                if($debug) { echo $query; }
                $mysqli->query($query);
    			echo 'News erfolgreich angelegt<br />Klicke <a href="?id=0&amp;ap=News">hier</a> um fortzufahren.';
    		} else {
    			echo "<form method='post' action='?id=0&amp;ap=News&amp;neu=true'>
                <input type='hidden' name='action' value='write'>
                Titel:<br /><input name='titel' size='20'><br />
                Newsinhalt:<br />
                <textarea name='newscontent' cols='70' rows='35'></textarea> <br />
                <input type='submit' value='Absenden'>
                </form>";
    		}
    	}
    } else {
    	if (isset ($_GET['newsid'])) {
    		$newsid = $mysqli->real_escape_string($_GET['newsid']);
    		$query = "SELECT * FROM news WHERE `id` = " . $newsid;
    		$result = $mysqli->query($query);
    		if (mysqli_num_rows($result) == 0) {
    			echo "Fehler!";
    		} else {
    			$row = mysqli_fetch_object($result);
                if($debug) { var_dump($row); }
    			if (@$_POST["action"] == "update") {
    				$newstext = $mysqli->real_escape_string($_POST['content']);
    				$newstitle = $mysqli->real_escape_string($_POST['titel']);
    				$newsid = $mysqli->real_escape_string($_GET['newsid']);
    				$updatesql = "UPDATE `news` SET `title` = '" . $newstitle . "', `content` = '" . $newstext . "' WHERE `id` = " . $newsid . ";";
    				$mysqli->query($updatesql);
                    if($debug) { var_dump($updatesql); }
    				echo 'News erfolgreich bearbeitet! Klicke <a href="?id=0&amp;ap=News">hier</a> um fortzufahren.';
    			} elseif(@$_POST["action"] == "delete") {
                    $updatesql = "delete from `news` WHERE `ID` = " . $newsid . " limit 1;";
    				$mysqli->query($updatesql);
    				echo 'News erfolgreich gelöscht! Klicke <a href="?id=0&amp;ap=News">hier</a> um fortzufahren.';

                } else {
                    echo "<form method='post' action='?id=0&amp;ap=News&amp;newsid=" . $newsid . "'>
                    <input type='hidden' name='action' value='update'>
                    Titel:<br /><input name='titel' value='" . $row->title . "' size='20'><br />
                    Newsinhalt:<br />
                    <textarea name='content' cols='60' rows='25'>" . $row->content . "</textarea> <br />
                    <input type='submit' value='Absenden'>
                    </form>";
                }
    		}
    	} else {
    		if ($userrights == "1") {
    			echo '<a href="?id=0&amp;ap=News&amp;neu=true">Neue News erstellen</a><br />';
    		}
    		$query = "SELECT * FROM `pages`";
    		$num_res = $mysqli->query($query);
    		$numrows = mysqli_num_rows($num_res);
    		$query = "SELECT id, title, date_created FROM `news` ORDER BY `id` DESC";
    		$result = $mysqli->query($query);
    		$i = 0;
    		while ($row = mysqli_fetch_object($result)) {
    			$titel = $row->title;
    			$datum = mysqlDate($row->date_created);
    			echo "<h2 class='title'><a href='?id=0&amp;ap=News&amp;newsid=" . $row->id . "'>" . $titel . "</a> on " . $datum . "</h2>";
    			$i++;
    		}
    	}
    }
}
?>
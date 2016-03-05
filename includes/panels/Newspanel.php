<?php
$panelnames["News"] = "News";
if(!isset($isinclude)) { $isinclude = true; }
if($isinclude) {
    if (isset($_GET["neu"])) {
    	if ($rechte == "1") {
    		if (@ $_POST["action"] == "write") {
    			$titel = $_POST['titel'];
    			$titel = htmlspecialchars($titel);
    			$autor = $_POST['user'];
    			$content = $_POST['newscontent'];
    			$content = htmlspecialchars($content);
    			$query = "INSERT INTO `news` (author, title, content) values('" . $autor . "', '" . $titel . "','" . $content . "');";
                if($debug) { echo $query; }
                $mysqli_connect->query($query);
    			echo 'News erfolgreich angelegt<br />Klicke <a href="?id=0&amp;ap=News">hier</a> um fortzufahren.';
    		} else {
    			echo "<form method='post' name='form2' action='?id=0&amp;ap=News&amp;neu=true'>
                <input type='hidden' name='id' value='0'>
                <input type='hidden' name='ap' value='News'>
                <input type='hidden' name='action' value='write'>
                Username:<br />
                <input name='user' size='20' value='" . $username . "' readonly>
                <br />
                Titel:<br /><input name='titel' size='20'><br />
                Newsinhalt:<br />
                <textarea name='newscontent' cols='70' rows='35'></textarea> <br />
                <input type='submit' value='Absenden'>";
    		}
    	}
    } else {
    	if (isset ($_GET['newsid'])) {
    		$newsid = mysqli_real_escape_string($mysqli_connect, $_GET['newsid']);
    		$query = "SELECT * FROM news WHERE `id` = " . $newsid;
    		$result = $mysqli_connect->query($query);
    		if (mysqli_num_rows($result) == 0) {
    			echo "Fehler!";
    		} else {
    			$row = mysqli_fetch_object($result);
                if($debug) { var_dump($row); }
    			if (@$_POST["action"] == "update") {
    				$newscontent = mysqli_real_escape_string($mysqli_connect, $_POST['newscontent']);
    				$newstitle = mysqli_real_escape_string($mysqli_connect, $_POST['titel']);
    				$newsid = mysqli_real_escape_string($mysqli_connect, $_GET['newsid']);
    				$updatesql = "UPDATE `news` SET `title` = '" . $newstitle . "', `content` = '" . $newscontent . "' WHERE `id` = " . $newsid . ";";
    				$mysqli_connect->query($updatesql);
                    if($debug) { var_dump($updatesql); }
    				echo 'News erfolgreich bearbeitet! Klicke <a href="?id=0&amp;ap=News">hier</a> um fortzufahren.';
    			} elseif(@$_POST["action"] == "delete") {
                    $updatesql = "delete from `news` WHERE `ID` = " . $newsid . " limit 1;";
    				$mysqli_connect->query($updatesql);
    				echo 'News erfolgreich gelöscht! Klicke <a href="?id=0&amp;ap=News">hier</a> um fortzufahren.';

                } else {
                    echo "<form method='post' name='form2' action='?id=0&amp;ap=News&amp;newsid=" . $newsid . "'>
                    <input type='hidden' name='id' value='0'>
                    <input type='hidden' name='ap' value='News'>
                    <input type='hidden' name='newsid' value='" . $newsid . "'>
                    <input type='hidden' name='action' value='update'>
                    Titel:<br /><input name='titel' value='" . $row->title . "' size='20'><br />
                    Newsinhalt:<br />
                    <textarea name='newscontent' cols='60' rows='25'>" . $row->content . "</textarea> <br />
                    <input type='submit' value='Absenden'>";
                }
    		}
    	} else {
    		if ($rechte == "1") {
    			echo '<a href="?id=0&amp;ap=News&amp;neu=true">Neue News erstellen</a><br />';
    		}
    		$query = "SELECT * FROM `pages`";
    		$num_res = $mysqli_connect->query($query);
    		$numrows = mysqli_num_rows($num_res);
    		$query = "SELECT id, title, date_created FROM `news` ORDER BY `id` DESC";
    		$result = $mysqli_connect->query($query);
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
<?php
$panelname = "Pages";
$panelnames[$panelname] = $GLOBALS['lang']['pages'];
if(!isset($isinclude)) { $isinclude = true; }
if($isinclude) {
    if (isset ($_GET["neu"])) {
    	if ($rechte == "1") {
    		if (@ $_POST["action"] == "write") {
    			$title = $_POST['titel'];
    			$title = htmlspecialchars($title);
    			$content = $_POST['pagecontent'];
    			$content = htmlspecialchars($content);
    			$query = "SELECT MAX(position) FROM `pages` WHERE `position` >= 0 AND `position` < 99";
    			$result = $mysqli->query($query);
    			$position = mysqli_fetch_array($result);
    			$position = $position['MAX(position)'];
    			$pageincludes = mysqli_real_escape_string($mysqli, $_POST['include']);
    			if (!$pageincludes) {
    				$pageincludes = "false";
    			}
    			$query = "INSERT INTO `pages` (name, content,position,included) values('" . $title . "','" . $content . "', '" . ($position + 1) . "', '" . $pageincludes . "')";
    			$mysqli->query($query);
                echo "<br /><br /><br />";
                echo $GLOBALS['lang']['page_created'];
    		} else {
    			echo "<form method='post' name='form2' action='?id=0&ap=Pages&neu=true'>
                <input type='hidden' name='id' value='0'>
                <input type='hidden' name='ap' value='Pages'>
                <input type='hidden' name='action' value='write'>
                ".$GLOBALS["lang"]["page_title"].":<br /><input name='titel' size='20'><br />
                ".$GLOBALS["lang"]["page_include"].": <input type='checkbox' name='include' value='true'> ".$GLOBALS["lang"]["page_include_info"]."<br />
                ".$GLOBALS["lang"]["page_content"].":<br />
                <textarea name='pagecontent' cols='70' rows='35'></textarea> <br />
                <input type='submit' value='".$GLOBALS["lang"]["submit"]."'>";
    		}
    	} else {
    	    echo $GLOBALS["lang"]["not_enough_rights"];
    	}
    } else if (isset ($_GET["delete"])) {
    	if ($rechte == "1") {
    	    if(!isset($_GET["page"])) {
                $query = "SELECT * FROM `pages` WHERE `position` >= 0 AND `position` < 99 ORDER BY `id` ASC";
        		$result = $mysqli->query($query);
        		while ($row = mysqli_fetch_object($result)) {
        			$title = $row->name;
                    $id = $row->id;
        			echo "<a href='?id=0&amp;ap=Pages&amp;delete=true&amp;page=".$id."'>".$title."</a><br />\n";
        		}
            } else {
                $pageid = $mysqli->real_escape_string($_GET["page"]);

                $query = "SELECT * FROM `pages` WHERE `id` = ".$pageid;
        		$result = $mysqli->query($query);
                $row = mysqli_fetch_object($result);

                echo "ID der Seite: ". $row->id ." <br /> \n
                Name: " . $row->name . "<br /> \n
                Erstellungsdatum: " . $row->date_created . "<br /> \n
                ".$GLOBALS["lang"]["page_include"].": " . $row->include . "<br /> \n";

                echo "<a href='?id=0&ap=Pages&pageid=".$pageid."&action=delete'>L&ouml;schen</a>";

            }
    	} else {
    	    echo $GLOBALS["lang"]["not_enough_rights"];
    	}
    } elseif (isset ($_GET["reihenfolge"]) && $_GET["reihenfolge"]) {
    	echo "Reihenfolge<br />";
    	if (!isset ($_POST['update'])) {
    		$query = "SELECT * FROM `pages` WHERE `position` >= 0 AND `position` < 99 ORDER BY `id` ASC";
    		$result = $mysqli->query($query);
            // if($debug) { var_dump($result); }
    		echo "<form method='post'>
            <input type='hidden' name='id' value='0'>
            <input type='hidden' name='ap' value='Pages'>
            <input type='hidden' name='reihenfolge' value='true'>
            <input type='hidden' name='update' value='true'>\n";
    		$i = 1;
    		while ($row = mysqli_fetch_object($result)) {
    		    // if($debug) { var_dump($row); }
    			$title = $row->name;
    			$position = $row->position;
    			echo "" . $title . ": <input name='position[" . $i . "]' value='" . $position . "' size='3'><br />\n";
    			$i++;
    		}
    		echo "<input type='submit' value='".$GLOBALS["lang"]["submit"]."'>";
    	} else {
    		$query = "SELECT * FROM `pages` WHERE `position` >= 0 AND `position` < 99";
    		$result = $mysqli->query($query);
    		$i = 1;
    		while ($row = mysqli_fetch_object($result)) {
    			$id = $row->id;
    			$position = $row->position;
                $pageposition = mysqli_real_escape_string($mysqli, $_POST['position'][$i]) ;
    			if ($pageposition < 99 && $pageposition > 0 && $id != 0) {
    				$updatesql = "UPDATE `pages` SET `position` = '" . $pageposition . "' WHERE `id` = " . $id . "";
    				$mysqli->query($updatesql);
                    $message = "Reihenfolge erfolgreich bearbeitet!";
    			} else {
    				$message = "Fehler: Position muss zwischen 1-98 liegen!";
    			}
    			$i++;
    		}
    		echo '<br />'.$message.'<br />
            Klicke <a href="?id=0&ap=Pages">hier</a> um fortzufahren.';
    	}
    } else {
    	if (isset ($_GET['pageid'])) {
    		$pageid = mysqli_real_escape_string($mysqli, $_GET['pageid']);
    		$query = "SELECT * FROM pages WHERE `position` >= 0 AND `position` < 99 AND `id` = " . $pageid;
    		$result = $mysqli->query($query);
    		if (mysqli_num_rows($result) == 0) {
    			echo "Fehler!";
    		} else {
    			$row = mysqli_fetch_object($result);
                if($debug) { var_dump($row); }
    			if (@$_POST["action"] == "update") {
    				$pagecontent = $mysqli->real_escape_string($_POST['pagecontent']);
    				$pagetitle = $mysqli->real_escape_string($_POST['titel']);
                    if(!isset($_POST['include'])) {
                        $pageincludes = 0;
                    } else {
    				    @$pageincludes = $mysqli->real_escape_string($_POST['include']);
                    }
                    $updatesql = "UPDATE `pages` SET `content` = '" . $pagecontent . "', `name` = '" . $pagetitle . "', `included` = '" . $pageincludes . "' WHERE `ID` = " . $pageid . ";";
                    $mysqli->query($updatesql);
                    if($debug) { var_dump($updatesql); }
    				echo 'Seite erfolgreich bearbeitet! Klicke <a href="?id=0&ap=Pages">hier</a> um fortzufahren.';
    			} elseif(@$_GET["action"] == "delete") {
                    $updatesql = "delete from `pages` WHERE `ID` = " . $pageid . " limit 1;";
    				$mysqli->query($updatesql);
    				echo 'Seite erfolgreich gelöscht! Klicke <a href="?id=0&ap=Pages">hier</a> um fortzufahren.';

                } else {
                    echo "<form method='post' name='form2' action='?id=0&ap=Pages&pageid=" . $pageid . "'>
                    <input type='hidden' name='id' value='0'>
                    <input type='hidden' name='ap' value='Pages'>
                    <input type='hidden' name='pageid' value='" . $pageid . "'>
                    <input type='hidden' name='action' value='update'>
                    ".$GLOBALS["lang"]["page_title"].":<br /><input name='titel' value='" . $row->name . "' size='20'><br />
                    ".$GLOBALS["lang"]["page_include"].": <input type='checkbox' name='include' value='1'";
                    if ($row->included == "1") {
                        echo " checked";
                    }
                    echo "><br />
                    ".$GLOBALS["lang"]["page_content"].":<br />
                    <textarea name='pagecontent' cols='60' rows='20'>" . $row->content . "</textarea> <br />
                    <input type='submit' value='".$GLOBALS["lang"]["submit"]."'>";
                }
    		}
    	} else {
    		if ($rechte == "1") {
    			echo '<a href="?id=0&ap=Pages&neu=true">'.$GLOBALS['lang']['create_page'].'</a><br />';
                echo '<a href="?id=0&ap=Pages&delete=true">'.$GLOBALS['lang']['delete_page'].'</a><br />';
    			echo '<a href="?id=0&ap=Pages&reihenfolge=true">'.$GLOBALS['lang']['order_page'].'</a>';
    		}
    		$query = "SELECT * FROM `pages`";
    		$num_res = $mysqli->query($query);
    		$numrows = mysqli_num_rows($num_res);
    		$query = "SELECT id, name, date_created FROM `pages` WHERE `position` >= 0 AND `position` < 99 ORDER BY `id` DESC";
    		$result = $mysqli->query($query);
    		$i = 0;
    		while ($row = mysqli_fetch_object($result)) {
    			$title = $row->name;
    			$date = mysqlDate($row->date_created);
    			echo "<h2 class='title'><a href='?id=0&ap=Pages&pageid=" . $row->id . "'>" . $title . "</a> ".$GLOBALS["lang"]["date"]." " . $date . "</h2>";
    			$i++;
    		}
    	}
    }
}
?>
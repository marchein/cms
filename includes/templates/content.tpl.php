<?php
	$mysqli_connect = $GLOBALS["mysqli_connect"];
	$is_login = $GLOBALS["is_login"];
	$debug = getDebug();
	@ $id = mysqli_real_escape_string($mysqli_connect, $_GET["id"]);
	if ($id == "") {
		$id = 1;
	}
	$query = "SELECT id, name, included FROM pages WHERE `id` = '" . $id . "' LIMIT 0, 1";
	$result = $mysqli_connect->query($query);
	if (mysqli_num_rows($result) == 0) {
		$error = "page";
		include ("includes/internal/error.php");
	}
	else {
		if ($debug) {
			$query = "SELECT name FROM pages WHERE `id` = '" . $id . "'";
			$name_result = $mysqli_connect->query($query);
			$page = mysqli_fetch_object($name_result);
			$page = $page->name;
		}
		while ($row = mysqli_fetch_object($result)) {
			if ($debug) {
				echo "<br /><b>";
				var_dump($row);
				echo "</b>";
			}
			@ $inc = $row->included;
			if ($inc == 1) {
				$incl = true;
			}
			if ($inc == 0) {
				$incl = false;
			}
			if ($incl) {
				$file = "includes/pages/" . $row->name . "content.php";
				if (file_exists($file)) {
					include ($file);
				}
				else {
					$error = "file";
					include ("includes/internal/error.php");
				}
			}
			else {
				include ("includes/internal/templates/page.tpl.php");
			}
			break;
		}
	}
?>
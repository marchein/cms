<?php
function document() {
  return $_SERVER["DOCUMENT_ROOT"] . "/";
}

function url() {
  $url = str_replace("/index.php", "", $_SERVER["PHP_SELF"]);
  return "http://" . $_SERVER["HTTP_HOST"] . $url . "";
}

function getLoginsend() {
      return $GLOBALS["loginsend"];
}

function mysqlDate($date) {
  $mysqldate = strtotime($date);
  $phpdate = date('d.m.Y', $mysqldate);
  return $phpdate;
}

function getDebug() {
  $query = "SELECT * FROM `config` WHERE `id` = 1";
  $result = $GLOBALS["mysqli_connect"]->query($query);
  $config = mysqli_fetch_object($result);
  return $config->debug;
}

function getVersion() {
  $query = "SELECT * FROM `config` WHERE `id` = 1";
  $result = $GLOBALS["mysqli_connect"]->query($query);
  $config = mysqli_fetch_object($result);
  $version = $config->version;
  return $version;
}

function getVersionName() {
  $parts = explode(".", getVersion());
  if (!$parts[0] == 0) {
    $versionname = "Public";
  } else {
    if (!$parts[1] == 0) {
      $versionname = "Beta";
    } else {
      $versionname = "Alpha";
    }
  }
  return $versionname;
}

function setVersion($version) {
  $query = "UPDATE `config` SET `version` = '" . mysqli_real_escape_string($GLOBALS["mysqli_connect"], $version) . "' WHERE `config`.`id` = 1;";
  $result = $GLOBALS["mysqli_connect"]->query($query);
}

function getBuild() {
  $query = "SELECT * FROM `config` WHERE `id` = 1";
  $result = $GLOBALS["mysqli_connect"]->query($query);
  $config = mysqli_fetch_object($result);
  return $config->build;
}

function setBuild() {
  $build = getBuild();
  if ($build == "") {
    $build = 0;
  }
  $build++;
  $query = "UPDATE `config` SET `build` = '" . $build . "' WHERE `config`.`id` = 1;";
  $result = $GLOBALS["mysqli_connect"]->query($query);
}

function showAdmin() {
  $query = "SELECT * FROM `config` WHERE `id` = 1";
  $result = $GLOBALS["mysqli_connect"]->query($query);
  $config = mysqli_fetch_object($result);
  return $config->show_admin;
}

function getPageName() {
	$query = "SELECT * FROM `config` WHERE `id` = 1";
	$result = $GLOBALS["mysqli_connect"]->query($query);
	$config = mysqli_fetch_object($result);
    return $config->name;
}

function getCurrentPageName($id, $newsid) {
    $query = 'SELECT name FROM `pages` WHERE `ID` = ' . (int)$id;
    $result = $GLOBALS["mysqli_connect"]->query($query);
    $row = $result->fetch_object();
    if($id == 2 && isset($newsid)) {
        $query = 'SELECT title FROM `news` WHERE `id` = ' . (int)$newsid;
        $result = $GLOBALS["mysqli_connect"]->query($query);
        $newstitle = $result->fetch_object()->title;
        return $newstitle." - ".$row->name." | " . getPageName();
    } else {
        return $row->name." | " . getPageName();
    }
}

function getRechteName($rechte) {
    if($rechte == 0) { $rechtename = "Gesperrt"; }
    if($rechte == 1) { $rechtename = "Administrator"; }
    if($rechte == 2) { $rechtename = "Moderator"; }
    if($rechte == 3) { $rechtename = "Nutzer"; }
    return $rechtename;
}

if(getDebug()) {
    setBuild();
}

function getPanelNames() {
    $panelnames[] = array(); // initiate array, gets filled by the $panelnames from the unique panels
    $isinclude = false; //
    $dir = "includes/panels"; // link to panels folder
    if (@$handle = opendir($dir)) {
        while (($entry = readdir($handle)) !== false) {
            if ($entry != "." && $entry != "..") {
                include($dir."/".$entry);
            }
        }
    }
    closedir($handle);
    $isinclude = true;
    return $panelnames;
}

$currenttheme = getCurrentTheme();
if($currenttheme == "default") {
    $path = "includes/templates";
} else {
    $path = "includes/themes/".$currenttheme;
}
$GLOBALS["path"] = $path;
if(!isset($_GET["id"]))
    $_GET["id"] = 1;
?>
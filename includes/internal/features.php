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

require_once("internalFeatures.php");
if(getDebug()) {
    setBuild();
}

function getPanelNames() {
    $panelnames[] = array();
    $isinclude = false;
    if ($handle = opendir('includes/panels')) {
        while (false !== ($entry = readdir($handle))) {
            if ($entry != "." && $entry != "..") {
                $panel = str_replace("panel.php","", $entry);
                include("includes/panels/".$entry);
            }
        }
        closedir($handle);
    }
    $isinclude = true;
    return $panelnames;
}
?>
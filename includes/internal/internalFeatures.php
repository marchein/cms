<?php
try {
    if(!((isset($mysql_server) && !empty($mysql_server)) &&
             (isset($mysql_username) && !empty($mysql_username)) &&
             (isset($mysql_password) && !empty($mysql_password)) &&
             (isset($mysql_database) && !empty($mysql_database)) || getDebug() == 1)) {
                 throw new Exception ("MySQL Daten stimmen nicht überein");
    }

    require_once("features.php");
    require_once("userFeatures.php");
} catch (Exception $e) {
    die("<h1>".$GLOBALS["lang"]["mysql_error"].": ". $mysqli->connect_error ."</h1>\n<br/>".$GLOBALS["lang"]["mysql_error_help"]);
}
function getHash($hash){
    return hash('SHA512', $hash."HeinCMS_2016");
}

function getHeaders() {
    if (@$_GET["id"] == "0" && getLoginsend() == 1) {
        header("refresh:2;url=".url()."?id=0");
    }
    elseif (@$_GET["id"] == "0" && getLoginsend() == 2) {
        header("refresh:2;url=".url()."?id=0");
    }
    elseif (@$_GET["id"] == "0" && getLoginsend() == 3) {
        header("refresh:2;url=".url());
    } else {
        header('Content-type: text/html; charset=utf-8');
    }
}

function getLoggedInJS() {
    if(@$_GET['id'] == "0" && $GLOBALS["is_login"]) {
    echo '
    <script src="js/tinymce/tinymce.min.js"></script>
    <script src="js/tinymce/init.js"></script>';
    }
}

function getCurrentTheme() {
    $sql = "SELECT theme FROM config"; // fetch current theme
    return mysqli_fetch_object($GLOBALS["mysqli"]->query($sql))->theme; // return current theme
}

function getNavigation() {
    echo"<navigation>";
      include ($GLOBALS["path"]."/navigation.tpl.php");
    echo "\n</navigation>\n";
}

function getContent() {
  include ($GLOBALS["path"]."/content.tpl.php");
}

function getDebug() {
    $query = "SELECT * FROM `config` WHERE `id` = 1";
    $result = $GLOBALS["mysqli"]->query($query);
    $config = mysqli_fetch_object($result);
    return $config->debug;
}

function getDebugFooter() {
    if (getDebug()) {
    echo "<br /><pre>";
    print_r($_SESSION);
    echo '</pre><br />'.$GLOBALS['lang']['cmsfolder'].' '. url() . '<br />
        '.$GLOBALS['lang']['cmsroot'].' '. document() . '<br />
        '.$GLOBALS['lang']['cmsversion'].' '.getVersion() . ' '.getVersionName() . ' (Build: '.getBuild().')<br />
        <br /> '.$GLOBALS['lang']['cmspage'].' '.$GLOBALS["page"].'';
  }
}

?>
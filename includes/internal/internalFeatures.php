<?php
require_once("features.php");
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
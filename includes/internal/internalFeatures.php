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


function getLoggedIn() {
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

function getLanguage() {
    if(isset($_GET["lang"])) {
        // if ?lang=de for example is set in the url, lang is set to $_GET["lang"]
        $lang = $_GET["lang"];
        // register the session and set the cookie
        $_SESSION["lang"] = $lang;
        setcookie('lang', $lang, time() + (3600 * 24 * 30));
    } else if(isset($_SESSION["lang"])) {
        // set lang to the lang saved in the session
        $lang = $_SESSION["lang"];
    } else if(isset($_COOKIE["lang"])) {
        // set lang to the lang saved in the cookie
        $lang = $_COOKIE["lang"];
    } else if(isset($_SERVER['HTTP_ACCEPT_LANGUAGE'])) {
        // set lang to the system language
        $lang = substr($_SERVER['HTTP_ACCEPT_LANGUAGE'], 0, 2);
        // register the session and set the cookie
        $_SESSION["lang"] = $lang;
        setcookie('lang', $lang, time() + (3600 * 24 * 30));
    } else {
        // if everything else fails, set lang to english
        $lang = "en";
    }

    return $lang;
}

function includeLanguage($lang) {
    switch($lang) {
        // if $lang == de, set lang to german
        case "de":
        $lang_file = "de.lang.php";
        break;
        // if $lang == en or not set, set lang to english
        case "en":
        default:
        $lang_file = "en.lang.php";
        break;
    }
    // include the language file once
    include_once("includes/languages/".$lang_file);
    // return the language array of the lang file
    return $language;
}

$lang = getLanguage();
$GLOBALS["lang"] = includeLanguage($lang);
$language = $GLOBALS["lang"];
?>
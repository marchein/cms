<?php

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

function getLanguageFiles() {
    $result[] = array();
    $dir = "includes/languages";
    if (@$handle = opendir($dir)) {
        $i = 0;
        while (($entry = readdir($handle)) !== false) {
            if ($entry != "." && $entry != "..") {
                preg_match("/\b\w{2}\b/", $entry, $lang);
                $result[$i] = $lang[0];
                $i++;
            }
        }
    }
    closedir($handle);
    return $result;
}

function includeLanguage($lang) {
    if(in_array($lang, getLanguageFiles())) {
        $lang_file = $lang;
    } else {
        $lang_file = "en";
    }
    // include the language file once
    include_once("includes/languages/".$lang_file.".lang.php");
    // return the language array of the lang file
    return $language;
}

$lang = getLanguage();
$GLOBALS["lang"] = includeLanguage($lang);
$language = $GLOBALS["lang"];

?>
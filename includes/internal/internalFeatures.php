<?php

function getHash($hash){
    return hash('SHA512', $hash);
}

function getHeaders() {
    if (@$_GET["id"] == "0" && getLoginsend() == 1) {
        header("refresh:2;url=http://localhost/HeinCMS/?id=0");
    }
    elseif (@$_GET["id"] == "0" && getLoginsend() == 2) {
        header("refresh:2;url=http://localhost/HeinCMS/?id=0");
    }
    elseif (@$_GET["id"] == "0" && getLoginsend() == 3) {
        header("refresh:2;url=http://localhost/HeinCMS/");
    } else {
        header('Content-type: text/html; charset=utf-8');
    }
}


function getLoggedIn() {
    if(@$_GET['id'] == "0" && $GLOBALS["is_login"]) {
    echo "<script type='text/javascript' src='js/tinymce/tinymce.min.js'></script>
    <script type='text/javascript' src='js/tinymce/init.js'></script>\n";
    }
}

function getNavigation() {
    echo"<navigation>";
      include ("includes/templates/navigation.tpl.php");
    echo "</navigation>";
}

function getContent() {
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
  } else {
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
        @$inc = $row->included;

        if($inc == 1) { $incl = true; }
        if($inc == 0) { $incl = false; }
        if ($incl) {
            $file = "includes/pages/" . $row->name . "content.php";
            if (file_exists($file)) {
                include ($file);
            } else {
                $error = "file";
                include ("includes/internal/error.php");
            }
        } else {
            include ("includes/internal/page.php");
        }
        break;
    }
  }
  if ($debug) {
    echo "<br /><br />";
    var_dump($_SESSION);
    echo '<br /><br />Das CMS läuft in: ' . url() . '<br />
        CMS root: ' . document() . '<br />
        Auf Version: ' . getVersion() . ' ' . getVersionName() . ' (Build: ' . getBuild() . ')<br />
        <br /> Seite: ' . $page . '';
  }
}
?>
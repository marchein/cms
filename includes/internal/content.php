<?php
$mysqli = $GLOBALS["mysqli"];
$is_login = $GLOBALS["is_login"];
$debug = getDebug();


@$id = mysqli_real_escape_string($mysqli,$_GET["id"]);

    if($id == "") { $id = 1; }
    $query = "SELECT id, name, include FROM pages WHERE `id` = '". $id ."'";
    $result = $mysqli->query($query);
    if(mysqli_num_rows($result) == 0) {
        $error = "page";
        include("includes/internal/error.php");
    } else {
        if($debug){
            $query = "SELECT name FROM pages WHERE `id` = '". $id ."'";
            $name_result = $mysqli->query($query);
            $page = mysqli_fetch_object($name_result);
            $page = $page->name;
        }
        while($row = mysqli_fetch_object($result)) {
            if($debug) {
                echo "<br /><b>";
                var_dump($row);
                echo"</b>";
            }
            if($row->include == "true") {
                $file = "includes/pages/".$row->name."content.php";
                if(file_exists($file)) {
                    include($file);
                } else {
                    $error = "file";
                    include("includes/internal/error.php");
                }
            } elseif ($row->include == "false") {
                include("includes/internal/page.php");
            }
        }
    }

    if($debug) {
        echo "<br /><br />";
        var_dump($_SESSION);
        echo '<br /><br />Das CMS läuft in: '. url() . '<br />
        CMS root: '. $localurl . '<br />
        Auf Version: '.getVersion() . ' '.getVersionName() . ' (Build: '.getBuild().')<br />
        <br /> Seite: '.$page.'';
    }
?>
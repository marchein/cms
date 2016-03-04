<?php
$sql = "SELECT * FROM `news`";
$result = $mysqli_connect->query($sql);
$news_nums = $result->num_rows;
    if(isset($_GET['newsid'])) {
        $newsid = mysqli_real_escape_string($mysqli_connect, $_GET['newsid']);
        $news_button_url = " - <a href='".url()."?id=0&amp;ap=News&amp;newsid=".$newsid."'>Bearbeiten</a>";
    } else {
        $news_button_url = " - <a href='".url()."?id=0&amp;ap=News&amp;neu=true'>Neue News schreiben</a>";
    }
    echo "<h1>News"; if($is_login) { echo $news_button_url; } echo "</h1>";
    if($news_nums == 0) {
        echo "Keine News Vorhanden.";
    } else {
        if (isset($_GET['newsid'])) {
            $query = "SELECT * FROM news WHERE `id` = " . $newsid;
            $result = $mysqli_connect->query($query);
            if (mysqli_num_rows($result) == 0) {
                echo "Fehler!";
            } else {
                $row = mysqli_fetch_object($result);
                echo "<h3>" . $row->title . "</h3>
                " . $row->content . "";
            }
        } else {
            if(!isset($_GET["offset"])) {
                $offset = 0;
            } else {
                $offset = mysqli_real_escape_string($mysqli_connect, $_GET["offset"]);
            }

            $limit = 5;

            $sql = "SELECT * FROM `news` ORDER BY `id` DESC LIMIT ".$offset.", ".$limit."";
            $query = $mysqli_connect->query($sql);

            while($row = mysqli_fetch_object($query)) {
                echo "<h4><a href='".url()."/?id=".$_GET["id"]."&amp;newsid=".$row->id."'>".$row->title."</a></h4>";
                echo $row->content;
            }

            $before_offset = $offset - $limit;
            $next_offset = $offset + $limit;

            $all = "SELECT * FROM `news`";
            $all_query = $mysqli_connect->query($all);

            echo "<br />";
            if($offset >= $limit) {
                echo "<a href='".url()."/?id=".$_GET["id"]."&offset=".$before_offset."'>Back</a>";
            }

            if(mysqli_num_rows($all_query) > $next_offset) {
                echo " <a href='".url()."/?id=".$_GET["id"]."&offset=".$next_offset."'>Next</a>";
            }
        }
    }
?>
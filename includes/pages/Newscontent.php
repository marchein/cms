<?php
$sql = "SELECT * FROM `news`";
$result = $mysqli->query($sql);
$news_nums = $result->num_rows;
    if(isset($_GET['newsid'])) {
        $newsid = mysqli_real_escape_string($mysqli, $_GET['newsid']);
        $news_button_url = " - <a href='".url()."?id=0&amp;ap=News&amp;newsid=".$newsid."'>".$GLOBALS["lang"]["edit"]."</a>";
    } else {
        $news_button_url = " - <a href='".url()."?id=0&amp;ap=News&amp;neu=true'>".$GLOBALS["lang"]["new_news"]."</a>";
    }
    echo "<h1>News"; if($is_login) { echo $news_button_url; } echo "</h1>\n";
    if($news_nums == 0) {
        echo "Keine News Vorhanden.";
    } else {
        if (isset($_GET['newsid'])) {
            $query = "SELECT * FROM news WHERE `id` = " . $newsid;
            $result = $mysqli->query($query);
            if (mysqli_num_rows($result) == 0) {
                echo "Fehler!";
            } else {
                $row = mysqli_fetch_object($result);
                echo "<h3>" . $row->title . "</h3>
                " . htmlspecialchars_decode($row->content) . "";
            }
        } else {
            if(!isset($_GET["offset"])) {
                $offset = 0;
            } else {
                $offset = mysqli_real_escape_string($mysqli, $_GET["offset"]);
            }

            $limit = 5;

            $sql = "SELECT * FROM `news` ORDER BY `id` DESC LIMIT ".$offset.", ".$limit."";
            $query = $mysqli->query($sql);

            while($row = mysqli_fetch_object($query)) {
                echo "<h4><a href='".url()."/?id=".$_GET["id"]."&amp;newsid=".$row->id."'>".$row->title."</a></h4>\n";
                echo htmlspecialchars_decode($row->content);
            }

            $before_offset = $offset - $limit;
            $next_offset = $offset + $limit;

            $all = "SELECT * FROM `news`";
            $all_query = $mysqli->query($all);

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
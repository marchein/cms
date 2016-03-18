<?php
$query = $mysqli->query("SELECT * FROM `pages` WHERE `id` =  ".$id."");

$content = mysqli_fetch_object($query);

echo "<h1>".$content->name."";
if($is_login == 1) {
    echo ' - <a href="'.url().'/?id=0&amp;ap=Pages&amp;pageid='.$id.'">'.$GLOBALS['lang']['edit'].'</a>';
}

echo "</h1> \n";

if($debug) {
    echo "<h3>Created: ".$content->date_created."</h3>";
}

echo htmlspecialchars_decode(nl2br($content->content));

?>
<?php

echo "<!DOCTYPE html>
<html>
<head>
<meta charset='utf-8'/>
<title>" . getPageName() . "</title>\n";
getLoggedIn();
echo'
    <link rel="stylesheet" type="text/css" href="//netdna.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap-theme.min.css">
    <link rel="stylesheet" href="css/style.css">
</head>';
?>
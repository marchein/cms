<?php
$is_login = $GLOBALS["is_login"];
echo '
    <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
            <a class="navbar-brand" href="'.url().'/">'.getPageName().'</a>
          </div>
          <div class="navbar-collapse collapse">
          <ul class="nav navbar-nav">';
          echo "\n";

    $query = $GLOBALS["mysqli"]->query("SELECT id, name FROM `pages` WHERE `id` <> 0 ORDER BY `pages`.`position` ASC");

    while($result = mysqli_fetch_object($query)) {
        ($result->id == $_GET["id"]) ? $active = ' class="active"' : $active = "";
        echo '<li'.$active.'><a href="'.url().'/?id='.$result->id.'">'.$result->name.'</a></li>
        ';
    }
    $sql = "SELECT id FROM `pages` WHERE `name` LIKE 'Admin'";
    $result = $GLOBALS["mysqli"]->query($sql);
    $adminid = (mysqli_fetch_object($result)->id);
    echo'</ul>
    ';
    if($is_login == 1) {
        echo'<ul class="nav navbar-nav navbar-right">
            <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Menü <span class="caret"></span></a>
                <ul class="dropdown-menu">
                    <li><a href="'.url().'/?id=0">Admin Panel</a></li>
                    <li><a href="'.url().'/?id=0&amp;log_out=true">Abmelden</a></li>
                </ul>
              </li>
            </ul>';
    } else {
        echo'<p class="navbar-btn pull-right navbar-right">
        <a href="'.url().'/?id='.$adminid.'" class="btn btn-social btn-twitter">Anmelden</a>
        </p>';
    }
        echo '</div>
        </div>
      </nav>';
    ?>
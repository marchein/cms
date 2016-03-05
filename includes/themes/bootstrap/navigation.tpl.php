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

    $query = $GLOBALS["mysqli_connect"]->query("SELECT id, name FROM `pages` WHERE `id` <> 0 ORDER BY `pages`.`position` ASC");

    while($result = mysqli_fetch_object($query)) {
        echo "<li><a href='".url()."/?id=".$result->id."'>".$result->name."</a></li>";
    }
    $sql = "SELECT id FROM `pages` WHERE `name` LIKE 'Admin'";
    $result = $GLOBALS["mysqli_connect"]->query($sql);
    $adminid = (mysqli_fetch_object($result)->id);

    echo'</ul><p class="navbar-btn">
           <a href="'.url().'/?id='.$adminid.'" class="pull-right navbar-right btn btn-social btn-twitter"><i class="fa fa-lock"></i> Anmelden</a>
           </p></div><!--/.nav-collapse -->
        </div>
      </nav>';

    echo "\n";

    if(getDebug()) {
        if($is_login == 1) {
            echo "<br />Eingeloggt.";
        } else {
            echo "<br />Nicht eingeloggt.";
        }
    }
    ?>
<?php
	header("Content-Type: text/html; charset=utf-8");
	@ $HttpStatus = $_SERVER["REDIRECT_STATUS"];
	if ($HttpStatus == 200) {
		echo "<h1>200 - Document has been processed and sent to you.</h1>";
	}
	if ($HttpStatus == 400) {
		echo "<h1>400 - Bad HTTP request.</h1>";
	}
	if ($HttpStatus == 401) {
		echo "<h1>401 - Unauthorized - Invalid password.</h1>";
	}
	if ($HttpStatus == 403) {
		echo "<h1>403 - Forbidden</h1>";
	}
	if (@$error == "file" || $HttpStatus == 404) {
		echo "<h1>404 - Not Found</h1>";
        if(isset($file)) {
            echo $file ." not found";
        }
	}
	if ($HttpStatus == 500) {
		echo "<h1>500 - Internal Server Error</h1>";
	}
	if ($HttpStatus == 418) {
		echo "<h1>418 - I'm a teapot! - This is a real value, defined in 1998</h1>";
	}
	if (@$error == "page") {
		echo "<h1>Error! Page id not found.</h1>";
	}
	if ($HttpStatus != 404 && $HttpStatus != 403) {
		$page = "Error";
	}
?>
<?php
	session_start();
	if(!isset($_SESSION["username"])) {
		header("Location: main.php");
	} else {
		unset($_SESSION["username"]);
		header("Location: main.php");
	}
?>
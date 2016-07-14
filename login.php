<?php

// session_save_path(SESSION_DATA_FOLDER);
session_start();

require_once("config.php");
require_once("Libs/Model.php");

$model = new Model();

if (isset($_GET["action"])) {

	if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] == false) {
		if ($model->checkLogin($_POST["username"], $_POST["password"]) == true) {
	
			$_SESSION["loggedin"] = true;
			$_SESSION["username"] = $_POST["username"];
			
			header("Location: index.php");
		} else {
			header("Location: login.php");
		}
	} else {
		if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] == true) {
			$_SESSION = array();
			session_destroy();
		}
		
		header("Location: login.php");
	}
} else {
?>

<html>
<head>
	<title>ArtomiSys kirjautuminen</title>
	<link rel="stylesheet" type="text/css" href="css/main.css"/>
</head>
<body>

<div id="login">
	<h1>Kirjaudu</h1>
	
	<form action="login.php?action=true" method="post">
		<p><input type="text" name="username" placeholder="Käyttäjätunnus"></p>
		<p><input type="password" name="password" placeholder="Salasana"></p>
		<input type="submit" value="Kirjaudu">
	</form>
</div>

</body>
</html>

<?php
}
?>
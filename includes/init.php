<?php

// session_save_path(SESSION_DATA_FOLDER);
session_start();

require_once("config.php");

if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] == false) {
	header("Location: login.php");
}
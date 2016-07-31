<?php

Class Settings {
	
	private $model;
	private $view;

	function __construct($action = "none", $id = 0) {
		
		$this->model = new Model();
		$this->view = new View("settings", $action);
		
		switch($action) {
			case "changePassword";
				$this->changePassword();
			case "none":
				$this->index();
				break;
			default:
				die("An error occurred.");
				break;
		}
	}
	
	private function changePassword() {
		$username = $_SESSION['username'];
		$old_password = $_POST['old_password'];
		$new_password = $_POST['new_password'];
		$repeat_new_password = $_POST['repeat_new_password'];
		
		$ok = true;
		
		if($this->model->correctPassword($username, $old_password) && md5($new_password) == md5($repeat_new_password)) {
			if (!$this->model->changePassword($username, $new_password)) {
				$ok = false;
			}
		} else {
			$ok = false;
		}
		
		if ($ok == true) {
			// success
			$this->model->setStats(array("lastChangedPassword" => date("U")));
		} else {
			// failure
		}
		
		header("location: index.php?p=settings");
	}
	
	private function index() {
		$this->view->render("settings/index");
	}
}
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
		$old_password = $_POST['old_password'];
		$new_password = $_POST['new_password'];
		$repeat_new_password = $_POST['repeat_new_password'];
		$correct_password = $this->model->fetchPassword("");
	}
	
	private function index() {
		$this->view->render("settings/index");
	}
}
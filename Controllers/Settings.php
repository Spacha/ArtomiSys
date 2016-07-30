<?php

Class Settings {
	
	private $model;
	private $view;

	function __construct($action = "none", $id = 0) {
		
		$this->model = new Model();
		$this->view = new View("settings", $action);
		
		switch($action) {
			case "none":
				$this->index();
				break;
			default:
				die("An error occurred.");
				break;
		}
	}
	
	private function index() {
		$this->view->render("settings/index");
	}
}
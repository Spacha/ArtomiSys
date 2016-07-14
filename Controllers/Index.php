<?php

/*
	Index page shows some statistics like amount of pages, products and last login.
	
	Index class also takes care of logins and log outs.
*/

Class Index {
	
	private $model;
	private $view;

	function __construct($action = "none", $id = 0) {
		
		$this->model = new Model();
		$this->view = new View("index", $action);
		
		switch($action) {
			case "help":
				$this->help();
				break;
			case "fast_guide":
				$this->fastGuide();
				break;
			case "none":
				$this->statistics();
				break;
			default:
				die("An error occurred.");
				break;
		}
	}
	
	private function help() {
		$this->view->data = $this->model->helpContent();
		$this->view->render("index/help");
	}
	private function fastGuide() {
		$this->view->data = $this->model->helpContent(HELP_FILE_FAST);
		$this->view->render("index/help");
	}
	
	private function statistics() {
		$stats = array(
				"pagesCount",
				"productsCount",
				"lastChangedPassword");
		$this->view->data = $this->model->getStats($stats);
		$this->view->render("index/index");
	}
}
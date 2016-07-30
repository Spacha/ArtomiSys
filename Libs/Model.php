<?php

Class Model {

	private $dbCon;
	public $latestId;

	function __construct() {
		try {
			$this->dbCon = new PDO("mysql:host=".DB_HOST.";dbname=".DB_NAME.";", DB_USER, DB_PASSW);
		} catch (PDOException $e) {
			die("ERROR: " .$e->getMessage());
		}
		$this->dbCon->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$this->dbCon->exec("SET NAMES utf8");
	}
	
	public function checkLogin($username, $password) {
		
		if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] == false) {
			
			$query = $this->dbCon->prepare("SELECT * FROM users WHERE username = ?");
			$query->execute(array($username));
			
			$result = $query->fetch();
			
			$correct_password = $result["password"];
			
			if (md5($password) == $correct_password) {
				return true;
			} else {
				return false;
			}
		}
	}
	
	public function helpContent($file = HELP_FILE_INDEX) {
		$path = HELP_FILE_ROOT.$file;
		return file_get_contents($path);
	}
	
	public function fetchPostData($id, $nl = false) {
		$query = $this->dbCon->prepare("SELECT * FROM products WHERE id = ?");
		$query->execute(array($id));
		
		$result = $query->fetch();
		$data["id"] = $result["id"];
		$data["uniqid"] = $result["uniqid"];
		$data["header"] = $result["header"];
		$data["date"] = $result["date"];
		$data["content"] = ($nl == true) ? nl2br($result["content"]) : $result["content"];
		
		$data["img"] = $this->fetchImages($data["uniqid"]);
		
		return $data;
	}
	
	// Returns all images from 'uploads/products/' by uniqid
	public function fetchImages($uniqid, $array = array()) {
		
		$img_names = array();
		
		$files = scandir(ROOT_PATH."/uploads/products");
		
		for($i = 0; $i < count($files); $i++) {
			if (!is_dir($files[$i])) {
				
				$file = explode(".", $files[$i]);
				
				// TODO: make a list of acceptable forms and go it through
				if (end($file) == "jpg" || end($file) == "png" || end($file) == "jpeg" || end($file) == "gif") {
					
					$tmp = explode("_", $file[0]);
					$file_key = $tmp[0];
					$file_num = end($tmp);
					
					if ($file_key == $uniqid) {
						$img_names[$i]["img"] = $files[$i];
						$img_names[$i]["num"] = $file_num;
					}
				}
			}
			
			// drop off unecessary images
			if (isset($array) && !empty($array)) {
				foreach($img_names["img"] as $img) {
					if (in_array($img, $array)) {
						unset($img);
					}
				}
			}
		}
		
		return $img_names;
	}
	
	// Find images by name WITHOUT file form
	public function image_exists($img) {
		
		$img = end(explode("/", $img));
		
		$files = scandir(ROOT_PATH."/uploads/products");
		$files = array_diff($files, array('.', '..'));
		
		foreach($files as $file) {
			
			if (!is_dir($file)) {
				
				$file_parts = explode(".", $file);
				$file_name = $file_parts[0];
				$file_form = end($file_parts);
				
				//die($file_name);
				
				if ($file_name == $img) {
					return $file_form;
				}
			}
		}
		
		return false;
	}
	
	public function fetchPosts($order = "ASC") {
		$query = $this->dbCon->prepare("SELECT * FROM products ORDER BY date $order");
		$query->execute();
		
		$i = 0;
		
		while($result = $query->fetch()) {
			
			$products[$i]["id"] = $result["id"];
			$products[$i]["uniqid"] = $result["uniqid"];
			$products[$i]["header"] = $result["header"];
			$products[$i]["content"] = $result["content"];
			$products[$i]["date"] = $result["date"];
			
			$i++;
		}
		
		if ($i > 0) {
			return $products;
		} else {
			return false;
		}
	}
	
	public function saveProduct($uniqid, $header, $content, $date = 0, $id = 0) {
	
		if ($date == 0 && $id > 0) {
			$query = $this->dbCon->prepare("UPDATE `products` SET `header`='{$header}',`content`='{$content}' WHERE id = {$id}");
			$query->execute();	
		} else {
			$query = $this->dbCon->prepare("INSERT INTO products(uniqid,header,content,date) VALUES(?,?,?,?)");
			$query->execute(array($uniqid, $header, $content, $date));
		}
		
		$this->latestId = $this->dbCon->lastInsertId();
	}
	
	public function getStats($stats) {
	
		foreach ($stats as $stat)
		{
			switch ($stat) {
				case "productsCount":
					$query = $this->dbCon->prepare("SELECT count(*) FROM products");
					$query->execute();
					$data[$stat] = $query->fetchColumn();
					break;
				case "lastChangedPassword":
					$query = $this->dbCon->prepare("SELECT * FROM statistics WHERE tag = '$stat'");
					$query->execute();
					
					$tmp = $query->fetch();
					$data[$stat] = $tmp["value"];
					break;
				default:
				$data[$stat] = "Tuntematon";
				break;
			}
			
		}
		
		return $data;
	}
	
	public function delete($id) {
		$query = $this->dbCon->prepare("SELECT COUNT(*) FROM products WHERE id = ? LIMIT 1");
		$query->bindParam(1, $_GET['id'], PDO::PARAM_INT);
		$query->execute();
		
		if ($query->fetchColumn()) {
			$query2 = $this->dbCon->prepare("SELECT * FROM products WHERE id = ?");
			$query2->execute(array($id));
			
			$result = $query2->fetch();
			
			$this->deleteImgFilesById($result["uniqid"]);
			
			// delete it
			$query = $this->dbCon->prepare("DELETE FROM products WHERE id = ?");
			
			if ($query->execute(array($id))) {
				return true;
			}
		}
	}
	
	public function deleteImgFilesById($uniqid, $array = array()) {
		
		if (!empty($array)) {
			$images = $this->fetchImages($uniqid, $array);
			
			foreach($images as $image) {
				$img_full_name = "uploads/products/". $image;
				unlink($img_full_name);
			}
		}
		
		if (empty($array)) {
			$images = $this->fetchImages($uniqid);
			
			foreach($images as $image) {
				$img_full_name = UPLOAD_TARGET."/". $image['img'];
				unlink($img_full_name);
			}
		}
		
		return true;
	}
	
	public function deleteImgFiles(array $images) {
		foreach($images as $image) {
			if (file_exists($image)) {
				unlink($image);
			}
		}
	}
}
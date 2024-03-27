<?php

$filepath = realpath(dirname(__FILE__));
include_once ($filepath.'/../lib/Database.php');
/**
* Format Class
*/
class Format{
	public $db;

	public function __construct(){
		$this->db = new Database();
	}
	public function formatDate($date){
		return date('F j, Y, g:i a', strtotime($date));
	}

	public function textShorten($text, $limit = 400){
		$text = $text. " ";
		$text = substr($text, 0, $limit);
		$text = substr($text, 0, strrpos($text, ' '));
		$text = $text.".....";
		return $text;
	}

	public function validation($data){
		$data = trim($data);
		$data = stripcslashes($data);
		$data = htmlspecialchars($data);
		$data = mysqli_real_escape_string($this->db->link, $data);
		return $data;
	}

	public function title(){
		$path = $_SERVER['SCRIPT_FILENAME'];
		$title = basename($path, '.php');
		//$title = str_replace('_', ' ', $title);
		if ($title == 'index') {
			$title = 'home';
		}elseif ($title == 'contact') {
			$title = 'contact';
		}
		return $title = ucfirst($title);
	}

	//check username availability
	public function check_username($username){
		$sql = "SELECT * FROM tbl_user WHERE username = '$username'";
		$result = $this->db->select($sql);
		if($result){
			return true;
		}else{
			return false;
		}
	}

	public function check_email($email){
		$sql = "SELECT * FROM tbl_user WHERE email = '$email'";
		$result = $this->db->select($sql);
		if($result){
			return true;
		}else{
			return false;
		}
	}

	//check question availability
	public function check_question($question){
		$sql = "SELECT * FROM tbl_question WHERE question = '$question'";
		$result = $this->db->select($sql);
		if($result){
			return true;
		}else{
			return false;
		}
	}

}
?>
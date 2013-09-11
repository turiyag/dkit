<?php
require_once "sqli.php";

if(session_id() == '') {
	session_start();
}

if(!empty($_REQUEST['projectid'])) {
	$_SESSION['project'] = $_REQUEST['project'];
}

class Projects
{
	public function listAll() {
		//Using the global $mysqli connection
		$mysqli = $GLOBALS['mysqli'];
		$query = "SELECT id FROM projects";
		$result = $mysqli->query($query);
		if (!$result) {
			throw new Exception($mysqli->error);
		}
		if ($result->num_rows > 0) {
			while($row = $result->fetch_assoc()) {
				$clients[] = new Client($row['username']);
			}
			return $clients;
		} else {
			throw new Exception('No clients found');
		}
	}
	
	public static function add($username) {
		//Using the global $mysqli connection
		$mysqli = $GLOBALS['mysqli'];
		$query = "INSERT INTO users (username) VALUES ('" . $mysqli->real_escape_string($username) . "')";
		$result = $mysqli->query($query);
		if (!$result) {
			throw new Exception($mysqli->error);
		}
		return new User($username);
	}
}

class Project
{
	// property declaration
	private $id;
	
	// method declaration
	public function username() {
		echo $this->id;
	}
	
	public function get($attr = "", $table = "users") {
		//Using the global $mysqli connection
		$mysqli = $GLOBALS['mysqli'];
		$query = "SELECT * FROM " . $mysqli->real_escape_string($table) . " WHERE username='" . $mysqli->real_escape_string($_SESSION['username']) . "'";
		$result = $mysqli->query($query);
		if (!$result) {
			throw new Exception($mysqli->error);
		}
		//If credentials are accurate
		if ($result->num_rows > 0) {
			$row = $result->fetch_assoc();
			if ($attr == "") {
				return $row;
			} else {
				return $row[$attr];
			}
		} else {
			throw new Exception('User not found');
		}
	}
	
	public function set($attr, $val, $table = "users") {
		//Using the global $mysqli connection
		$mysqli = $GLOBALS['mysqli'];
		$eattr = $mysqli->real_escape_string($attr);
		$eval = $mysqli->real_escape_string($val);
		$etable = $mysqli->real_escape_string($table);
		$euser = $mysqli->real_escape_string($this->id);
		$query = "INSERT INTO $etable (username,$eattr) VALUES ('$euser','$eval')";
		$query .= " ON DUPLICATE KEY UPDATE $eattr='$eval'";
		//infomsg($query);
		$result = $mysqli->query($query);
		if (!$result) {
			throw new Exception($mysqli->error);
		}
	}
	
	public function setPassword($pwd) {
		//Using the global $mysqli connection
		$mysqli = $GLOBALS['mysqli'];
		$query = "UPDATE users SET password='" . sha1($mysqli->real_escape_string($pwd)) . "' ";
		$query .= "WHERE username='" . $mysqli->real_escape_string($this->id) . "'";
		$result = $mysqli->query($query);
		if (!$result) {
			throw new Exception($mysqli->error);
		}
		//successmsg("Password updated");
	}
	
	function __construct($id = "",$checkExistence = true) {
		if($id === "") {
			$id = currentProject();
			if($id === false) {
				throw new InvalidArgumentException('Null project id');
			}
		}
		if(is_numeric($id)){
			
		}
		if($checkexistence) {
			if(!$this->exists()) {
				throw new ExistenceException('Client does not exist');
			}
		}
		if($username == "") {
			if(isset($_SESSION['username'])) {
				$username = $_SESSION['username'];
			}
		}
		$this->id = $username;
	}
	
	public static function currentProject() {
		if(isset($_SESSION['project'])) {
			return $_SESSION['project'];
		} else {
			return false;
		}
	}
}
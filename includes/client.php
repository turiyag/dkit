<?php
require_once "sqli.php";
require_once "user.php";

class Clients
{
	public static function listAll() {
		//Using the global $mysqli connection
		$mysqli = $GLOBALS['mysqli'];
		$query = "SELECT id FROM clients";
		$result = $mysqli->query($query);
		if (!$result) {
			throw new Exception($mysqli->error);
		}
		if ($result->num_rows > 0) {
			while($row = $result->fetch_assoc()) {
				$clients[] = new Client($row['id']);
			}
			return $clients;
		} else {
			return array();
		}
		infomsg("test3");
	}
	
	public static function add($owner = "") {
		if ($owner === "") {
			$u = User::currentUser();
		}
		//Using the global $mysqli connection
		$mysqli = $GLOBALS['mysqli'];
		$query = "INSERT INTO clients (name,own_u,notes) VALUES ('','" . $u . "','')";
		$result = $mysqli->query($query);
		if (!$result) {
			throw new Exception($mysqli->error);
			return false;
		}
		return new Client($mysqli->insert_id);
	}
}

class Client
{
	// property declaration
	public $id;
	
	public function get($attr = "", $table = "clients") {
		//Using the global $mysqli connection
		$mysqli = $GLOBALS['mysqli'];
		$query = "SELECT * FROM " . $mysqli->real_escape_string($table);
		$query .= " WHERE id=" . $mysqli->real_escape_string($this->id);
		$result = $mysqli->query($query);
		if (!$result) {
			throw new Exception($mysqli->error);
			return false;
		}
		if ($result->num_rows > 0) {
			$row = $result->fetch_assoc();
			if ($attr == "") {
				return $row;
			} else {
				return $row[$attr];
			}
		} else {
			return false;
		}
	}
	
	public function set($attr, $val, $table = "clients") {
		//Using the global $mysqli connection
		$mysqli = $GLOBALS['mysqli'];
		$query = "UPDATE " . $mysqli->real_escape_string($table) . " SET " . $mysqli->real_escape_string($attr). "='" . $mysqli->real_escape_string($val) . "' ";
		$query .= "WHERE id=" . $mysqli->real_escape_string($this->id);
		$result = $mysqli->query($query);
		if (!$result) {
			throw new Exception($mysqli->error);
			return false;
		}
		return true;
	}
	
	function __construct($id = "", $checkexistence = true) {
		if($id == "") {
			if (empty($_SESSION['client'])) {
				throw new Exception('No current client');
			} else {
				$id = $_SESSION['client'];
			}
		}
		if(!is_numeric($id)) {
			throw new Exception('Non-numeric id');
		}
		$this->id = $id;
		if($checkexistence) {
			if(!$this->exists()) {
				throw new Exception('Client does not exist');
			}
		}
	}
	
	public function currentClient() {
		if (empty($_SESSION['client'])) {
			throw new Exception('No current client');
		} else {
			$id = $_SESSION['client'];
		}
	}
	
	public function exists($table = "clients") {
		//Using the global $mysqli connection
		$mysqli = $GLOBALS['mysqli'];
		$query = "SELECT * FROM " . $mysqli->real_escape_string($table);
		$query .= " WHERE id=" . $mysqli->real_escape_string($this->id);
		$result = $mysqli->query($query);
		if (!$result) {
			throw new Exception($mysqli->error);
			return false;
		}
		if ($result->num_rows > 0) {
			return true;
		} else {
			return false;
		}
	}
	
	public function delete($table = "clients") {
		//Using the global $mysqli connection
		$mysqli = $GLOBALS['mysqli'];
		$query = "DELETE FROM " . $mysqli->real_escape_string($table);
		$query .= " WHERE id=" . $mysqli->real_escape_string($this->id);
		$result = $mysqli->query($query);
		if (!$result) {
			throw new Exception($mysqli->error);
			return false;
		} else {
			return true;
		}
	}
}
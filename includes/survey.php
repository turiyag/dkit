<?php
require_once "sqli.php";

class Surveys
{
	public function listAll() {
		//Using the global $mysqli connection
		$mysqli = $GLOBALS['mysqli'];
		$query = "SELECT id FROM clients";
		$result = $mysqli->query($query);
		if ($result->num_rows > 0) {
			while($row = $result->fetch_assoc()) {
				$clients[] = new Client($row['id']);
			}
			return $clients;
		} else {
			return false;
		}
	}
	
	public function add() {
		//Using the global $mysqli connection
		$mysqli = $GLOBALS['mysqli'];
		$query = "INSERT INTO clients (name) VALUES ('')";
		return new Client($mysqli->insert_id);
	}
}

class Survey
{
	// property declaration
	public $id;
	
	public function get($attr = "", $table = "clients") {
		//Using the global $mysqli connection
		$mysqli = $GLOBALS['mysqli'];
		$query = "SELECT * FROM " . $mysqli->real_escape_string($table);
		$query .= " WHERE id=" . $mysqli->real_escape_string($this->id);
		$result = $mysqli->query($query);
		//If credentials are accurate
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
	}
	
	function __construct($id) {
		$this->id = $id;
	}
}
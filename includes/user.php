<?php
require_once "sqli.php";

class Users
{
    public function listAll() {
        global $mysqli;
        $query = "SELECT username FROM users";
        $result = $mysqli->query($query);
        if (!$result) {
            errormsg($mysqli->error);
            return false;
        }
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                $clients[] = new Client($row['username']);
            }
            return $clients;
        } else {
            return false;
        }
    }
    
    public static function add($username) {
        global $mysqli;
        $query = "INSERT INTO users (username) VALUES ('" . $mysqli->real_escape_string($username) . "')";
        $result = $mysqli->query($query);
        if (!$result) {
            errormsg($mysqli->error);
            return false;
        }
        return new User($username);
    }
}

class User
{
    // property declaration
    private $id;
    
    // method declaration
    public function username() {
        echo $this->id;
    }
    
    public function get($attr = "", $table = "users") {
        global $mysqli;
        $query = "SELECT * FROM " . $mysqli->real_escape_string($table) . " WHERE username='" . $mysqli->real_escape_string($_SESSION['username']) . "'";
        $result = $mysqli->query($query);
        if (!$result) {
            errormsg($mysqli->error);
            return false;
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
            return false;
        }
    }
    
    public function set($attr, $val, $table = "users") {
        global $mysqli;
        $eattr = $mysqli->real_escape_string($attr);
        $eval = $mysqli->real_escape_string($val);
        $etable = $mysqli->real_escape_string($table);
        $euser = $mysqli->real_escape_string($this->id);
        $query = "INSERT INTO $etable (username,$eattr) VALUES ($euser,$eval)";
        $query .= " ON DUPLICATE KEY UPDATE $eattr='$eval'";
        infomsg($query);
        $result = $mysqli->query($query);
        if (!$result) {
            errormsg($mysqli->error);
            return false;
        }
    }
    
    public function setPassword($pwd) {
        global $mysqli;
        $query = "UPDATE users SET password='" . sha1($mysqli->real_escape_string($pwd)) . "' ";
        $query .= "WHERE username='" . $mysqli->real_escape_string($this->id) . "'";
        $result = $mysqli->query($query);
        if (!$result) {
            errormsg($mysqli->error);
            return false;
        }
        successmsg("Password updated");
    }
    
    function __construct($username = "") {
        if($username == "") {
            if(isset($_SESSION['username'])) {
                $username = $_SESSION['username'];
            }
        }
        $this->id = $username;
    }
    
    public static function currentUser() {
        if(isset($_SESSION['username'])) {
            return $_SESSION['username'];
        } else {
            return false;
        }
    }
    
    public static function login($username, $password) {
        global $mysqli;
        $query = "SELECT * FROM users WHERE username='" . $mysqli->real_escape_string($username) . "' AND password='" . sha1($mysqli->real_escape_string($password)) . "'";
        $result = $mysqli->query($query);
        if (!$result) {
            errormsg($mysqli->error);
            return false;
        }
        //If credentials are accurate
        if ($result->num_rows > 0) {
            $_SESSION['username'] = $_POST['username'];
            return true;
        } else {
            return false;
        }
        $result->free();
    }
}
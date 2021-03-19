<?php

class Db{

	public $servername = "localhost";
	public $username = "root";
	public $password = "";
	public $dbname = "tms";
	public $conn;
	public $error;

	function __construct(){
		$this->conn = new mysqli($this->servername, $this->username, $this->password, $this->dbname);
		if ($this->conn->connect_error) {
			$this->error = $this->conn->connect_error;
		}
	}

	function get_item_by_id($table_name, $item_id){
		$sql = "SELECT * FROM ".$table_name." WHERE id=".$item_id;
		$result = $this->conn->query($sql);
		$data = $result->fetch_assoc();
		return $data;
	}

	function get_all_items($table_name){
		$sql = "SELECT * FROM ".$table_name;
		$result = $this->conn->query($sql);
		$data = $result->fetch_array();
		return $data;
	}

	function post_item($table_name, $fields = [], $values = []){
		$sql = "INSERT INTO ".$table_name." (id";
		for ($i=0; $i < count($fields); $i++) { 
			$sql .= ",".$fields[$i];
		}
		$sql .= ") VALUES ('0'";
		for ($i=0; $i < count($values); $i++) { 
			$sql .= ",'".$values[$i]."'";
		}
		$sql .= ");";
		$result = $this->conn->query($sql);
		if ($result != TRUE){
			$this->error = $this->conn->error;
		}
		return $result;
	}

	function update_item_by_id($table_name, $id, $fields = [], $values = []){
		$sql = "UPDATE ".$table_name." SET ";
		for ($i=0; $i < count($fields); $i++) { 
			if ($i == 0){
				$sql .= $fields[$i]."='".$values[$i]."'";
			} else {
				$sql .= ", ".$fields[$i]."='".$values[$i]."'";
			}
		}
		$sql .= " WHERE id=$id;";
		$result = $this->conn->query($sql);
		if ($result != TRUE){
			$this->error = $this->conn->error;
		}
		return $sql;
	}

	function delete_item_by_id($table_name, $id){
		$sql = "DELETE FROM $table_name WHERE id=$id";
		$result = $this->conn->query($sql);
		if ($result != TRUE){
			$this->error = $this->conn->error;
		}
	}

}

class Users extends Db{
	function get_user_by_id($user_id){
		return $this->get_item_by_id("tms_users", $user_id);
	}

	function get_all_users(){
		return $this->get_all_items("tms_users");
	}

	function add_user($username, $first_name, $last_name, $contact_number, $email="", $tms_group_id=2, $image_url="", $status="DEACTIVATED"){
		$fields = ["username", "first_name", "last_name", "contact_number", "email", "tms_group_id", "image_url", "status"];
		$result = $this->post_item("tms_users", $fields, [$username, $first_name, $last_name, $contact_number, $email, $tms_group_id, $image_url, $status]);
	}

	function update_user($id, $username="", $first_name="", $last_name="", $contact_number="", $email="", $tms_group_id=0, $image_url="", $status=""){
		$user = $this->get_user_by_id($id);
		if($username == ""){
			$username = $user["username"];
		}
		if($first_name == ""){
			$first_name = $user["first_name"];
		}
		if($last_name == ""){
			$last_name = $user["last_name"];
		}
		if($contact_number == ""){
			$contact_number = $user["contact_number"];
		}
		if($email == ""){
			$email = $user["email"];
		}
		if($tms_group_id == 0){
			$tms_group_id = $user["tms_group_id"];
		}
		if($image_url == ""){
			$image_url = $user["image_url"];
		}
		if($status == ""){
			$status = $user["status"];
		}

		$fields = ["username", "first_name", "last_name", "contact_number", "email", "tms_group_id", "image_url", "status"];
		$result = $this->update_user_by_id("tms_users", $id, $fields, [$username, $first_name, $last_name, $contact_number, $email, $tms_group_id, $image_url, $status]);
	}

	function delete_user($user_id){
		$result = $this->delete_item_by_id("tms_users", $user_id);
	}
}
?>
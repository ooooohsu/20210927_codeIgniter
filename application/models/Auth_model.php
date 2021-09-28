<?php

class Auth_model extends CI_Model
{
	public function __construct()
	{
		parent:: __construct();
	}

	function get_member_info($email){
		$sql = "SELECT HEX(seq) as seq, email, password FROM member WHERE email = ?";
		$query = $this->db-> query($sql, $email);
		$res = $query-> row_array();

		return $res;
	}

	function insert_member($data){
		$sql = "INSERT INTO member(seq,email,password,created_at) VALUES (?, ?, ?, ?)";
		$this->db->query($sql,array(ordered_uuid(uuid()), $data["email"],  $data["password"], $data["created_at"]));
		if(	$this->db->affected_rows() > 0){
			return true;
		}else{
			return false;
		}
	}
}

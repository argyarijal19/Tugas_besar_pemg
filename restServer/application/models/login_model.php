<?php
class Login_model extends CI_Model
{
	public function __construct()
	{
		$this->load->database();
	}

	public function get_data($username, $password, $tabel)
	{
		$data = $this->db->query("SELECT * from $tabel where username='$username' AND password='$password' LIMIT 1 ");

		return $data;
	}
	function execute_query($sql)
	{
		return $this->db->query($sql)->result_array();
	}
	public function register($data)
	{
		// User data array
		$this->load->helper('string');
		$data = array(
			'username' => $this->input->post('username'),
			'password' => $this->input->post('password'),
		);
		// Insert user
		return $this->db->insert('user', $data);
	}
}

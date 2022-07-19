<?php
class Crud_model extends CI_Model
{
    public function __construct()
    {
        $this->load->database();
    }
    public function saverecords($data)
    {
        $this->db->insert('keys', $data);
        return true;
    }
}

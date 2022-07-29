<?php
class Admin_Model extends CI_Model
{
	public function __construct()
	{
		$this->load->database();
	}

	public function getAdminID($id)
	{
		if ($id) {
            $this->db->where('id_admin', $id);            
            $this->db->select('id_admin, username, password, nama_lengkap, foto_profil');
            $this->db->from('admin');
            $admin = $this->db->get()->result();
            return $admin;
        } else {
            $this->db->select('id_admin, username, password, nama_lengkap, foto_profil');
            $this->db->from('admin');
            $admin = $this->db->get()->result();
            return $admin;
        }
	}

	public function getAdmin()
	{
        $this->db->select('id_admin, username, password, nama_lengkap, foto_profil');
        $this->db->from('admin');
        $admin = $this->db->get()->result();
        return $admin;
	}

    public function postadmin()
    {
        $data = array(
            'username' => $this->input->post('username'),
            'password' => $this->input->post('password'),
            'nama_lengkap' => $this->input->post('nama_lengkap'),
            'foto_profil' => $this->input->post('foto_profil')
        );
        $insert = $this->db->insert('admin', $data);
        return $insert;
    }

    public function updateadmin($id, $data)
    {
        $this->db->where('id_admin', $id);
        $update = $this->db->update('admin', $data);
        return $update;
    }
    public function deleteadmin($id)
    {
        $this->db->where('id_admin', $id);
        $delete = $this->db->delete('admin');
        return $delete;
    }
}

<?php
class Pelanggan_Model extends CI_Model
{
	public function __construct()
	{
		$this->load->database();
	}

	public function getPelangganID($id)
	{
		if ($id) {
            $this->db->where('id_pelanggan', $id);
            $this->db->select('id_pelanggan, email_pelanggan, password_pelanggan, nama_pelanggan, telepon_pelanggan');
            $this->db->from('pelanggan');
            $pelanggan = $this->db->get()->result();
            return $pelanggan;
        } else {
            $this->db->select('id_pelanggan, email_pelanggan, password_pelanggan, nama_pelanggan, telepon_pelanggan');
            $this->db->from('pelanggan');
            $pelanggan = $this->db->get()->result();
            return $pelanggan;
        }
	}

	public function getPelanggan()
	{
        $this->db->select('id_pelanggan, email_pelanggan, password_pelanggan, nama_pelanggan, telepon_pelanggan');
        $this->db->from('pelanggan');
        $pelanggan = $this->db->get()->result();
        return $pelanggan;
	}

    public function postpelanggan()
    {
        $data = array(
            'email_pelanggan' => $this->input->post('email_pelanggan'),
            'password_pelanggan' => $this->input->post('password_pelanggan'),
            'nama_pelanggan' => $this->input->post('nama_pelanggan'),
            'telepon_pelanggan' => $this->input->post('telepon_pelanggan')
        );
        $insert = $this->db->insert('pelanggan', $data);
        return $insert;
    }

    public function updatepelanggan($id, $data)
    {
        $this->db->where('id_pelanggan', $id);
        $update = $this->db->update('pelanggan', $data);
        return $update;
    }
    public function deletepelanggan($id)
    {
        $this->db->where('id_pelanggan', $id);
        $delete = $this->db->delete('pelanggan');
        return $delete;
    }
}

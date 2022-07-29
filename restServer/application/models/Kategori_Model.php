<?php
class Kategori_Model extends CI_Model
{
	public function __construct()
	{
		$this->load->database();
	}

	public function getKategoriID($id)
	{
		if ($id) {
            $this->db->where('id_kategori', $id);            
            $this->db->select('id_kategori, nama_kategori');
            $this->db->from('kategori');
            $kategori = $this->db->get()->result();
            return $kategori;
        } else {
            $this->db->select('id_kategori, nama_kategori');
            $this->db->from('kategori');
            $kategori = $this->db->get()->result();
            return $kategori;
        }
	}

	public function getKategori()
	{
        $this->db->select('id_kategori, nama_kategori');
        $this->db->from('kategori');
        $kategori = $this->db->get()->result();
        return $kategori;
	}

    public function postkategori()
    {
        $data = array(
            'nama_kategori' => $this->input->post('nama_kategori')
        );
        $insert = $this->db->insert('kategori', $data);
        return $insert;
    }

    public function updatekategori($id, $data)
    {
        $this->db->where('id_kategori', $id);
        $update = $this->db->update('kategori', $data);
        return $update;
    }
    public function deletekategori($id)
    {
        $this->db->where('id_kategori', $id);
        $delete = $this->db->delete('kategori');
        return $delete;
    }
}

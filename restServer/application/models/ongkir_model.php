<?php
class ongkir_model extends CI_Model
{
	public function __construct()
	{
		$this->load->database();
	}

	public function getongkirid($id)
	{
		if ($id) {
            $this->db->where('id_ongkir', $id);            
            $this->db->select('id_ongkir, nama_kota, tarif');
            $this->db->from('ongkir');
            $ongkir = $this->db->get()->result();
            return $ongkir;
        } else {
            $this->db->select('id_ongkir, nama_kota, tarif');
            $this->db->from('ongkir');
            $ongkir = $this->db->get()->result();
            return $ongkir;
        }
	}

	public function getongkir()
	{
        $this->db->select('id_ongkir, nama_kota, tarif');
        $this->db->from('ongkir');
        $ongkir = $this->db->get()->result();
        return $ongkir;
	}

    public function postongkir()
    {
        $data = array(
            'nama_kota' => $this->input->post('nama_kota'),
            'tarif' => $this->input->post('tarif')

        );
        $insert = $this->db->insert('ongkir', $data);
        return $insert;
    }

    public function updateongkir($data, $id_ongkir)
    {
        $this->db->update('ongkir',$data,['id_ongkir' => $id_ongkir]);
        return $this->db->affected_rows();
    }
    public function deleteongkir($id)
    {
        $this->db->where('id_ongkir', $id);
        $delete = $this->db->delete('ongkir');
        return $delete;
    }
}

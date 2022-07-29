<?php
class Pembelianproduk_Model extends CI_Model
{
	public function __construct()
	{
		$this->load->database();
	}

	public function getPembelianprodukID($id)
	{
        if ($id) {
            $this->db->where('id_pembelian_produk', $id);
            $this->db->select('id_pembelian_produk, nama, harga, berat, sub_berat, sub_harga, jumlah ');
            $this->db->from('pembelian_produk');
            $pembelian_produk = $this->db->get()->result();
            return $pembelian_produk;
        } else {
            $this->db->select('id_pembelian_produk, nama, harga, berat, sub_berat, sub_harga, jumlah ');
            $this->db->from('pembelian_produk');
            $pembelian_produk = $this->db->get()->result();
            return $pembelian_produk;
        }
	}

	public function getPembelianproduk()
	{
        $this->db->select('id_pembelian_produk, nama, harga, berat, sub_berat, sub_harga, jumlah ');
        $this->db->from('pembelian_produk');
        $pembelian_produk = $this->db->get()->result();
        return $pembelian_produk;
	}

    public function postpembelianproduk()
    {
        $data = array(
            'id_produk' => $this->input->post('id_produk'),
            'id_pembelian' => $this->input->post('id_pembelian'),
            'nama' => $this->input->post('nama'),
            'harga' => $this->input->post('harga'),
            'berat' => $this->input->post('berat'),
            'sub_berat' => $this->input->post('sub_berat'),
            'sub_harga' => $this->input->post('sub_harga'),
            'jumlah' => $this->input->post('jumlah')
        );
        $insert = $this->db->insert('pembelian_produk', $data);
        return $insert;
    }

    public function updatepembelianproduk($id, $data)
    {
        $this->db->where('id_pembelian_produk', $id);
        $update = $this->db->update('pembelian_produk', $data);
        return $update;
    }
    public function deletepembelianproduk($id)
    {
        $this->db->where('id_pembelian_produk', $id);
        $delete = $this->db->delete('pembelian_produk');
        return $delete;
    }
}

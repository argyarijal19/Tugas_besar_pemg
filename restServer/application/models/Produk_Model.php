<?php
class Produk_Model extends CI_Model
{
	public function __construct()
	{
		$this->load->database();
	}

	public function getProdukID($id)
	{
		if ($id) {
            $this->db->where('id_produk', $id);
            $this->db->select('p.id_produk, p.nama_produk, p.harga_produk, p.berat_produk, p.foto_produk, p.deskripsi_produk, p.stok_produk, k.nama_kategori');
            $this->db->from('produk p');
            $this->db->join('kategori k', 'p.id_kategori=k.id_kategori');
            $produk = $this->db->get()->result();
            return $produk;
        } else {
            $this->db->select('p.id_produk, p.nama_produk, p.harga_produk, p.berat_produk, p.foto_produk, p.deskripsi_produk, p.stok_produk, k.nama_kategori');
            $this->db->from('produk p');
            $this->db->join('kategori k', 'p.id_kategori=k.id_kategori');
            $produk = $this->db->get()->result();
            return $produk;
        }
	}

	public function getProduk()
	{
        $this->db->select('p.id_produk, p.nama_produk, p.harga_produk, p.berat_produk, p.foto_produk, p.deskripsi_produk, p.stok_produk, k.nama_kategori');
        $this->db->from('produk p');
        $this->db->join('kategori k', 'p.id_kategori=k.id_kategori');
        $produk = $this->db->get()->result();
        return $produk;
	}

    public function postpembelian()
    {
        $data = array(
            'id_kategori' => $this->input->post('id_kategori'),
            'nama_produk' => $this->input->post('nama_produk'),
            'harga_produk' => $this->input->post('harga_produk'),
            'berat_produk' => $this->input->post('berat_produk'),
            'foto_produk' => $this->input->post('foto_produk'),
            'deskripsi_produk' => $this->input->post('deskripsi_produk'),
            'stok_produk' => $this->input->post('stok_produk')
        );
        $insert = $this->db->insert('produk', $data);
        return $insert;
    }

    public function updateproduk($id, $data)
    {
        $this->db->where('id_produk', $id);
        $update = $this->db->update('produk', $data);
        return $update;
    }
    public function deleteproduk($id)
    {
        $this->db->where('id_produk', $id);
        $delete = $this->db->delete('produk');
        return $delete;
    }
}

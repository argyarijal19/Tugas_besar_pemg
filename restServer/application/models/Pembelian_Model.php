<?php
class Pembelian_Model extends CI_Model
{
	public function __construct()
	{
		$this->load->database();
	}

	public function getPembelianID($id)
	{
        if ($id) {
            $this->db->where('id_pembelian', $id);
            $this->db->select('p.id_pembelian, p.tanggal_pembelian, p.total_pembelian, p.id_ongkir, p.nama_kota, p.tarif, p.alamat_rumah, p.status_pembelian, p.resi_pengiriman, l.nama_pelanggan');
            $this->db->from('pembelian p');
            $this->db->join('pelanggan l', 'p.id_pelanggan=l.id_pelanggan');
            $pembelian = $this->db->get()->result();
            return $pembelian;
        } else {
            $this->db->select('p.id_pembelian, p.tanggal_pembelian, p.total_pembelian, p.id_ongkir, p.nama_kota, p.tarif, p.alamat_rumah, p.status_pembelian, p.resi_pengiriman, l.nama_pelanggan');
            $this->db->from('pembelian p');
            $this->db->join('pelanggan l', 'p.id_pelanggan=l.id_pelanggan');
            $pembelian = $this->db->get()->result();
            return $pembelian;
        }
	}

	public function getPembelian()
	{
        $this->db->select('p.id_pembelian, p.tanggal_pembelian, p.total_pembelian, p.id_ongkir, p.nama_kota, p.tarif, p.alamat_rumah, p.status_pembelian, p.resi_pengiriman, l.nama_pelanggan');
        $this->db->from('pembelian p');
        $this->db->join('pelanggan l', 'p.id_pelanggan=l.id_pelanggan');
        $pembelian = $this->db->get()->result();
        return $pembelian;
	}

    public function postpembelian()
    {
        $data = array(
            'id_pelanggan' => $this->input->post('id_pelanggan'),
            'tanggal_pembelian' => $this->input->post('tanggal_pembelian'),
            'total_pembelian' => $this->input->post('total_pembelian'),
            'id_ongkir' => $this->input->post('id_ongkir'),
            'nama_kota' => $this->input->post('nama_kota'),
            'tarif' => $this->input->post('tarif'),
            'alamat_rumah' => $this->input->post('alamat_rumah'),
            'status_pembelian' => $this->input->post('status_pembelian'),
            'resi_pengiriman' => $this->input->post('resi_pengiriman')
        );
        $insert = $this->db->insert('pembelian', $data);
        return $insert;
    }

    public function updatepembelian($id, $data)
    {
        $this->db->where('id_pembelian', $id);
        $update = $this->db->update('pembelian', $data);
        return $update;
    }
    public function deletepembelian($id)
    {
        $this->db->where('id_pembelian', $id);
        $delete = $this->db->delete('pembelian');
        return $delete;
    }
}

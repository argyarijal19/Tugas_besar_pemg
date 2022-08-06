<?php
class checkout_model extends CI_Model
{
	public function __construct()
	{
		$this->load->database();
	}

	public function getchekoutID($id)
	{
        if ($id) {
            $this->db->where('p.id_pelanggan', $id);
            $this->db->select('p.id_checkout, p.id_pelanggan, p.tanggal_pembelian, p.total_pembelian, p.id_ongkir, p.alamat_rumah, l.nama_pelanggan, p.status, o.nama_kota, o.tarif');
            $this->db->from('checkout p');
            $this->db->join('pelanggan l', 'p.id_pelanggan=l.id_pelanggan');
            $this->db->join('ongkir o', 'p.id_ongkir=o.id_ongkir');
            $checkout = $this->db->get()->result();
            return $checkout;
        } else {
            $this->db->select('p.id_checkout, p.tanggal_pembelian, p.total_pembelian, p.id_ongkir, p.nama_kota, p.tarif, p.alamat_rumah, p.status_pembelian, p.resi_pengiriman, l.nama_pelanggan');
            $this->db->from('checkout p');
            $this->db->join('pelanggan l', 'p.id_pelanggan=l.id_pelanggan');
            $checkout = $this->db->get()->result();
            return $checkout;
        }
	}

	public function getID($id)
	{
        if ($id) {
            $this->db->where('p.id_checkout', $id);
            $this->db->select('p.id_checkout, p.id_pelanggan, p.tanggal_pembelian, p.total_pembelian, p.id_ongkir, p.alamat_rumah, l.nama_pelanggan, p.status, o.nama_kota, o.tarif');
            $this->db->from('checkout p');
            $this->db->join('pelanggan l', 'p.id_pelanggan=l.id_pelanggan');
            $this->db->join('ongkir o', 'p.id_ongkir=o.id_ongkir');
            $checkout = $this->db->get()->result();
            return $checkout;
        } else {
            $this->db->select('p.id_checkout, p.tanggal_pembelian, p.total_pembelian, p.id_ongkir, p.tarif, p.alamat_rumah, p.status_pembelian, p.resi_pengiriman, l.nama_pelanggan');
            $this->db->from('checkout p');
            $this->db->join('pelanggan l', 'p.id_pelanggan=l.id_pelanggan');
            $checkout = $this->db->get()->result();
            return $checkout;
        }
	}
    public function postcheckout()
    {
        $data = array(
            'id_checkout' => $this->input->post('id_checkout'),
            'id_pelanggan' => $this->input->post('id_pelanggan'),
            'tanggal_pembelian' => $this->input->post('tanggal_pembelian'),
            'total_pembelian' => $this->input->post('total_pembelian'),
            'id_ongkir' => $this->input->post('id_ongkir'),
            'alamat_rumah' => $this->input->post('alamat_rumah'),
            'status' => $this->input->post('status')
        );
        $insert = $this->db->insert('checkout', $data);
        return $insert;
    }

    public function updatecheckout($id, $data)
    {
        $this->db->where('id_checkout', $id);
        $update = $this->db->update('checkout', $data);
        return $update;
    }
}

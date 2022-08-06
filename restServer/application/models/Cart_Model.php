<?php
class Cart_Model extends CI_Model
{
	public function __construct()
	{
		$this->load->database();
	}

	public function getCart($id_pelanggan)
	{
		if ($id_pelanggan) {
            $this->db->where('c.id_pelanggan', $id_pelanggan);            
            $this->db->where('c.status', '');            
            $this->db->select('c.id_pelanggan, c.id_cart, c.id_produk, SUM(c.quantity) as quantity,p.foto_produk, l.nama_pelanggan, p.harga_produk, p.nama_produk, (SUM(c.quantity) * p.harga_produk) as total_harga, status');
            $this->db->from('cart c');
            $this->db->join('pelanggan l', 'l.id_pelanggan=c.id_pelanggan');
            $this->db->join('produk p', 'p.id_produk=c.id_produk');
            $this->db->group_by('c.id_produk');
            $cart = $this->db->get()->result();
            return $cart;
        } else {
            $this->db->select('c.id_pelanggan, c.id_cart, c.id_produk, c.quantity, l.nama_pelanggan, p.harga_produk, p.nama_produk,p.foto_produk, (c.quantity * p.harga_produk) as total_harga');
            $this->db->from('cart c');
            $this->db->join('pelanggan l', 'l.id_pelanggan=c.id_pelanggan');
            $this->db->join('produk p', 'p.id_produk=c.id_produk');
            $cart = $this->db->get()->result();
            return $cart;
        }
	}

	public function getCartStat($id_pelanggan)
	{
		if ($id_pelanggan) {
            $this->db->where('c.id_pelanggan', $id_pelanggan);            
            $this->db->where('c.status', 'checkout');            
            $this->db->select('c.id_pelanggan, c.id_cart, c.id_produk, SUM(c.quantity) as quantity,p.foto_produk, l.nama_pelanggan, p.harga_produk, p.nama_produk, (SUM(c.quantity) * p.harga_produk) as total_harga, status');
            $this->db->from('cart c');
            $this->db->join('pelanggan l', 'l.id_pelanggan=c.id_pelanggan');
            $this->db->join('produk p', 'p.id_produk=c.id_produk');
            $this->db->group_by('c.id_produk');
            $cart = $this->db->get()->result();
            return $cart;
        } else {
            $this->db->select('c.id_pelanggan, c.id_cart, c.id_produk, c.quantity, l.nama_pelanggan, p.harga_produk, p.nama_produk,p.foto_produk, (c.quantity * p.harga_produk) as total_harga');
            $this->db->from('cart c');
            $this->db->join('pelanggan l', 'l.id_pelanggan=c.id_pelanggan');
            $this->db->join('produk p', 'p.id_produk=c.id_produk');
            $cart = $this->db->get()->result();
            return $cart;
        }
	}



    public function postcart()
    {
        $data = array(
            'id_pelanggan' => $this->input->post('id_pelanggan'),
            'id_produk' => $this->input->post('id_produk'),
            'quantity' => $this->input->post('quantity')
        );
        $insert = $this->db->insert('cart', $data);
        return $insert;
    }

    public function updatecart($id, $data)
    {
        $this->db->where('id_pelanggan', $id);
        $update = $this->db->update('cart', $data);
        return $update;
    }

    public function deletecart($id)
    {
        $this->db->where('id_produk', $id);
        $delete = $this->db->delete('cart');
        return $delete;
    }
}
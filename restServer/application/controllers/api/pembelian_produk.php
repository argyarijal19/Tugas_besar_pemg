<?php
defined('BASEPATH') or exit('No direct script access allowed');

require APPPATH . "libraries/Format.php";
require APPPATH . "libraries/RestController.php";

use chriskacerguis\RestServer\RestController;

class Pembelian_Produk extends RESTController
{
    function __construct($config = 'rest')
    {
        parent::__construct($config);
        $this->load->database();
    }
    function index_get()
    {
        $id = $this->get('id_pembelian_produk');
        if ($id == '') {
            $this->db->select('nama, harga, berat, sub_berat, sub_harga, jumlah ');
            $this->db->from('pembelian_produk');
            $pembelian_produk = $this->db->get()->result();
        } else {
            $this->db->where('id_pembelian_produk', $id);
            $this->db->select('nama, harga, berat, sub_berat, sub_harga, jumlah ');
            $this->db->from('pembelian_produk');
            $pembelian_produk = $this->db->get()->result();
        }
        $this->response($pembelian_produk, 200);
    }
    function index_post()
    {
        $data = array(
            'id_produk' => $this->post('id_produk'),
            'id_pembelian' => $this->post('id_pembelian'),
            'idproduk' => $this->post('idproduk'),
            'nama' => $this->post('nama'),
            'harga' => $this->post('harga'),
            'berat' => $this->post('berat'),
            'sub_berat' => $this->post('sub_berat'),
            'sub_harga' => $this->post('sub_harga'),
            'jumlah' => $this->post('jumlah')
        );
        $insert = $this->db->insert('pembelian_produk', $data);
        if ($insert) {
            $this->response($data, 200);
        } else {
            $this->response(array('status' => 'fail', 502));
        }
    }
    function index_put()
    {
        $npm = $this->put('id_transaksi');
        $data = array(
            'id_produk' => $this->put('id_produk'),
            'id_pembelian' => $this->put('id_pembelian'),
            'idproduk' => $this->put('idproduk'),
            'nama' => $this->put('nama'),
            'harga' => $this->put('harga'),
            'berat' => $this->put('berat'),
            'sub_berat' => $this->put('sub_berat'),
            'sub_harga' => $this->put('sub_harga'),
            'jumlah' => $this->put('jumlah')
        );
        $this->db->where('id_pembelian_produk', $npm);
        $update = $this->db->update('pembelian_produk', $data);
        if ($update) {
            if ($this->db->affected_rows() == 1) {
                $this->response(['status' => 'success', 'message' => 'Pembelian Produk Berhasil Update !', 'data' => $data], 200);
            } else {
                $this->response(['status' => 'update failed', 'message' => 'something went wrong!!'], 400);
            }
        } else {
            $this->response(array('status' => 'fail', 502));
        }
    }
    function index_delete()
    {
        $id = $this->delete('id_pembelian_produk');
        $this->db->where('id_pembelian_produk', $id);
        $delete = $this->db->delete('pembelian_produk');
        if ($delete) {
            $this->response(array('status' => true, 'message' => 'Pembelia Produk Berhasil Terhapus !!!'), 202);
        } else {
            $this->response(array('status' => 'fail', 502));
        }
    }
}

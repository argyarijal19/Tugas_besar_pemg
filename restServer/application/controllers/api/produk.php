<?php
defined('BASEPATH') or exit('No direct script access allowed');

require APPPATH . "libraries/Format.php";
require APPPATH . "libraries/RestController.php";

use chriskacerguis\RestServer\RestController;

class Produk extends RESTController
{
    function __construct($config = 'rest')
    {
        parent::__construct($config);
        $this->load->database();
    }
    function index_get()
    {
        $id = $this->get('id_produk');
        if ($id == '') {
            $this->db->select('p.nama_produk, p.harga_produk, p.berat_produk, p.foto_produk, p.deskripsi_produk, p.stok_produk, k.nama_kategori');
            $this->db->from('produk p');
            $this->db->join('kategori k', 'p.id_kategori=k.id_kategori');
            $user = $this->db->get()->result();
        } else {
            $this->db->where('id_produk', $id);
            $user = $this->db->get('produk')->result();
        }
        $this->response($user, 200);
    }
    function index_post()
    {
        $data = array(
            'id_kategori' => $this->post('id_kategori'),
            'nama_produk' => $this->post('nama_produk'),
            'harga_produk' => $this->post('harga_produk'),
            'berat_produk' => $this->post('berat_produk'),
            'foto_produk' => $this->post('foto_produk'),
            'deskripsi_produk' => $this->post('deskripsi_produk'),
            'stok_produk' => $this->post('stok_produk')
        );
        $insert = $this->db->insert('produk', $data);
        if ($insert) {
            $this->response([
                'message' => 'Berhasil Input Produk',
                'data' => $data], 200);
        } else {
            $this->response(array('status' => 'fail', 502));
        }
    }
    function index_put()
    {
        $npm = $this->put('id_produk');
        $data = array(
            'id_kategori' => $this->put('id_kategori'),
            'nama_produk' => $this->put('nama_produk'),
            'harga_produk' => $this->put('harga_produk'),
            'berat_produk' => $this->put('berat_produk'),
            'foto_produk' => $this->put('foto_produk'),
            'deskripsi_produk' => $this->put('deskripsi_produk'),
            'stok_produk' => $this->put('stok_produk')
        );
        $this->db->where('id_produk', $npm);
        $update = $this->db->update('produk', $data);
        if ($update) {
            if ($this->db->affected_rows() == 1) {
                $this->response(['status' => 'success', 'message' => 'Produk UPDATED !', 'data' => $data], 200);
            } else {
                $this->response(['status' => 'update failed', 'message' => 'something went wrong!!'], 400);
            }
        } else {
            $this->response(array('status' => 'fail', 502));
        }
    }
    function index_delete()
    {
        $id = $this->delete('id_produk');
        $this->db->where('id_produk', $id);
        $delete = $this->db->delete('produk');
        if ($delete) {
            $this->response(array('status' => true, 'message' => 'Produk has been DELETED !!!'), 202);
        } else {
            $this->response(array('status' => 'fail', 502));
        }
    }
}

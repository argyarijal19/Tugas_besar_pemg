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
        $this->load->model('Produk_Model');
    }

    function produkid_get()
    {
        $id = $this->get('id_produk');
        $data = $this->Produk_Model->getProdukID($id);
        if($data != null ){
            $this->response([
            'message' => 'SUCCESS !!',
            'data' => $data,
            'status' => 200
            ], 200);
        }else{
            $this->response([
                'message' => 'DATA DOES NOT EXIST !!',
                'data' => $data,
                'status' => 404
            ], 404);
        }
    }

    function index_get()
    {
        $data = $this->Produk_Model->getProduk();
        if($data != null ){
            $this->response([
            'message' => 'SUCCESS !!',
            'data' => $data,
            'status' => 200
            ], 200);
        }else{
            $this->response([
                'message' => 'DATA DOES NOT EXIST !!',
                'data' => $data,
                'status' => 404
            ], 404);
        }
    }
    function index_post()
    {
        
        $insert = $this->Produk_Model->postproduk();
        if ($insert) {
            $this->response([
                'message' => 'Berhasil Input Produk',
                'data' => $insert], 200);
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
        $update = $this->Produk_Model->updateproduk($npm, $data); 
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
        $delete = $this->Produk_Model->deleteproduk($id);
        if ($delete) {
            $this->response(array('status' => true, 'message' => 'Produk has been DELETED !!!'), 202);
        } else {
            $this->response(array('status' => 'fail', 502));
        }
    }
}

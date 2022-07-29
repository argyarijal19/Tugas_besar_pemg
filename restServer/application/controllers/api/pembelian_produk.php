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
        $this->load->model('Pembelianproduk_Model');
    }

    function pembelianprodukID_get()
    {
        $id = $this->get('id_pembelian_produk');
        $data = $this->Pembelianproduk_Model->getPembelianprodukID($id);
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
        $data = $this->Pembelianproduk_Model->getPembelianproduk();
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
        $insert = $this->Pembelianproduk_Model->postpembelianproduk();
        if ($insert) {
            $this->response([
                'status' => 'SUCCESS !!',
                'data' => $insert, 
                'respon_code' => 200], 
                200);
        } else {
            $this->response(array('status' => 'fail', 502));
        }
    }
    function index_put()
    {
        $id = $this->put('id_pembelian_produk');
        $data = array(
            'id_produk' => $this->put('id_produk'),
            'id_pembelian' => $this->put('id_pembelian'),
            'nama' => $this->put('nama'),
            'harga' => $this->put('harga'),
            'berat' => $this->put('berat'),
            'sub_berat' => $this->put('sub_berat'),
            'sub_harga' => $this->put('sub_harga'),
            'jumlah' => $this->put('jumlah')
        );
        $update = $this->Pembelianproduk_Model->updatepembelianproduk($id, $data);
        if ($update) {
            if ($this->db->affected_rows() == 1) {
                $this->response(['status' => 'success', 'message' => 'Pembelian Produk Berhasil Update !', 'data' => $data], 200);
            } else {
                $this->response(['status' => 'update failed', 'message' => 'something went wrong!!, Maybe Yur ID is INVALID'], 400);
            }
        } else {
            $this->response(array('status' => 'fail', 502));
        }
    }
    function index_delete()
    {
        $id = $this->delete('id_pembelian_produk');
        $delete = $this->Pembelianproduk_Model->deletepembelianproduk($id);
        if ($delete) {
            $this->response(array('status' => true, 'message' => 'Pembelia Produk Berhasil Terhapus !!!'), 202);
        } else {
            $this->response(array('status' => 'fail', 502));
        }
    }
}

<?php
defined('BASEPATH') or exit('No direct script access allowed');

require APPPATH . "libraries/Format.php";
require APPPATH . "libraries/RestController.php";

use chriskacerguis\RestServer\RestController;

class Pembelian extends RESTController
{
    function __construct($config = 'rest')
    {
        parent::__construct($config);
        $this->load->model('Pembelian_Model');
    }

    function pembelianid_get()
    {
        $id = $this->get('id_pembelian');
        $data = $this->Pembelian_Model->getPembelianID($id);
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
        $id = $this->get('id_pembelian');
        $data = $this->Pembelian_Model->getPembelian();
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
        
        $insert = $this->Pembelian_Model->postpembelian();
        if ($insert) {
            // $this->response($data, 200);
            $this->response(['status' => 'success', 'message' => 'Pembelian Berhasil Ditambahkan!', 'data' => $insert], 200);
        } else {
            $this->response(array('status' => 'fail', 502));
        }
    }
    function index_put()
    {
        $id = $this->put('id_pembelian');
        $data = array(
            'id_pelanggan' => $this->put('id_pelanggan'),
            'tanggal_pembelian' => $this->put('tanggal_pembelian'),
            'total_pembelian' => $this->put('total_pembelian'),
            'id_ongkir' => $this->put('id_ongkir'),
            'nama_kota' => $this->put('nama_kota'),
            'tarif' => $this->put('tarif'),
            'alamat_rumah' => $this->put('alamat_rumah'),
            'status_pembelian' => $this->put('status_pembelian'),
            'resi_pengiriman' => $this->put('resi_pengiriman')
        );
        $update = $this->Pembelian_Model->updatepembelian($id, $data);
        if ($update) {
            if ($this->db->affected_rows() == 1) {
                $this->response(['status' => 'success', 'message' => 'Pembelian berhasil UPDATE !', 'data' => $data], 200);
            } else {
                $this->response(['status' => 'update failed', 'message' => 'something went wrong!!'], 400);
            }
        } else {
            $this->response(array('status' => 'fail', 502));
        }
    }
    function index_delete()
    {
        $id = $this->delete('id_pembelian');
        $delete = $this->Pembelian_Model->deletepembelian($id);
        if ($delete) {
            $this->response(array('status' => true, 'message' => 'Pembellian Berhasil terhapus !!!'), 202);
        } else {
            $this->response(array('status' => 'fail', 502));
        }
    }
}

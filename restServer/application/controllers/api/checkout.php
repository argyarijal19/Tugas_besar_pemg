<?php
defined('BASEPATH') or exit('No direct script access allowed');

require APPPATH . "libraries/Format.php";
require APPPATH . "libraries/RestController.php";

use chriskacerguis\RestServer\RestController;

class checkout extends RESTController
{
    function __construct($config = 'rest')
    {
        parent::__construct($config);
        $this->load->model('checkout_model');
    }

    function index_get()
    {
        $id = $this->get('id_pelanggan');
        $data = $this->checkout_model->getchekoutID($id);
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
                'status' => 200
            ], 200);
        }
    }

    function ID_get()
    {
        $id = $this->get('id_checkout');
        $data = $this->checkout_model->getID($id);
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
                'status' => 200
            ], 200);
        }
    }

    function index_post()
    {
        
        $insert = $this->checkout_model->postcheckout();
        if ($insert) {
            // $this->response($data, 200);
            $this->response(['status' => 'success', 'message' => 'Pembelian Berhasil Ditambahkan!', 'data' => $insert], 200);
        } else {
            $this->response(array('status' => 'fail', 502));
        }
    }
    function index_put()
    {
        $id = $this->put('id_checkout');
        $data = array(
            'id_pelanggan' => $this->input->put('id_pelanggan'),
            'tanggal_pembelian' => $this->input->put('tanggal_pembelian'),
            'total_pembelian' => $this->input->put('total_pembelian'),
            'id_ongkir' => $this->input->put('id_ongkir'),
            'alamat_rumah' => $this->input->put('alamat_rumah')
        );
        $update = $this->checkout_model->updatecheckout($id, $data);
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
}

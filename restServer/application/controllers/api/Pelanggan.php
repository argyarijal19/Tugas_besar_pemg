<?php
defined('BASEPATH') or exit('No direct script access allowed');

require APPPATH . "libraries/Format.php";
require APPPATH . "libraries/RestController.php";

use chriskacerguis\RestServer\RestController;

class Pelanggan extends RESTController
{
    function __construct($config = 'rest')
    {
        parent::__construct($config);
        $this->load->model('Pelanggan_Model');
    }
    function pelangganID_get()
    {
        $id = $this->get('id_pelanggan');
        $data = $this->Pelanggan_Model->getPelangganID($id);
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
        $id = $this->get('id_pelanggan');
        $data = $this->Pelanggan_Model->getPelanggan();
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
        $insert = $this->Pelanggan_Model->postpelanggan();
        if ($insert) {
            // $this->response($data, 200);
            $this->response(['status' => 'success', 'message' => 'Pelanggan Berhasil Di Tambahkan !', 'data' => $insert], 200);
        } else {
            $this->response(array('status' => 'fail', 502));
        }
    }
    function index_put()
    {
        $id = $this->put('id_pelanggan');
        $data = array(
            'email_pelanggan' => $this->put('email_pelanggan'),
            'password_pelanggan' => $this->put('password_pelanggan'),
            'nama_pelanggan' => $this->put('nama_pelanggan'),
            'telepon_pelanggan' => $this->put('telepon_pelanggan')
        );
        $update = $this->Pelanggan_Model->updatepelanggan($id, $data);
        if ($update) {
            if ($this->db->affected_rows() == 1) {
                $this->response(['status' => 'success', 'message' => 'pelanggan UPDATED !', 'data' => $update], 200);
            } else {
                $this->response(['status' => 'update failed', 'message' => 'something went wrong!!'], 400);
            }
        } else {
            $this->response(array('status' => 'fail', 502));
        }
    }
    function index_delete()
    {
        $id = $this->delete('id_pelanggan');
        $delete = $this->Pelanggan_Model->deletepelanggan($id);
        if ($delete) {
            $this->response(array('status' => true, 'message' => 'pelanggan has been DELETED !!!'), 202);
        } else {
            $this->response(array('status' => 'fail', 502));
        }
    }
}

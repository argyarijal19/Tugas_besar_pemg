<?php
defined('BASEPATH') or exit('No direct script access allowed');

require APPPATH . "libraries/Format.php";
require APPPATH . "libraries/RestController.php";

use chriskacerguis\RestServer\RestController;

class Kategori extends RESTController
{
    function __construct($config = 'rest')
    {
        parent::__construct($config);
        $this->load->model('Kategori_Model');
    }
    function kategoriID_get()
    {
        $id = $this->get('id_kategori');
        $data = $this->Kategori_Model->getKategoriID($id);
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
        $id = $this->get('id_kategori');
        $data = $this->Kategori_Model->getKategori();
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
        $insert = $this->Kategori_Model->postkategori();
        if ($insert) {
            // $this->response($data, 200);
            $this->response(['status' => 'success', 'message' => 'kategor Berhasil Di Tambahkan !', 'data' => $insert], 200);
        } else {
            $this->response(array('status' => 'fail', 502));
        }
    }
    function index_put()
    {
        $id = $this->put('id_kategori');
        $data = array(
            'nama_kategori' => $this->put('nama_kategori')
        );
        $update = $this->Kategori_Model->updatekategori($id, $data);
        if ($update) {
            if ($this->db->affected_rows() == 1) {
                $this->response(['status' => 'success', 'message' => 'kategori UPDATED !', 'data' => $data], 200);
            } else {
                $this->response(['status' => 'update failed', 'message' => 'something went wrong!!'], 400);
            }
        } else {
            $this->response(array('status' => 'fail', 502));
        }
    }
    function index_delete()
    {
        $id = $this->delete('id_kategori');
        $delete = $this->Kategori_Model->deletekategori($id);
        if ($delete) {
            $this->response(array('status' => true, 'message' => 'kategori has been DELETED !!!'), 202);
        } else {
            $this->response(array('status' => 'fail', 502));
        }
    }
}

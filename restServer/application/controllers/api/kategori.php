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
        $id_kategori = $this->put('id_kategori');
        $data = array(
            'nama_kategori' => $this->put('nama_kategori'),

        );

        //Jika field id_kategori tidak diisi
        if ($id_kategori == NULL) {
            $this->response(
                [
                    'status' => $id_kategori,
                    'response_code' => RestController::HTTP_BAD_REQUEST,
                    'message' => 'id_kategori Tidak Boleh Kosong',
                ],
                RestController::HTTP_BAD_REQUEST
            );
        //Jika data berhasil berubah
        } elseif ($this->Kategori_Model->updatekategori($data, $id_kategori) > 0) {
            $this->response(
                [
                    'status' => true,
                    'response_code' => RestController::HTTP_CREATED,
                    'message' => 'Data Makanan Dengan id_kategori '.$id_kategori.' Berhasil Diubah',
                ],
                RestController::HTTP_CREATED
            );
        } else {
            $this->response(
                [
                    'status' => false,
                    'response_code' => RestController::HTTP_BAD_REQUEST,
                    'message' => 'Gagal Mengubah Data',
                ],
                RestController::HTTP_BAD_REQUEST
            );
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

<?php
defined('BASEPATH') or exit('No direct script access allowed');

require APPPATH . "libraries/Format.php";
require APPPATH . "libraries/RestController.php";

use chriskacerguis\RestServer\RestController;

class ongkir extends RESTController
{
    function __construct($config = 'rest')
    {
        parent::__construct($config);
        $this->load->model('ongkir_model');
    }
    function ongkirID_get()
    {
        $id = $this->get('id_ongkir');
        $data = $this->ongkir_model->getongkirid($id);
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
        $id = $this->get('id_ongkir');
        $data = $this->ongkir_model->getongkir();
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
        $insert = $this->ongkir_model->postongkir();
        if ($insert) {
            // $this->response($data, 200);
            $this->response(['status' => 'success', 'message' => 'kategor Berhasil Di Tambahkan !', 'data' => $insert], 200);
        } else {
            $this->response(array('status' => 'fail', 502));
        }
    }
    function index_put()
    {
        $id_ongkir = $this->put('id_ongkir');
        $data = array(
            'nama_kota' => $this->put('nama_kota'),
            'tarif' => $this->put('tarif')

        );

        //Jika field id_ongkir tidak diisi
        if ($id_ongkir == NULL) {
            $this->response(
                [
                    'status' => $id_ongkir,
                    'response_code' => RestController::HTTP_BAD_REQUEST,
                    'message' => 'id_ongkir Tidak Boleh Kosong',
                ],
                RestController::HTTP_BAD_REQUEST
            );
        //Jika data berhasil berubah
        } elseif ($this->ongkir_model->updateongkir($data, $id_ongkir) > 0) {
            $this->response(
                [
                    'status' => true,
                    'response_code' => RestController::HTTP_CREATED,
                    'message' => 'Data Makanan Dengan id_ongkir '.$id_ongkir.' Berhasil Diubah',
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
        $id = $this->delete('id_ongkir');
        $delete = $this->ongkir_model->deleteongkir($id);
        if ($delete) {
            $this->response(array('status' => true, 'message' => 'kategori has been DELETED !!!'), 202);
        } else {
            $this->response(array('status' => 'fail', 502));
        }
    }
}

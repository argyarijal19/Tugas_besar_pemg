<?php
defined('BASEPATH') or exit('No direct script access allowed');

require APPPATH . "libraries/Format.php";
require APPPATH . "libraries/RestController.php";

use chriskacerguis\RestServer\RestController;

class Cart extends RESTController
{
    function __construct($config = 'rest')
    {
        parent::__construct($config);
        $this->load->model('Cart_Model');
    }

    function index_get()
    {
        $id = $this->get('id_pelanggan');
        $data = $this->Cart_Model->getCart($id);
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

    function checkoutStat_get()
    {
        $id = $this->get('id_pelanggan');
        $data = $this->Cart_Model->getCartStat($id);
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
        $insert = $this->Cart_Model->postcart();
        if ($insert) {
            // $this->response($data, 200);
            $this->response(['status' => 'success', 'message' => 'Cart Berhasil Di Tambahkan !', 'data' => $insert], 200);
        } else {
            $this->response(array('status' => 'fail', 502));
        }
    }

    function index_put()
    {
        $id = $this->put('id_pelanggan');
        $data = array(
            'status' => $this->put('status'),
        );
        $update = $this->Cart_Model->updatecart($id, $data);
        if ($update) {
            if ($this->db->affected_rows() == 1) {
                $this->response(['status' => 'success', 'message' => 'cart UPDATED !', 'data' => $update], 200);
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
        $delete = $this->Cart_Model->deletecart($id);
        if ($delete) {
            $this->response(array('status' => true, 'message' => 'Cart has been DELETED !!!'), 202);
        } else {
            $this->response(array('status' => 'fail', 502));
        }
    }
}
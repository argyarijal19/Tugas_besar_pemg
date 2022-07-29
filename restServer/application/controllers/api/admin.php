<?php
defined('BASEPATH') or exit('No direct script access allowed');

require APPPATH . "libraries/Format.php";
require APPPATH . "libraries/RestController.php";

use chriskacerguis\RestServer\RestController;

class Admin extends RESTController
{
    function __construct($config = 'rest')
    {
        parent::__construct($config);
        $this->load->model('Admin_Model');
    }
    function adminID_get()
    {
        $id = $this->get('id_admin');
        $data = $this->Admin_Model->getAdminID($id);
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
        $id = $this->get('id_admin');
        $data = $this->Admin_Model->getAdmin();
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
        $insert = $this->Admin_Model->postadmin();
        if ($insert) {
            // $this->response($data, 200);
            $this->response(['status' => 'success', 'message' => 'Admin Berhasil Di Tambahkan !', 'data' => $insert], 200);
        } else {
            $this->response(array('status' => 'fail', 502));
        }
    }
    function index_put()
    {
        $id = $this->put('id_admin');
        $data = array(
            'username' => $this->put('username'),
            'password' => $this->put('password'),
            'nama_lengkap' => $this->put('nama_lengkap'),
            'foto_profil' => $this->put('foto_profil')
        );
        $update = $this->Admin_Model->updateadmin($id, $data);
        if ($update) {
            if ($this->db->affected_rows() == 1) {
                $this->response(['status' => 'success', 'message' => 'admin UPDATED !', 'data' => $data], 200);
            } else {
                $this->response(['status' => 'update failed', 'message' => 'something went wrong!!, Maybe Your ID Is INVALID'], 400);
            }
        } else {
            $this->response(array('status' => 'fail', 502));
        }
    }
    function index_delete()
    {
        $id = $this->delete('id_admin');
        $delete = $this->Admin_Model->deleteadmin($id);
        if ($delete) {
            $this->response(array('status' => true, 'message' => 'admin has been DELETED !!!'), 202);
        } else {
            $this->response(array('status' => 'fail', 502));
        }
    }
}

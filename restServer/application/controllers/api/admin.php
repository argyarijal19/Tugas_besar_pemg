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
        $this->load->database();
    }
    function index_get()
    {
        $id = $this->get('id_admin');
        if ($id == '') {
            $this->db->select('id_admin, username, password, nama_lengkap, foto_profil');
            $this->db->from('admin');
            $pelanggan = $this->db->get()->result();
        } else {
            $this->db->where('id_admin', $id);            
            $this->db->from('admin');
            $pelanggan = $this->db->get()->result();
        }
        $this->response($pelanggan, 200);
    }
    function index_post()
    {
        $data = array(
            'username' => $this->post('username'),
            'password' => $this->post('password'),
            'nama_lengkap' => $this->post('nama_lengkap'),
            'foto_profil' => $this->post('foto_profil')
        );
        $insert = $this->db->insert('admin', $data);
        if ($insert) {
            // $this->response($data, 200);
            $this->response(['status' => 'success', 'message' => 'kategor Berhasil Di Tambahkan !', 'data' => $data], 200);
        } else {
            $this->response(array('status' => 'fail', 502));
        }
    }
    function index_put()
    {
        $npm = $this->put('id_admin');
        $data = array(
            'username' => $this->put('username'),
            'password' => $this->put('password'),
            'nama_lengkap' => $this->put('nama_lengkap'),
            'foto_profil' => $this->put('foto_profil')
        );
        $this->db->where('id_admin', $npm);
        $update = $this->db->update('admin', $data);
        if ($update) {
            if ($this->db->affected_rows() == 1) {
                $this->response(['status' => 'success', 'message' => 'admin UPDATED !', 'data' => $data], 200);
            } else {
                $this->response(['status' => 'update failed', 'message' => 'something went wrong!!'], 400);
            }
        } else {
            $this->response(array('status' => 'fail', 502));
        }
    }
    function index_delete()
    {
        $id = $this->delete('id_admin');
        $this->db->where('id_admin', $id);
        $delete = $this->db->delete('admin');
        if ($delete) {
            $this->response(array('status' => true, 'message' => 'admin has been DELETED !!!'), 202);
        } else {
            $this->response(array('status' => 'fail', 502));
        }
    }
}

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
        $this->load->database();
    }
    function index_get()
    {
        $id = $this->get('id_pelanggan');
        if ($id == '') {
            $this->db->select('email_pelanggan, password_pelanggan, nama_pelanggan, telepon_pelanggan');
            $this->db->from('pelanggan');
            $pelanggan = $this->db->get()->result();
        } else {
            $this->db->where('id_pelanggan', $id);
            $pelanggan = $this->db->get()->result();
        }
        $this->response($pelanggan, 200);
    }
    function index_post()
    {
        $data = array(
            'email_pelanggan' => $this->post('email_pelanggan'),
            'password_pelanggan' => $this->post('password_pelanggan'),
            'nama_pelanggan' => $this->post('nama_pelanggan'),
            'telepon_pelanggan' => $this->post('telepon_pelanggan')
        );
        $insert = $this->db->insert('pelanggan', $data);
        if ($insert) {
            // $this->response($data, 200);
            $this->response(['status' => 'success', 'message' => 'Pelanggan Berhasil Di Tambahkan !', 'data' => $data], 200);
        } else {
            $this->response(array('status' => 'fail', 502));
        }
    }
    function index_put()
    {
        $npm = $this->put('id_pelanggan');
        $data = array(
            'email_pelanggan' => $this->put('email_pelanggan'),
            'password_pelanggan' => $this->put('password_pelanggan'),
            'nama_pelanggan' => $this->put('nama_pelanggan'),
            'telepon_pelanggan' => $this->put('telepon_pelanggan')
        );
        $this->db->where('id_pelanggan', $npm);
        $update = $this->db->update('pelanggan', $data);
        if ($update) {
            if ($this->db->affected_rows() == 1) {
                $this->response(['status' => 'success', 'message' => 'pelanggan UPDATED !', 'data' => $data], 200);
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
        $this->db->where('id_pelanggan', $id);
        $delete = $this->db->delete('pelanggan');
        if ($delete) {
            $this->response(array('status' => true, 'message' => 'pelanggan has been DELETED !!!'), 202);
        } else {
            $this->response(array('status' => 'fail', 502));
        }
    }
}

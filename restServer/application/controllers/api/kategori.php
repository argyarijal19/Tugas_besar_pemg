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
        $this->load->database();
    }
    function index_get()
    {
        $id = $this->get('id_kategori');
        if ($id == '') {
            $this->db->select('id_kategori, nama_kategori');
            $this->db->from('kategori');
            $pelanggan = $this->db->get()->result();
        } else {
            $this->db->where('id_kategori', $id);            
            $this->db->from('kategori');
            $pelanggan = $this->db->get()->result();
        }
        $this->response($pelanggan, 200);
    }
    function index_post()
    {
        $data = array(
            'nama_kategori' => $this->post('nama_kategori')
        );
        $insert = $this->db->insert('kategori', $data);
        if ($insert) {
            // $this->response($data, 200);
            $this->response(['status' => 'success', 'message' => 'kategor Berhasil Di Tambahkan !', 'data' => $data], 200);
        } else {
            $this->response(array('status' => 'fail', 502));
        }
    }
    function index_put()
    {
        $npm = $this->put('id_kategori');
        $data = array(
            'nama_kategori' => $this->put('nama_kategori')
        );
        $this->db->where('id_kategori', $npm);
        $update = $this->db->update('kategori', $data);
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
        $this->db->where('id_kategori', $id);
        $delete = $this->db->delete('kategori');
        if ($delete) {
            $this->response(array('status' => true, 'message' => 'kategori has been DELETED !!!'), 202);
        } else {
            $this->response(array('status' => 'fail', 502));
        }
    }
}

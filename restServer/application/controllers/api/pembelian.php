<?php
defined('BASEPATH') or exit('No direct script access allowed');

require APPPATH . "libraries/Format.php";
require APPPATH . "libraries/RestController.php";

use chriskacerguis\RestServer\RestController;

class Pembelian extends RESTController
{
    function __construct($config = 'rest')
    {
        parent::__construct($config);
        $this->load->database();
    }
    function index_get()
    {
        $id = $this->get('id_pembelian');
        if ($id == '') {
            $this->db->select('p.tanggal_pembelian, p.total_pembelian, p.id_ongkir, p.nama_kota, p.tarif, p.alamat_rumah, p.status_pembelian, p.resi_pengiriman, l.nama_pelanggan');
            $this->db->from('pembelian p');
            $this->db->join('pelanggan l', 'p.id_pelanggan=l.id_pelanggan');
            $pembelian = $this->db->get()->result();
        } else {
            $this->db->where('id_pembelian', $id);
            $this->db->select('p.tanggal_pembelian, p.total_pembelian, p.id_ongkir, p.nama_kota, p.tarif, p.alamat_rumah, p.status_pembelian, p.resi_pengiriman, l.nama_pelanggan');
            $this->db->from('pembelian p');
            $this->db->join('pelanggan l', 'p.id_pelanggan=l.id_pelanggan');
            $pembelian = $this->db->get()->result();
        }
        $this->response($pembelian, 200);
    }
    function index_post()
    {
        $data = array(
            'id_pelanggan' => $this->post('id_pelanggan'),
            'tanggal_pembelian' => $this->post('tanggal_pembelian'),
            'total_pembelian' => $this->post('total_pembelian'),
            'id_ongkir' => $this->post('id_ongkir'),
            'nama_kota' => $this->post('nama_kota'),
            'tarif' => $this->post('tarif'),
            'alamat_rumah' => $this->post('alamat_rumah'),
            'status_pembelian' => $this->post('status_pembelian'),
            'resi_pengiriman' => $this->post('resi_pengiriman')
        );
        $insert = $this->db->insert('pembelian', $data);
        if ($insert) {
            // $this->response($data, 200);
            $this->response(['status' => 'success', 'message' => 'Pembelian Berhasil Ditambahkan!', 'data' => $data], 200);
        } else {
            $this->response(array('status' => 'fail', 502));
        }
    }
    function index_put()
    {
        $npm = $this->put('id_pembelian');
        $data = array(
            'id_pelanggan' => $this->put('id_pelanggan'),
            'tanggal_pembelian' => $this->put('tanggal_pembelian'),
            'total_pembelian' => $this->put('total_pembelian'),
            'id_ongkir' => $this->put('id_ongkir'),
            'nama_kota' => $this->put('nama_kota'),
            'tarif' => $this->put('tarif'),
            'alamat_rumah' => $this->put('alamat_rumah'),
            'status_pembelian' => $this->put('status_pembelian'),
            'resi_pengiriman' => $this->put('resi_pengiriman')
        );
        $this->db->where('id_pembelian', $npm);
        $update = $this->db->update('pembelian', $data);
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
    function index_delete()
    {
        $id = $this->delete('id_pembelian');
        $this->db->where('id_pembelian', $id);
        $delete = $this->db->delete('pembelian');
        if ($delete) {
            $this->response(array('status' => true, 'message' => 'Pembellian Berhasil terhapus !!!'), 202);
        } else {
            $this->response(array('status' => 'fail', 502));
        }
    }
}

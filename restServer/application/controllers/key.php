<?php
class Key extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('login_model');
        $this->load->model('Crud_model');
        $this->load->helper('url', 'form', 'string');
        $this->load->library(array('form_validation', 'session'));
        // if ($this->session->has_userdata('level'))
        // { 
        //     redirect($this->session->userdata('level'),'refresh');
        // }
    }

    function index()
    {
        $this->load->view('key');
    }
}

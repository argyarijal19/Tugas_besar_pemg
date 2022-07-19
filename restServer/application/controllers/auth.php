<?php
class Auth extends CI_Controller
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
        $this->load->view('login');
    }

    function login()
    {
        $username = htmlspecialchars($this->input->post('username', TRUE), ENT_QUOTES);
        $password = htmlspecialchars($this->input->post('password', TRUE), ENT_QUOTES);

        $user = $this->login_model->get_data($username, $password, 'user');
        if ($user->num_rows() == 1) {
            foreach ($user->result() as $data) {
                $user_data = array(
                    'username' => $data->username,
                    'id_user' => $data->id_user
                );
                $this->session->set_userdata($user_data);
            }
            redirect('key');
        } else {
            $text = 'Username dan Password Salah';
            echo $this->session->set_flashdata('msg', $text);
            redirect('auth');
        }
    }
    function logout()
    {
        $_SESSION = array();
        session_destroy();
        redirect('auth');
    }
    public function register()
    {
        $data['title'] = 'Sign Up';

        $this->form_validation->set_rules('username', 'username', 'required');
        $this->form_validation->set_rules('password', 'Password', 'required');
        $this->form_validation->set_rules('password2', 'Confirm Password', 'matches[password]');

        if ($this->form_validation->run() === FALSE) {
            $this->load->view('login', $data);
        } else {
            // Encrypt password
            $enc_password = $this->input->post('password');

            $this->login_model->register($enc_password);

            // Set message
            $this->session->set_flashdata('user_registered', 'You are now registered and can log in');

            $this->load->view('login');
        }
    }
    public function generateKey()
    {
        /*load registration view form*/
        $this->load->view('key');

        /*Check submit button */
        if ($this->input->post('submit')) {
            $data['user_id'] = $this->session->userdata('id_user');
            $data['key'] = random_string('alnum', 10);
            $data['level'] = 1;
            $this->db->where('user_id', $data['user_id']);
            $query = $this->db->get('keys');
            $count_row = $query->num_rows();
            if ($count_row > 0) {
            } else {
                $response = $this->Crud_model->saverecords($data);
                if ($response == true) {
                    header("Refresh:0");
                } else {
                    echo "Insert error !";
                }
            }
        }
    }
}

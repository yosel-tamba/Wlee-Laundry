<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Error_404 extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('m_crud');
        $this->load->model('m_data');

        if ($this->session->userdata('status') != "telah_login") {
            $this->session->set_flashdata('belumLogin', 'Belum Login');
            redirect(base_url());
        }
    }
    public function index()
    {
        $data = array(
            'judul' => "Error"
        );
        $this->load->view('template/header', $data);
        $this->load->view('error_404', $data);
        $this->load->view('template/footer');
    }
}

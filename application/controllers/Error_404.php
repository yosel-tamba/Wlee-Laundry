<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Error_404 extends CI_Controller
{
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

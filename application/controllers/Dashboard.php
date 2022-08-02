<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Dashboard extends CI_Controller
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
            'judul' => "Dashboard"
        );
        $data['pengguna'] = $this->m_crud->get_data('id_user', 'tb_user')->num_rows();
        $data['paket'] = $this->m_crud->get_data('id_paket', 'tb_paket')->num_rows();
        $data['member'] = $this->m_crud->get_data('id_member', 'tb_member')->num_rows();
        $data['outlet'] = $this->m_crud->get_data('id_outlet', 'tb_outlet')->num_rows();
        $data['transaksi'] = $this->m_data->dashboard()->num_rows();
        $data['data_transaksi'] = $this->m_data->get_transaksi_diambil()->result();
        $this->load->view('template/header', $data);
        $this->load->view('dashboard', $data);
        $this->load->view('template/footer');
    }
}

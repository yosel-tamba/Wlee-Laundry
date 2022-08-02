<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Filter extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('m_crud');
        $this->load->model('m_filter');

        if ($this->session->userdata('status') != "telah_login") {
            $this->session->set_flashdata('belumLogin', 'Belum Login');
            redirect(base_url());
        }
    }

    public function pelanggan($jenis_kelamin)
    {
        $data = array(
            'judul' => "Pelanggan",
            'jenis_kelamin' => $jenis_kelamin
        );
        if ($jenis_kelamin == "Semua") {
            $data['member'] = $this->m_crud->get_data('id_member', 'tb_member')->result();
        } else {
            $data['member'] = $this->m_filter->pelanggan($jenis_kelamin)->result();
        }
        $this->load->view('template/header', $data);
        $this->load->view('filter/pelanggan', $data);
        $this->load->view('template/footer');
    }

    public function pengguna($role)
    {
        $data = array(
            'judul' => "Pengguna",
            'role' => $role
        );
        if ($role == "Semua") {
            $data['user'] = $this->m_crud->get_data('id_user', 'tb_user')->result();
        } else {
            $data['user'] = $this->m_filter->pengguna($role)->result();
        }
        $data['outlet'] = $this->m_crud->get_data('id_outlet', 'tb_outlet')->result();

        $this->load->view('template/header', $data);
        $this->load->view('filter/pengguna', $data, $role);
        $this->load->view('template/footer');
    }

    public function paket($jenis)
    {
        $data = array(
            'judul' => "Paket Cucian",
            'jenis' => $jenis
        );
        if ($jenis == "Semua") {
            $data['paket'] = $this->m_crud->get_data('id_paket', 'tb_paket')->result();
        } else {
            $data['paket'] = $this->m_filter->paket($jenis)->result();
        }
        $data['outlet'] = $this->m_crud->get_data('id_outlet', 'tb_outlet')->result();
        $this->load->view('template/header', $data);
        $this->load->view('filter/paket', $data, $jenis);
        $this->load->view('template/footer');
    }

    public function aksi_filter_transaksi()
    {
        $dari = $this->input->post('dari');
        $sampai = $this->input->post('sampai');
        redirect(base_url('filter/transaksi/' . $dari . '/' . $sampai));
    }

    public function transaksi($dari, $sampai)
    {
        $data = array(
            'judul' => "Transaksi",
            'dari' => $dari,
            'sampai' => $sampai
        );

        $data['pengguna'] = $this->m_crud->get_data('id_user', 'tb_user')->result();
        $data['paket'] = $this->m_crud->get_data('id_paket', 'tb_paket')->result();
        $data['member'] = $this->m_crud->get_data('id_member', 'tb_member')->result();
        $data['outlet'] = $this->m_crud->get_data('id_outlet', 'tb_outlet')->result();
        $data['transaksi'] = $this->m_filter->transaksi($dari, $sampai)->result();
        $this->load->view('template/header', $data);
        $this->load->view('filter/transaksi', $data, $dari, $sampai);
        $this->load->view('transaksi/detail', $data);
        $this->load->view('template/footer');
    }
}

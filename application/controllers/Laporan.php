<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Laporan extends CI_Controller
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
        $this->load->library('pdfgenerator');
        $data['title_pdf'] = 'Laporan Pelanggan';
        $file_pdf = 'laporan_pelanggan_';
        $paper = 'A4';
        $orientation = "portrait";
        if ($jenis_kelamin == "Semua") {
            $data['member'] = $this->m_crud->get_data('id_member', 'tb_member')->result();
        } else {
            $data['member'] = $this->m_filter->pelanggan($jenis_kelamin)->result();
        }
        $html = $this->load->view('laporan/member', $data, true);
        $this->pdfgenerator->generate($html, $file_pdf, $paper, $orientation);
    }

    public function outlet()
    {
        $this->load->library('pdfgenerator');
        $data['title_pdf'] = 'Laporan Outlet';
        $file_pdf = 'laporan_outlet_';
        $paper = 'A4';
        $orientation = "portrait";
        $data['outlet'] = $this->m_crud->get_data('id_outlet', 'tb_outlet')->result();
        $html = $this->load->view('laporan/outlet', $data, true);
        $this->pdfgenerator->generate($html, $file_pdf, $paper, $orientation);
    }

    public function pengguna($role)
    {
        $this->load->library('pdfgenerator');
        $data['title_pdf'] = 'Laporan Pengguna';
        $file_pdf = 'laporan_pengguna_';
        $paper = 'A4';
        $orientation = "portrait";
        if ($role == "Semua") {
            $data['user'] = $this->m_crud->get_data('id_user', 'tb_user')->result();
        } else {
            $data['user'] = $this->m_filter->pengguna($role)->result();
        }
        $data['outlet'] = $this->m_crud->get_data('id_outlet', 'tb_outlet')->result();
        $html = $this->load->view('laporan/user', $data, true);
        $this->pdfgenerator->generate($html, $file_pdf, $paper, $orientation);
    }

    public function paket($jenis)
    {
        $this->load->library('pdfgenerator');
        $data['title_pdf'] = 'Laporan Paket';
        $file_pdf = 'laporan_paket';
        $paper = 'A4';
        $orientation = "portrait";
        if ($jenis == "Semua") {
            $data['paket'] = $this->m_crud->get_data('id_paket', 'tb_paket')->result();
        } else {
            $data['paket'] = $this->m_filter->paket($jenis)->result();
        }
        $data['outlet'] = $this->m_crud->get_data('id_outlet', 'tb_outlet')->result();
        $html = $this->load->view('laporan/paket', $data, true);
        $this->pdfgenerator->generate($html, $file_pdf, $paper, $orientation);
    }

    public function transaksi($dari, $sampai)
    {
        $this->load->library('pdfgenerator');
        $data['title_pdf'] = 'Laporan Transaksi';
        $file_pdf = 'laporan_transaksi';
        $paper = 'A4';
        $orientation = "portrait";
        $data['transaksi'] = $this->m_filter->transaksi($dari, $sampai)->result();
        $html = $this->load->view('laporan/transaksi', $data, true);
        $this->pdfgenerator->generate($html, $file_pdf, $paper, $orientation);
    }
}

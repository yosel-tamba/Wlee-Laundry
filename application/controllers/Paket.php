<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Paket extends CI_Controller
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
    public function index()
    {
        $data = array(
            'judul' => "Paket Cucian"
        );
        $data['paket'] = $this->m_crud->get_data('id_paket', 'tb_paket')->result();
        $data['outlet'] = $this->m_crud->get_data('id_outlet', 'tb_outlet')->result();
        $this->load->view('template/header', $data);
        $this->load->view('paket', $data);
        $this->load->view('template/footer');
    }

    public function aksi_tambah()
    {
        $this->form_validation->set_rules('nama_paket', 'Nama', 'required');
        $this->form_validation->set_rules('harga', 'Harga', 'required|numeric|integer');
        $this->form_validation->set_rules('id_outlet', 'Outlet', 'required');
        $this->form_validation->set_rules('jenis', 'Jenis Paket', 'required');
        if ($this->form_validation->run() != false) {
            $data = array(
                'id_outlet' => $this->input->post('id_outlet'),
                'nama_paket' => $this->input->post('nama_paket'),
                'harga' => $this->input->post('harga'),
                'jenis' => $this->input->post('jenis')
            );
            $this->m_crud->insert_data($data, 'tb_paket');
            $this->session->set_flashdata('paket', 'Ditambahkan');
            redirect(base_url('paket'));
        } else {
            $data = array(
                'judul' => "Paket Cucian"
            );
            $data['paket'] = $this->m_crud->get_data('id_paket', 'tb_paket')->result();
            $data['outlet'] = $this->m_crud->get_data('id_outlet', 'tb_outlet')->result();
            $this->session->set_flashdata('gagal_simpan', 'Paket');
            $this->load->view('template/header', $data);
            $this->load->view('paket', $data);
            $this->load->view('template/footer');
        }
    }

    public function aksi_ubah()
    {
        $this->form_validation->set_rules('nama_paket', 'Nama', 'required');
        $this->form_validation->set_rules('harga', 'Harga', 'required|numeric|integer');
        $this->form_validation->set_rules('id_outlet', 'Outlet', 'required');
        $this->form_validation->set_rules('jenis', 'Jenis Paket', 'required');
        if ($this->form_validation->run() != false) {
            $where = array(
                'id_paket' => $this->input->post('id_paket')
            );
            $data = array(
                'id_outlet' => $this->input->post('id_outlet'),
                'nama_paket' => $this->input->post('nama_paket'),
                'harga' => $this->input->post('harga'),
                'jenis' => $this->input->post('jenis')
            );
            $this->m_crud->update_data($where, $data, 'tb_paket');
            $this->session->set_flashdata('paket', 'Diubah');
            redirect(base_url('paket'));
        } else {
            $data = array(
                'judul' => "Paket Cucian"
            );
            $data['paket'] = $this->m_crud->get_data('id_paket', 'tb_paket')->result();
            $data['outlet'] = $this->m_crud->get_data('id_outlet', 'tb_outlet')->result();
            $this->session->set_flashdata('gagal_simpan', 'Paket');
            $this->load->view('template/header', $data);
            $this->load->view('paket', $data);
            $this->load->view('template/footer');
        }
    }

    public function hapus($id_paket)
    {
        $where = array(
            'id_paket' => $id_paket
        );
        $this->m_crud->delete_data($where, 'tb_paket');
        $this->session->set_flashdata('paket', 'Dihapus');
        redirect(base_url('paket'));
    }
}

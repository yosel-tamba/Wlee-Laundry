<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Outlet extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('m_crud');

        if ($this->session->userdata('status') != "telah_login") {
            $this->session->set_flashdata('belumLogin', 'Belum Login');
            redirect(base_url());
        }
    }
    public function index()
    {
        $data = array(
            'judul' => "Outlet"
        );
        $data['outlet'] = $this->m_crud->get_data('id_outlet', 'tb_outlet')->result();
        $this->load->view('template/header', $data);
        $this->load->view('outlet', $data);
        $this->load->view('template/footer');
    }

    public function aksi_tambah()
    {
        $data = array(
            'nama' => $this->input->post('nama'),
            'alamat' => $this->input->post('alamat'),
            'tlp' => $this->input->post('tlp')
        );
        $this->m_crud->insert_data($data, 'tb_outlet');
        $this->session->set_flashdata('outlet', 'Ditambahkan');
        redirect($_SERVER['HTTP_REFERER']);
    }

    public function aksi_ubah()
    {
        $where = array(
            'id_outlet' => $this->input->post('id_outlet')
        );
        $data = array(
            'nama' => $this->input->post('nama'),
            'alamat' => $this->input->post('alamat'),
            'tlp' => $this->input->post('tlp')
        );
        $this->m_crud->update_data($where, $data, 'tb_outlet');
        $this->session->set_flashdata('outlet', 'Diubah');
        redirect($_SERVER['HTTP_REFERER']);
    }

    public function hapus($id_outlet)
    {
        $where = array(
            'id_outlet' => $id_outlet
        );
        $this->m_crud->delete_data($where, 'tb_outlet');
        $this->session->set_flashdata('outlet', 'Dihapus');
        redirect(base_url() . 'outlet');
    }
}

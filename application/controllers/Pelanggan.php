<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Pelanggan extends CI_Controller
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
            'judul' => "Pelanggan"
        );
        $data['member'] = $this->m_crud->get_data('id_member', 'tb_member')->result();
        $this->load->view('template/header', $data);
        $this->load->view('pelanggan', $data);
        $this->load->view('template/footer');
    }

    public function aksi_tambah()
    {
        $this->form_validation->set_rules('nama_member', 'Nama', 'required');
        $this->form_validation->set_rules('alamat', 'Alamat', 'required');
        $this->form_validation->set_rules('jenis_kelamin', 'Jenis Kelamin', 'required');
        $this->form_validation->set_rules('tlp', 'Telepon', 'required|numeric|integer|max_length[15]');
        if ($this->form_validation->run() != false) {
            $data = array(
                'nama_member' => $this->input->post('nama_member'),
                'alamat' => $this->input->post('alamat'),
                'jenis_kelamin' => $this->input->post('jenis_kelamin'),
                'tlp' => $this->input->post('tlp')
            );
            $this->m_crud->insert_data($data, 'tb_member');
            $this->session->set_flashdata('pelanggan', 'Ditambahkan');
            redirect(base_url('pelanggan'));
        } else {
            $data = array(
                'judul' => "Pelanggan"
            );
            $data['member'] = $this->m_crud->get_data('id_member', 'tb_member')->result();
            $this->session->set_flashdata('gagal_simpan', 'Pelanggan');
            $this->load->view('template/header', $data);
            $this->load->view('pelanggan', $data);
            $this->load->view('template/footer');
        }
    }

    public function aksi_ubah()
    {
        $this->form_validation->set_rules('nama_member', 'Nama', 'required');
        $this->form_validation->set_rules('alamat', 'Alamat', 'required');
        $this->form_validation->set_rules('jenis_kelamin', 'Jenis Kelamin', 'required');
        $this->form_validation->set_rules('tlp', 'Telepon', 'required|numeric|integer|max_length[15]');
        if ($this->form_validation->run() != false) {
            $where = array(
                'id_member' => $this->input->post('id_member')
            );
            $data = array(
                'nama_member' => $this->input->post('nama_member'),
                'alamat' => $this->input->post('alamat'),
                'jenis_kelamin' => $this->input->post('jenis_kelamin'),
                'tlp' => $this->input->post('tlp')
            );
            $this->m_crud->update_data($where, $data, 'tb_member');
            $this->session->set_flashdata('pelanggan', 'Diubah');
            redirect(base_url('pelanggan'));
        } else {
            $data = array(
                'judul' => "Pelanggan"
            );
            $data['member'] = $this->m_crud->get_data('id_member', 'tb_member')->result();
            $this->session->set_flashdata('gagal_simpan', 'Pelanggan');
            $this->load->view('template/header', $data);
            $this->load->view('pelanggan', $data);
            $this->load->view('template/footer');
        }
    }

    public function hapus($id_member)
    {
        $where = array(
            'id_member' => $id_member
        );
        $this->m_crud->delete_data($where, 'tb_member');
        $this->session->set_flashdata('pelanggan', 'Dihapus');
        redirect(base_url('pelanggan'));
    }
}

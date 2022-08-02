<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Registrasi extends CI_Controller
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
            'judul' => "Registrasi"
        );
        $this->load->view('template/header', $data);
        $this->load->view('registrasi/pelanggan');
        $this->load->view('template/footer');
    }

    public function aksi_tambah()
    {
        $data = array(
            'id_member' => $this->input->post('id_member'),
            'nama_member' => $this->input->post('nama_member'),
            'alamat' => $this->input->post('alamat'),
            'jenis_kelamin' => $this->input->post('jenis_kelamin'),
            'tlp' => $this->input->post('tlp')
        );
        $this->m_crud->insert_data($data, 'tb_member');
        redirect(base_url() . 'registrasi/next');
    }

    public function next()
    {
        $data = array(
            'judul' => "Registrasi"
        );
        $data['outlet'] = $this->m_crud->get_data('id_outlet', 'tb_outlet')->result();
        $data['user'] = $this->m_crud->get_data('id_user', 'tb_user')->result();
        $data['member'] = $this->m_crud->get_data('id_member', 'tb_member')->result();
        $data['paket'] = $this->m_crud->get_data('id_paket', 'tb_paket')->result();
        $this->load->view('template/header', $data);
        $this->load->view('registrasi/next', $data);
        $this->load->view('template/footer');
    }

    public function aksi_next()
    {
        $id_transaksi = $this->input->post('id_transaksi');
        $id_outlet = $this->input->post('id_outlet');
        $id_user = $this->input->post('id_user');
        $id_member = $this->input->post('id_member');
        $harga_paket = $this->input->post('harga_paket');
        $kode_invoice = $this->input->post('kode_invoice');
        $tgl = $this->input->post('tgl');
        $diskon = $this->input->post('diskon');
        $status = $this->input->post('status');

        $harga1 = ceil(($diskon / 100) * $harga_paket);
        $harga2 = $harga_paket - $harga1;

        $data = array(
            'id_transaksi' => $id_transaksi,
            'id_outlet' => $id_outlet,
            'id_user' => $id_user,
            'id_member' => $id_member,
            'harga_paket' => $harga_paket,
            'kode_invoice' => $kode_invoice,
            'total_biaya' => $harga2,
            'tgl' => $tgl,
            'diskon' => $diskon,
            'status' => $status
        );
        $this->m_crud->insert_data($data, 'tb_transaksi');
        $this->session->set_flashdata('registrasi', 'Ditambahkan');
        redirect(base_url() . 'registrasi');
    }
}

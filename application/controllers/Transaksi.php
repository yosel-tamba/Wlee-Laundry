<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Transaksi extends CI_Controller
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
            'judul' => "Transaksi"
        );
        $data['pengguna'] = $this->m_crud->get_data('id_user', 'tb_user')->result();
        $data['member'] = $this->m_crud->get_data('id_member', 'tb_member')->result();
        $data['outlet'] = $this->m_crud->get_data('id_outlet', 'tb_outlet')->result();
        $data['transaksi'] = $this->m_data->get_transaksi()->result();
        $this->load->view('template/header', $data);
        $this->load->view('transaksi/transaksi', $data);
        $this->load->view('template/footer');
    }

    public function detail($id_transaksi)
    {
        $where = ['id_transaksi' => $id_transaksi];
        $data = array(
            'judul' => "Transaksi"
        );
        $data['pengguna'] = $this->m_crud->get_data('id_user', 'tb_user')->result();
        $data['member'] = $this->m_crud->get_data('id_member', 'tb_member')->result();
        $data['outlet'] = $this->m_crud->get_data('id_outlet', 'tb_outlet')->result();
        $data['transaksi'] = $this->m_data->get_detail_transaksi($where)->result();
        $this->load->view('template/header', $data);
        $this->load->view('transaksi/detail', $data);
        $this->load->view('template/footer');
    }

    public function detail_aksi()
    {
        $where = array(
            'id_transaksi' => $this->input->post('id_transaksi')
        );
        $data = array(
            'id_user' => $this->input->post('id_user'),
            'id_member' => $this->input->post('id_member'),
            'tgl' => $this->input->post('tgl'),
            'tgl_bayar' => $this->input->post('tgl_bayar'),
            'diskon' => $this->input->post('diskon'),
            'pajak' => $this->input->post('pajak'),
            'biaya_tambahan' => $this->input->post('biaya_tambahan'),
            'status' => $this->input->post('status')
        );
        $this->m_crud->update_data($where, $data, 'tb_transaksi');
        $this->session->set_flashdata('transaksi', 'Disimpan');
        redirect(base_url('transaksi'));
    }

    public function nota($id_transaksi)
    {
        $where = array(
            'id_transaksi' => $id_transaksi,
        );
        $data['transaksi'] = $this->m_data->nota($where)->result();
        $this->load->view('transaksi/nota', $data);
    }

    public function hapus($id_transaksi)
    {
        $where = array(
            'id_transaksi' => $id_transaksi
        );
        $this->m_crud->delete_data($where, 'tb_transaksi');
        $this->session->set_flashdata('transaksi', 'Dihapus');
        redirect($_SERVER['HTTP_REFERER']);
    }

    public function tambah_paket($id_paket, $id_transaksi)
    {
        $where = array(
            'id_paket' => $id_paket,
            'id_transaksi' => $id_transaksi
        );
        $cek = $this->db->get_where('tb_detail_transaksi', $where)->num_rows();
        $data = $this->db->get_where('tb_detail_transaksi', $where)->result();
        if ($cek > 0) {
            foreach ($data as $row) {
                $qty = $row->qty + 1;
                $data = [
                    'qty' => $qty
                ];
            }
            $this->m_crud->update_data($where, $data, 'tb_detail_transaksi');
        } else {
            $data = array(
                'id_paket' => $id_paket,
                'id_transaksi' => $id_transaksi,
                'qty' => 1
            );
            $this->m_crud->insert_data($data, 'tb_detail_transaksi');
        }
        $this->session->set_flashdata('transaksi', 'Disimpan');
        redirect($_SERVER['HTTP_REFERER']);
    }

    public function hapus_paket($id_detail_transaksi)
    {
        $where = array(
            'id_detail_transaksi' => $id_detail_transaksi
        );
        $this->m_crud->delete_data($where, 'tb_detail_transaksi');
        $this->session->set_flashdata('transaksi', 'Disimpan');
        redirect($_SERVER['HTTP_REFERER']);
    }
}

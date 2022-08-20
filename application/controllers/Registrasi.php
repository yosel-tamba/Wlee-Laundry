<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Registrasi extends CI_Controller
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
            'judul' => "Registrasi"
        );
        $data['outlet'] = $this->m_crud->get_data('id_outlet', 'tb_outlet')->result();
        $data['user'] = $this->m_crud->get_data('id_user', 'tb_user')->result();
        $data['member'] = $this->m_crud->get_data('id_member', 'tb_member')->result();
        $data['paket'] = $this->m_crud->get_data('id_paket', 'tb_paket')->result();
        $this->load->view('template/header', $data);
        $this->load->view('registrasi');
        $this->load->view('template/footer');
    }

    public function aksi_registrasi()
    {
        $this->form_validation->set_rules('nama_member', 'Nama', 'required');
        $this->form_validation->set_rules('alamat', 'Alamat', 'required');
        $this->form_validation->set_rules('jenis_kelamin', 'Jenis Kelamin', 'required');
        $this->form_validation->set_rules('tlp', 'Telepon', 'required|numeric|integer|max_length[15]');
        $this->form_validation->set_rules('id_outlet', 'Outlet', 'required');
        $this->form_validation->set_rules('id_user', 'Pengguna', 'required');
        $this->form_validation->set_rules('diskon', 'Diskon', 'required|numeric|integer|max_length[3]');
        if ($this->form_validation->run() != false) {
            $nama_member = $this->input->post('nama_member');
            $alamat = $this->input->post('alamat');
            $jenis_kelamin = $this->input->post('jenis_kelamin');
            $tlp = $this->input->post('tlp');
            $id_outlet = $this->input->post('id_outlet');
            $id_user = $this->input->post('id_user');
            $kode_invoice = $this->input->post('kode_invoice');
            $tgl = $this->input->post('tgl');
            $diskon = $this->input->post('diskon');
            $status = $this->input->post('status');
            $id_paket = $this->input->post('id_paket');

            $data_pelanggan = [
                'nama_member' => $nama_member,
                'tlp' => $tlp,
                'alamat' => $alamat,
                'jenis_kelamin' => $jenis_kelamin
            ];
            $id_member = $this->m_data->insert_get_id($data_pelanggan, 'tb_member');

            $data_transaksi = array(
                'id_outlet' => $id_outlet,
                'id_user' => $id_user,
                'id_member' => $id_member,
                'kode_invoice' => $kode_invoice,
                'tgl' => $tgl,
                'diskon' => $diskon,
                'status' => $status
            );
            $id_transaksi = $this->m_data->insert_get_id($data_transaksi, 'tb_transaksi');

            $data_detail_transaksi = [];
            $index = 0;
            foreach ($id_paket as $id) {
                array_push($data_detail_transaksi, array(
                    'id_paket' => $id,
                    'qty' => '1',
                    'id_transaksi' => $id_transaksi
                ));

                $index++;
            }
            $this->db->insert_batch('tb_detail_transaksi', $data_detail_transaksi);

            $this->session->set_flashdata('registrasi', 'Ditambahkan');
            redirect(base_url() . 'registrasi');
        } else {
            $data = array(
                'judul' => "Registrasi"
            );
            $data['outlet'] = $this->m_crud->get_data('id_outlet', 'tb_outlet')->result();
            $data['user'] = $this->m_crud->get_data('id_user', 'tb_user')->result();
            $data['member'] = $this->m_crud->get_data('id_member', 'tb_member')->result();
            $data['paket'] = $this->m_crud->get_data('id_paket', 'tb_paket')->result();
            $this->load->view('template/header', $data);
            $this->load->view('registrasi');
            $this->load->view('template/footer');
        }
    }

    public function listPaket()
    {
        $id_outlet = $this->input->post('id_outlet');
        $paket = $this->m_data->getListPaket($id_outlet);
        if (!empty($paket)) {
            $lists = "
            <label for='id_paket' class='col-formlabel'>Pilih Paket</label>
            <div class='row mt-1 align-content-center'>
            <div class='col-6 table-responsive'>
                <table class='table table-bordered' width='100%' cellspacing='0'>
                <thead>
                    <tr>
                        <th class=''>Nama Paket</th>
                        <th class=''>Harga</th>
                    </tr>
                </thead>
                <tbody>
        ";
            foreach ($paket as $data) {
                $lists .= "
                    <tr>
                        <td class=''>
                            <div class='custom-control custom-checkbox mr-sm-2'>
                                <input type='checkbox' class='custom-control-input' name='id_paket[]' value='" . $data->id_paket . "' id='" . $data->id_paket . "''>
                                <label class='custom-control-label' for='" . $data->id_paket . "'>" . $data->nama_paket . "</label>
                            </div>
                        </td>
                        <td class=''>Rp. " . number_format($data->harga) . "</td>
                    </tr>
            ";
            }
            $lists .= "
                        </tbody>
                    </table>
                </div>
            </div>
        ";
        } else {
            $lists = "
                <div class='alert text-center alert-warning font-italic font-weight-bold' role='alert'>
                    Tidak ada data Paket
                </div>
            ";
        }

        $callback = array('list_paket' => $lists);
        echo json_encode($callback);
    }
}

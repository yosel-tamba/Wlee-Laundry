<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Pengguna extends CI_Controller
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
            'judul' => "Pengguna"
        );
        $data['user'] = $this->m_crud->get_data('id_user', 'tb_user')->result();
        $data['outlet'] = $this->m_crud->get_data('id_outlet', 'tb_outlet')->result();
        $this->load->view('template/header', $data);
        $this->load->view('pengguna', $data);
        $this->load->view('template/footer');
    }

    public function aksi_tambah()
    {
        $this->form_validation->set_rules('nama_user', 'Nama', 'required');
        $this->form_validation->set_rules('username', 'Username', 'required|min_length[5]');
        $this->form_validation->set_rules('password', 'Password', 'required|min_length[5]');
        $this->form_validation->set_rules('id_outlet', 'Outlet', 'required');
        $this->form_validation->set_rules('role', 'Role', 'required');
        if ($this->form_validation->run() != false) {
            if (isset($_FILES['foto']['name']) && $_FILES['foto']['name'] != '') {
                $nama = str_replace(' ', '_', $this->input->post('nama_user'));
                $foto = rand() . "-" . $nama . ".jpg";
                $config['upload_path'] = './assets/img/foto_profil/';
                $config['allowed_types'] = 'jpeg|jpg|png';
                $config['max_size'] = 5000;
                $config['max_width'] = 5000;
                $config['max_height'] = 5000;
                $config['file_name'] = $foto;

                $this->load->library('upload', $config);
                if (!$this->upload->do_upload('foto')) {
                    $data = array(
                        'judul' => "Pengguna"
                    );
                    $data['user'] = $this->m_crud->get_data('id_user', 'tb_user')->result();
                    $data['outlet'] = $this->m_crud->get_data('id_outlet', 'tb_outlet')->result();
                    $this->session->set_flashdata('gagal_simpan', 'Pengguna');
                    $this->load->view('template/header', $data);
                    $this->load->view('pengguna', $data);
                    $this->load->view('template/footer');
                    return false;
                } else {
                    $this->upload->data();
                }
            } else {
                $foto = 'user.png';
            }

            $data = array(
                'id_outlet' => $this->input->post('id_outlet'),
                'nama_user' => $this->input->post('nama_user'),
                'password' => md5($this->input->post('password')),
                'passconf' => $this->input->post('password'),
                'username' => $this->input->post('username'),
                'role' => $this->input->post('role'),
                'foto' => $foto
            );

            $this->m_crud->insert_data($data, 'tb_user');
            $this->session->set_flashdata('pengguna', 'Ditambahkan');
            redirect(base_url('pengguna'));
        } else {
            $data = array(
                'judul' => "Pengguna"
            );
            $data['user'] = $this->m_crud->get_data('id_user', 'tb_user')->result();
            $data['outlet'] = $this->m_crud->get_data('id_outlet', 'tb_outlet')->result();
            $this->session->set_flashdata('gagal_simpan', 'Pengguna');
            $this->load->view('template/header', $data);
            $this->load->view('pengguna', $data);
            $this->load->view('template/footer');
        }
    }

    public function aksi_ubah()
    {
        $this->form_validation->set_rules('nama_user', 'Nama', 'required');
        $this->form_validation->set_rules('username', 'Username', 'required|min_length[5]');
        $this->form_validation->set_rules('password', 'Password', 'required|min_length[5]');
        $this->form_validation->set_rules('id_outlet', 'Outlet', 'required');
        $this->form_validation->set_rules('role', 'Role', 'required');
        if ($this->form_validation->run() != false) {
            if (isset($_FILES['foto']['name']) && $_FILES['foto']['name'] != '') {
                $nama = str_replace(' ', '_', $this->input->post('nama_user'));
                $foto = rand() . "-" . $nama . ".jpg";
                $config['upload_path'] = './assets/img/foto_profil/';
                $config['allowed_types'] = 'jpeg|jpg|png';
                $config['max_size'] = 5000;
                $config['max_width'] = 5000;
                $config['max_height'] = 5000;
                $config['file_name'] = $foto;

                $this->load->library('upload', $config);
                if (!$this->upload->do_upload('foto')) {
                    $data = array(
                        'judul' => "Pengguna"
                    );
                    $data['user'] = $this->m_crud->get_data('id_user', 'tb_user')->result();
                    $data['outlet'] = $this->m_crud->get_data('id_outlet', 'tb_outlet')->result();
                    $this->session->set_flashdata('gagal_simpan', 'Pengguna');
                    $this->load->view('template/header', $data);
                    $this->load->view('pengguna', $data);
                    $this->load->view('template/footer');
                    return false;
                } else {
                    $this->upload->data();
                }
            } else {
                $foto = $this->input->post('foto_default');
            }
            $where = array(
                'id_user' => $this->input->post('id_user')
            );
            $data = array(
                'id_outlet' => $this->input->post('id_outlet'),
                'nama_user' => $this->input->post('nama_user'),
                'password' => md5($this->input->post('password')),
                'passconf' => $this->input->post('password'),
                'username' => $this->input->post('username'),
                'role' => $this->input->post('role'),
                'foto' => $foto
            );

            $this->m_crud->update_data($where, $data, 'tb_user');
            $this->session->set_flashdata('pengguna', 'Diubah');
            redirect(base_url('pengguna'));
        } else {
            $data = array(
                'judul' => "Pengguna"
            );
            $data['user'] = $this->m_crud->get_data('id_user', 'tb_user')->result();
            $data['outlet'] = $this->m_crud->get_data('id_outlet', 'tb_outlet')->result();
            $this->session->set_flashdata('gagal_simpan', 'Pengguna');
            $this->load->view('template/header', $data);
            $this->load->view('pengguna', $data);
            $this->load->view('template/footer');
        }
    }

    public function hapus($id_user)
    {
        $where = array(
            'id_user' => $id_user
        );
        $this->m_crud->delete_data($where, 'tb_user');
        $this->session->set_flashdata('pengguna', 'Dihapus');
        redirect(base_url('pengguna'));
    }
}

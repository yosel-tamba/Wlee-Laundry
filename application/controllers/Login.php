<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Login extends CI_Controller {
    public function index()
    {
        $this->load->view('login');
    }
    public function ceklogin()
    {
        $username = $this->input->post('username');
        $password = $this->input->post('password');
        $where = array(
            'username' => $username,
            'password' => md5($password)
        );
        $this->load->model('m_login');
        $cek = $this->m_login->cek_login('tb_user',$where)->num_rows();
        if($cek > 0){
            $data = $this->m_login->cek_login('tb_user',$where)->row();
            $role = $data->role;
            if ($role=='Admin') {
                $data_session = array(
                    'id' => $data->id_user,
                    'nama_user' => $data->nama_user,
                    'username' => $data->username,
                    'role' => $data->role,
                    'status' => 'telah_login'
                );
                $this->session->set_userdata($data_session);
                redirect(base_url().'dashboard');
            }elseif ($role=='Kasir') {
                $data_session = array(
                    'id' => $data->id_user,
                    'nama_user' => $data->nama_user,
                    'username' => $data->username,
                    'role' => $data->role,
                    'status' => 'telah_login'
                );
                $this->session->set_userdata($data_session);
                redirect(base_url().'dashboard');
            }elseif ($role=='Owner') {
                $data_session = array(
                    'id' => $data->id_user,
                    'nama_user' => $data->nama_user,
                    'username' => $data->username,
                    'role' => $data->role,
                    'status' => 'telah_login'
                );
                $this->session->set_userdata($data_session);
                redirect(base_url().'dashboard');
            }
        }else{
            $this->session->set_flashdata('gagal', 'Gagal');
            redirect(base_url());
        }
    }

    public function keluar()
    {
        $this->session->sess_destroy();
        redirect(base_url().'login/alert');
    }
    public function alert()
    {
        $this->session->set_flashdata('berhasil', 'Berhasil');
        redirect(base_url());
    }
}

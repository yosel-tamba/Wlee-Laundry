<?php
defined('BASEPATH') or exit('No direct script access allowed');
class M_filter extends CI_Model
{

    function transaksi($dari, $sampai)
    {
        $this->db->order_by('id_transaksi', 'desc');
        return $this->db->from('tb_transaksi')
            ->join('tb_member', 'tb_member.id_member = tb_transaksi.id_member')
            ->where('status', 'diambil')
            ->where('tgl_bayar >=', $dari)
            ->where('tgl_bayar <=', $sampai)
            ->get();
    }

    function pelanggan($jenis_kelamin)
    {
        $this->db->order_by('id_member', 'desc');
        return $this->db->from('tb_member')
            ->where('jenis_kelamin', $jenis_kelamin)
            ->get();
    }

    function pengguna($role)
    {
        $this->db->order_by('id_user', 'desc');
        return $this->db->from('tb_user')
            ->where('role', $role)
            ->join('tb_outlet', 'tb_outlet.id_outlet = tb_user.id_outlet')
            ->get();
    }

    function paket($jenis)
    {
        $this->db->order_by('id_paket', 'desc');
        return $this->db->from('tb_paket')
            ->where('jenis', $jenis)
            ->join('tb_outlet', 'tb_outlet.id_outlet = tb_paket.id_outlet')
            ->get();
    }
}

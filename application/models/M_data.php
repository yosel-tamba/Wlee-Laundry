<?php
defined('BASEPATH') or exit('No direct script access allowed');
class M_data extends CI_Model
{
	public function dashboard()
	{
		return $this->db->from('tb_transaksi')
			->join('tb_member', 'tb_member.id_member = tb_transaksi.id_member')
			// ->join('tb_paket', 'tb_paket.harga = tb_transaksi.harga_paket')
			->where('status', 'Diambil')
			->get();
	}

	public function get_transaksi_diambil()
	{
		$this->db->order_by('id_transaksi', 'desc');
		return $this->db->from('tb_transaksi')
			->join('tb_member', 'tb_member.id_member = tb_transaksi.id_member')
			->where('status', 'Diambil')
			->get();
	}

	public function get_transaksi()
	{
		$this->db->order_by('id_transaksi', 'DESC');
		return $this->db->from('tb_transaksi')
			->join('tb_member', 'tb_member.id_member = tb_transaksi.id_member')
			->get();
	}

	public function get_detail_transaksi()
	{
		$this->db->order_by('id_transaksi', 'DESC');
		return $this->db->from('tb_transaksi')
			->join('tb_member', 'tb_member.id_member = tb_transaksi.id_member')
			->get();
	}

	public function nota($where)
	{
		return $this->db->from('tb_transaksi')
			->join('tb_member', 'tb_member.id_member = tb_transaksi.id_member')
			->join('tb_user', 'tb_user.id_user = tb_transaksi.id_user')
			->join('tb_outlet', 'tb_outlet.id_outlet = tb_transaksi.id_outlet')
			->where($where)
			->get();
	}

	function insert_get_id($data, $table)
	{
		$this->db->insert($table, $data);
		return $this->db->insert_id();
	}

	public function getListPaket($id_outlet)
	{
		$this->db->where('id_outlet', $id_outlet);
		$result = $this->db->get('tb_paket')->result();

		return $result;
	}

	public function notaPaket($where)
	{
		$this->db->order_by('id_detail_transaksi', 'DESC');
		return $this->db->from('tb_detail_transaksi')
			->join('tb_paket', 'tb_paket.id_paket = tb_detail_transaksi.id_paket')
			->where($where)
			->get();
	}
}

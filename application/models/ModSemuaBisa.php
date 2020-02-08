<?php
defined('BASEPATH') or exit('No direct script access allowed');

class ModSemuaBisa extends CI_Model
{
	public $arr;

	public function tambahData($tabel, $data)
	{
		if ($this->db->insert($tabel, $data)) {
			$this->arr = [
				'status' => 'berhasil',
				'id' => $this->db->insert_id() 
			];
		} else {
			$this->arr = [
				'status' => 'gagal',
			];
		}
		return $this->arr;
	}

	public function mengubahData($tabel, $where, $data)
	{
		$this->db->where($where);
		if ($this->db->update($tabel, $data)) {
			$this->arr = [
				'status' => 'berhasil',
			];
		} else {
			$this->arr = [
				'status' => 'gagal',
			];
		}
		return $this->arr;
	}

	public function menghapusData($tabel, $where)
	{
		$this->db->where($where);
		if ($this->db->delete($tabel)) {
			$this->arr = [
				'status' => 'berhasil',
			];
		} else {
			$this->arr = [
				'status' => 'gagal',
			];
		}
		return $this->arr;
	}

	public function mengambilDataV1($tabel, $where = null)
	{
		if ($where != null) {
			$where;
		}

		return $this->db->get($tabel);
	}

	public function mengambilDataV2($tabel, $where = null)
	{
		if ($where != null) {
			$this->db->where($where);
		}

		return $this->db->get($tabel);
	}
}

/* End of file ModSemuaBisa.php */
/* Location: ./application/models/ModSemuaBisa.php */

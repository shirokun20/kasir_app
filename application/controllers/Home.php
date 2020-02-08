<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		if ($this->session->admin) {
			site_url('admin/dashboard');
		}
		$this->load->model('ModSemuaBisa', 'msb');
	}

	private $arr;

	public function index()
	{
		$data['title'] = 'halaman Login';
		$this->shiro->layout_custom('halaman_login', $data);
	}

	private function _chechEmail($input)
	{
		$this->db->where('pengguna_email', $input['email']);
		$this->db->or_where('pengguna_hp', $input['email']);
	}

	public function checkEmail()
	{
		$input = $this->input->post();
		$sql = $this->msb->mengambilDataV1('tb_pengguna', $this->_chechEmail($input));
		if ($sql->num_rows() == true) {
			$this->arr = [
				'status' => 'ada',
				'pesan' => 'Berhasil ditemukan!'
			];
		} else {
			$this->arr = [
				'status' => 'tidak_ada',
				'pesan' => 'Gagal ditemukan!'
			];
		}

		echo json_encode([
			'shiro' => $this->arr
		]);
	}

	public function checkValidasi()
	{
		$input = $this->input->post();
		$sql = $this->msb->mengambilDataV1('tb_pengguna', $this->_chechEmail($input));
		if ($sql->num_rows() == true) {
			if ($sql->row()->pengguna_pass == md5($input['password'])) {
				$this->arr = [
					'status' => 'berhasil',
					'pesan' => 'Berhasil ditemukan!'
				];
			} else {
				$this->arr = [
					'status' => 'gagal',
					'pesan' => 'Password Salah!'
				];
			}
		} else {
			$this->arr = [
				'status' => 'gagal',
				'pesan' => 'Gagal ditemukan!'
			];
		}

		echo json_encode([
			'shiro' => $this->arr
		]);
	}
}

/* End of file Home.php */
/* Location: ./application/controllers/Home.php */

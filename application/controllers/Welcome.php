<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Welcome extends CI_Controller
{
	function __construct()
	{
		parent::__construct();

		$array_akses_boleh = ['opd', 'su', 'wd'];

		if (!in_array($this->session->userdata('role'), $array_akses_boleh)) {
			$this->session->set_flashdata('msg', '<script>Swal.fire("Oops..", "Masukkan NIP dan Password dengan Benar!", "error"); </script>');
			redirect('Login');
		}
	}

	public function index()
	{
		$role = $this->session->userdata('role');
		$id_opd = $this->session->userdata('id_opd');
		$data['pengelolaan'] = 'Open Data';
		$data['title_page'] = 'Dasboard ' . $data['pengelolaan'];

		$data['user'] = $this->DataHandle->getAllWhere('ms_user', 'id', "status = '1'")->num_rows();
		$data['opd'] = $this->DataHandle->getAllWhere('ms_opd', 'id', "status = '1'")->num_rows();

		$where = [
			'id !=' => "null"
		];
		$data['dataset_opd'] = $this->DataHandle->getAllWhere('v_dataset_join_opd', '*', $where);

		$kondisi = '';
		if ($role == 'opd') :
			$kondisi .= " AND id_opd = '" . $id_opd . "'";
		endif;
		$data['dataset_publish'] = $this->DataHandle->getAllWhere('ms_dataset', 'id', "status = '1' AND publish = '1'" . $kondisi)->num_rows();
		$data['dataset_belum'] = $this->DataHandle->getAllWhere('ms_dataset', 'id', "status = '1' AND publish != '1'" . $kondisi)->num_rows();
		$this->template->back_end('back_end/v_dashboard', $data);
	}
}

<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Download extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
	}
	public function download_dataset($id = null)
	{ //ddl_dataset       
		$file = $this->DataHandle->getAllWhere('ms_detail_dataset', 'file, extension', array('id' => de_crypt($id)))->row_array();
		$this->load->helper('download');
		force_download("DLDS_" . date('ymdhis') . "." . $file['extension'], file_get_contents(FCPATH . 'uploads/data/' . $file['file']));
	}
}

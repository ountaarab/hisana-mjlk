<?php

use function GuzzleHttp\json_decode;


defined('BASEPATH') or exit('No direct script access allowed');

class Dataset extends CI_Controller
{

    var $column_order = array(null, 'judul', 'pengukuran', 'nama_opd', 'published_date', 'created_at', 'created_by', 'updated_at', 'updated_by'); //set column field database for datatable orderable
    var $column_search = array('judul', 'pengukuran', 'nama_opd', 'published_date', 'created_at', 'created_by', 'updated_at', 'updated_by'); //set column field database for datatable searchable 
    var $order = array('created_at' => 'desc'); // default order

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
        $data['pengelolaan'] = 'Dataset';
        $data['title_page'] = 'Master ' . $data['pengelolaan'];
        $data['topik'] = $this->DataHandle->getAllWhere('ms_topik', 'id, nama_topik', "status = '1'");
        $data['opd'] = $this->DataHandle->getAllWhere('ms_opd', 'id, nama', "status = '1'");
        $this->template->back_end('back_end/dataset/index', $data);
    }

    public function notif()
    {
        $this->load->view('template/navbar');
    }

    public function get()
    {
        $input = $this->input->post(null, true);

        $role_aktif = $this->session->userdata('role');
        $id_opd = $this->session->userdata('id_opd');
        $kondisi = [
            'id != ' => 'null',
            'status' => '1',
        ];

        if ($input['id_opd'] != '-') :
            $kondisi['id_opd'] = $input['id_opd'];
        endif;

        if ($input['id_topik'] != '-') :
            $kondisi['id_topik'] = $input['id_topik'];
        endif;

        if ($input['status'] != '-') :
            $kondisi['publish'] = $input['status'];
        endif;

        $list = $this->M_Datatable->get_datatables(
            'v_dataset',
            $this->column_order,
            $this->column_search,
            $this->order,
            '*',
            $kondisi
        );

        $data = array();
        $no = $_POST['start'];

        foreach ($list as $row) {
            $baris = array();
            $no = $no + 1;
            $ket_publish = '';
            $aksi_publish = '';
            $verified = '';


            $file = '';
            if ($row->file != null) :
                $file = '<a alt="Detail" class="btn btn-success mr-2" target="_blank" href="' . base_url('dl_dataset/' . en_crypt($row->id_file)) . '"><i class="fa fa-file-excel"></i>  Dataset</a>';
            endif;

            $detail = '<button alt="Detail" data-toggle="modal" data-target=".modal-detail" class="btn btn-dark mr-2" onclick="detail(' . $row->id . ')"><i class="fa fa-search"></i> Pratinjau</button>';
            $edit = '';
            $hapus = '';
            if ($role_aktif == 'su' || $role_aktif == 'wd') :
                $edit = '<button alt="Edit" class="btn btn-info mr-2" onclick="edit(' . $row->id . ')"><i class="fa fa-pencil-alt"></i> Edit</button>';
                $hapus = '<button alt="Hapus" class="btn btn-danger mr-2" onclick="hapus(' . $row->id . ')"><i class="fa fa-trash-alt"></i> Hapus</button>';
            endif;

            if ($role_aktif == 'opd') :
                if ($row->publish == '1') :
                    $verified = '<i class="fa fa-check text-success"></i>';
                    $ket_publish = "<span class='text-success mr-3'><strong>" . $row->published_date . "</strong></span>";
                elseif ($row->publish == '-1') :
                    $ket_publish = "<span class='text-danger'><strong>-PERBAIKAN-</strong></span>";
                    $edit = '<button alt="Edit" class="btn btn-info mr-2" onclick="edit(' . $row->id . ')"><i class="fa fa-pencil-alt"></i> Edit</button>';
                else :
                    $ket_publish = "<span class='text-warning'><strong>(Menunggu Persetujuan Publish)</strong></span>";
                endif;
            else :
                if ($row->publish == '1') :
                    $verified = '<i class="fa fa-check text-success"></i>';
                    $ket_publish = "<span class='text-success mr-3'><strong>" . $row->published_date . "</strong></span>";
                elseif ($row->publish == '-1') :
                    $ket_publish = "<span class='text-warning'>-Menunggu Perbaikan-</span>";
                // onchange="verif_dataset(' . $row->id . ')"
                else :
                    $aksi_publish = '<button alt="Verifikasi" data-toggle="modal" data-target=".modal-verifikasi" class="btn btn-secondary mr-2" onclick="verifikasi(' . $row->id . ')"><i class="fa fa-pencil-alt"></i> Verifikasi</button>';
                    $ket_publish = "<span class='text-danger'><strong>(Menunggu Persetujuan Publish)</strong></span>";
                endif;
            endif;

            $baris[] = $no;
            $baris[] = "TOPIK : <strong>" . $row->nama_topik . "</strong><br><strong>" . $row->nama_opd . "</strong><br>" . $row->judul . "<br><u>Pengukuran : " . $row->pengukuran . "</u><br><br>" .  $edit  . $hapus . $detail  . $file . $aksi_publish;
            $baris[] = "<strong>Dibuat</strong> : " . $row->created_at .
                "<br><br><strong>Terakhir Diperbaharui</strong> : " . $row->updated_at .
                "<br><br><strong>Publish</strong> : " . $ket_publish . $verified;

            $data[] = $baris;
        }

        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->M_Datatable->count_all(
                'v_dataset',
                $this->column_order,
                $this->column_search,
                $this->order,
                '*',
                $kondisi
            ),
            "recordsFiltered" => $this->M_Datatable->count_filtered(
                'v_dataset',
                $this->column_order,
                $this->column_search,
                $this->order,
                '*',
                $kondisi
            ),
            "data" => $data,
        );
        //output to json format

        echo json_encode($output);
    }

    public function form()
    {
        $data['pengelolaan'] = 'Tambah Dataset';
        $data['title_page'] = 'Form ' . $data['pengelolaan'];
        $data['topik'] = $this->DataHandle->getAllWhere('ms_topik', 'id, nama_topik', "status = '1'");
        $data['opd'] = $this->DataHandle->getAllWhere('ms_opd', 'id, nama', "status = '1'");
        $data['tingkat_penyajian'] = $this->DataHandle->getAllWhere('ms_tingkat_penyajian', 'id, tingkat_penyajian', "status = '1'");
        $this->load->view('back_end/dataset/add', $data);
    }

    public function formEdit($id = null)
    {
        $data['pengelolaan'] = 'Edit Dataset';
        $data['title_page'] = 'Form ' . $data['pengelolaan'];
        $data['topik'] = $this->DataHandle->getAllWhere('ms_topik', 'id, nama_topik', "status = '1'");
        $data['opd'] = $this->DataHandle->getAllWhere('ms_opd', 'id, nama', "status = '1'");
        $data['tingkat_penyajian'] = $this->DataHandle->getAllWhere('ms_tingkat_penyajian', 'id, tingkat_penyajian', "status = '1'");
        $data['dataset'] = $this->DataHandle->getAllWhere('v_dataset', '*', "status = '1' AND id = '" . $id . "'")->row_array();
        $this->load->view('back_end/dataset/edit', $data);
    }

    public function getDetail($id = null)
    {
        $data['detail'] = $this->DataHandle->getAllWhere('v_dataset', '*', "status = '1' AND id = '" . $id . "'")->row_array();
        $this->load->view('back_end/dataset/modal', $data);
    }

    public function getVerifikasi($id = null)
    {
        $data['detail'] = $this->DataHandle->getAllWhere('v_dataset', '*', "status = '1' AND id = '" . $id . "'")->row_array();
        $data['controller_name'] = 'Dataset';
        $this->load->view('back_end/dataset/verifikasi', $data);
    }

    public function download($id = null)
    { //dl_dataset       
        $file = $this->DataHandle->getAllWhere('ms_detail_dataset', 'file, extension', array('id' => de_crypt($id)))->row_array();
        $this->load->helper('download');
        force_download("DLDS_" . date('ymdhis') . "." . $file['extension'], file_get_contents(FCPATH . 'uploads/data/' . $file['file']));
    }


    private function set_upload_options()
    {
        $config['upload_path'] = PATH_DATASET;

        $config['allowed_types'] = 'csv|CSV';
        $config['max_size'] = 0;
        $config['encrypt_name'] = FALSE;
        $config['overwrite']     = TRUE;

        return $config;
    }

    public function act($aksi = null)
    {
        $role_aktif = $this->session->userdata('role');
        $created_by = $this->session->userdata('nip');
        $this->load->library('upload');
        $input = $this->input->post();
        if ($aksi == 'add') :
            if ($role_aktif == 'opd') :
                $id_opd = $this->session->userdata('id_opd');
            else :
                $id_opd = $input['id_opd'];
            endif;
            $cek = $this->DataHandle->getAllWhere('ms_dataset', 'id', "status = '1' AND judul = '" . $input['judul'] . "' AND id_opd = '" . $id_opd . "'")->num_rows();
            if ($cek > 0) :
                $response = [
                    'status' => 0,
                    'msg' => '
					<div class="alert alert-danger alert-dismissible fade show" role="alert">
						<button type="button" class="close" data-dismiss="alert" aria-label="Close">
							<span aria-hidden="true">×</span>
						</button>
						<strong>Maaf!</strong> Nama Dataset pada OPD ini sudah pernah ada!
					</div>',
                ];
                echo json_encode($response);
                die;
            endif;

            if (!isset($_FILES['userfile']['name']) && empty($_FILES['userfile']['name'])) {
                $response = [
                    'status' => 0,
                    'msg' => '
					<div class="alert alert-danger alert-dismissible fade show" role="alert">
						<button type="button" class="close" data-dismiss="alert" aria-label="Close">
							<span aria-hidden="true">×</span>
						</button>
						<strong>Maaf!</strong> Anda Harus melampirkan Lampiran Dataset!
					</div>',
                ];
                echo json_encode($response);
                die;
            }
            $files = $_FILES;
            $nama_file = $_FILES['userfile']['name'];
            $pecah = explode(".", $nama_file);
            $ext_file = end($pecah);
            $nama_file_baru = "DS" . $id_opd . "_" . date('ymdhis') . "." . $ext_file;

            $_FILES['userfile']['name'] = $nama_file_baru;
            $_FILES['userfile']['type'] = $files['userfile']['type'];
            $_FILES['userfile']['tmp_name'] = $files['userfile']['tmp_name'];
            $_FILES['userfile']['error'] = $files['userfile']['error'];
            $_FILES['userfile']['size'] = $files['userfile']['size'];

            // Validasi di atas 1,5MB 
            if ($files['userfile']['size'] > 1539325) :
                $response = array(
                    'status' => 0,
                    'msg' => '
					<div class="alert alert-danger alert-dismissible fade show" role="alert">
						<button type="button" class="close" data-dismiss="alert" aria-label="Close">
							<span aria-hidden="true">×</span>
						</button>
						<strong>Maaf!</strong> Gagal mengupload Lampiran, periksa kembali Size dokumen. (Max size 1.5 MB)
					</div>',
                    'return_url' => '#'
                );
                echo json_encode($response);
                die();
            endif;

            $this->upload->initialize($this->set_upload_options());
            if ($this->upload->do_upload()) {
                $file_data = $this->upload->data();

                $input_detail['file'] = $nama_file_baru;
                $input_detail['extension'] = $ext_file;
            } else {
                $response = array(
                    'status' => 0,
                    'msg' => '
					<div class="alert alert-danger alert-dismissible fade show" role="alert">
						<button type="button" class="close" data-dismiss="alert" aria-label="Close">
							<span aria-hidden="true">×</span>
						</button>
						<strong>Maaf!</strong> Gagal mengupload foto. Silahkan diulang kembali dengan format .csv 
					</div> ',
                    'return_url' => '#'
                );
                echo json_encode($response);
                die();
            }
            $input['status'] = 1;
            $input['slug'] = url_title($input['judul'], 'dash', true) . "-" . time();
            $input['created_by'] = $created_by;
            if ($role_aktif == 'opd') :
                $input['publish'] = '0';
                $input['id_opd'] = $this->session->userdata('id_opd');
            endif;
            $save = $this->DataHandle->insert('ms_dataset', $input);
            if ($save) :
                $input_detail['id_dataset'] = $this->DataHandle->get_last_id();
                $input_detail['created_by'] = $created_by;
                $input_detail['status'] = 1;

                $this->DataHandle->insert('ms_detail_dataset', $input_detail);
                $response = [
                    'status' => 20,
                    'msg' => '
					<div class="alert alert-success alert-dismissible fade show" role="alert">
						<button type="button" class="close" data-dismiss="alert" aria-label="Close">
							<span aria-hidden="true">×</span>
						</button>
						<strong>Berhasil!</strong> Data Berhasil disimpan!
					</div>',
                ];
                echo json_encode($response);
                die;
            endif;
        elseif ($aksi == 'verif') :
            $where = [
                'id' => $input['id']
            ];
            $data['publish'] = $input['jawaban'];
            if ($input['jawaban'] == '1') :
                $data['published_date'] = date('Y-m-d H:i:s');
                $data['format_tersedia'] = json_encode($input['format_tersedia']);
            endif;
            $save = $this->DataHandle->update('ms_dataset', $data, $where);
            if ($save) :
                $response = [
                    'status' => 20,
                    'msg' => '
					<div class="alert alert-success alert-dismissible fade show" role="alert">
						<button type="button" class="close" data-dismiss="alert" aria-label="Close">
							<span aria-hidden="true">×</span>
						</button>
						<strong>Berhasil!</strong> Verifikasi berhasil dilakukan!
					</div>',
                ];
            endif;
        elseif ($aksi == 'edit') :
            if ($role_aktif == 'opd') :
                $id_opd = $this->session->userdata('id_opd');
            else :
                $id_opd = $input['id_opd'];
            endif;
            $cek = $this->DataHandle->getAllWhere('ms_dataset', 'id', "status = '1' AND judul = '" . $input['judul'] . "' AND id_opd = '" . $id_opd . "' AND id != '" . $input['id'] . "'")->row_array();
            if ($cek > 0) :
                $response = [
                    'status' => 0,
                    'msg' => '
				<div class="alert alert-danger alert-dismissible fade show" role="alert">
					<button type="button" class="close" data-dismiss="alert" aria-label="Close">
						<span aria-hidden="true">×</span>
					</button>
					<strong>Maaf!</strong> Nama Dataset pada OPD ini sudah pernah ada!
				</div>',
                ];
                echo json_encode($response);
                die;
            endif;

            if (isset($_FILES['userfile']['name']) && !empty($_FILES['userfile']['name'])) {
                $files = $_FILES;
                $nama_file = $_FILES['userfile']['name'];
                $pecah = explode(".", $nama_file);
                $ext_file = end($pecah);
                $nama_file_baru = "DS" . $id_opd . "_" . date('ymdhis') . "." . $ext_file;

                $_FILES['userfile']['name'] = $nama_file_baru;
                $_FILES['userfile']['type'] = $files['userfile']['type'];
                $_FILES['userfile']['tmp_name'] = $files['userfile']['tmp_name'];
                $_FILES['userfile']['error'] = $files['userfile']['error'];
                $_FILES['userfile']['size'] = $files['userfile']['size'];

                // Validasi di atas 1,5MB 
                if ($files['userfile']['size'] > 1539325) :
                    $response = array(
                        'status' => 0,
                        'msg' => '
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                            <strong>Maaf!</strong> Gagal mengupload Lampiran, periksa kembali Size dokumen. (Max size 1.5 MB)
                        </div> ',
                        'return_url' => '#'
                    );
                    echo json_encode($response);
                    die();
                endif;

                $this->upload->initialize($this->set_upload_options());
                if ($this->upload->do_upload()) {
                    $file_data = $this->upload->data();

                    $input_detail['file'] = $nama_file_baru;
                    $input_detail['extension'] = $ext_file;
                } else {
                    $response = array(
                        'status' => 0,
                        'msg' => '
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                            <strong>Maaf!</strong> Gagal mengupload foto. Silahkan diulang kembali dengan format .csv
                        </div>',
                        'return_url' => '#'
                    );
                    echo json_encode($response);
                    die();
                }
            }

            $input['slug'] = url_title($input['judul'], 'dash', true) . "-" . time();
            $input['updated_by'] = $this->session->userdata('nip');

            $where = [
                'id' => $input['id']
            ];
            if ($role_aktif == 'opd') :
                $input['publish'] = '0';
            endif;
            $save = $this->DataHandle->update('ms_dataset', $input, $where);
            if ($save) :
                $where_dataset = [
                    'id_dataset' => $input['id']
                ];
                $input_detail['id_dataset'] = $input['id'];
                $input_detail['updated_by'] = $created_by;
                $input_detail['status'] = 1;

                $this->DataHandle->update('ms_detail_dataset', $input_detail, $where_dataset);
                $response = [
                    'status' => 20,
                    'msg' => '
					<div class="alert alert-success alert-dismissible fade show" role="alert">
						<button type="button" class="close" data-dismiss="alert" aria-label="Close">
							<span aria-hidden="true">×</span>
						</button>
						<strong>Berhasil!</strong> Data Berhasil diubah!
					</div>',
                ];
            endif;
        elseif ($aksi == 'hapus') :
            $where = [
                'id' => $input['id']
            ];
            $data['status'] = 0;
            $save = $this->DataHandle->update('ms_dataset', $data, $where);
            if ($save) :
                $response = [
                    'status' => 20,
                    'msg' => '
					<div class="alert alert-success alert-dismissible fade show" role="alert">
						<button type="button" class="close" data-dismiss="alert" aria-label="Close">
							<span aria-hidden="true">×</span>
						</button>
						<strong>Berhasil!</strong> Data Berhasil dihapus!
					</div>',
                ];
            endif;
        endif;
        echo json_encode($response);
        die;
    }
}

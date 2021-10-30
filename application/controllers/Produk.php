<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Produk extends CI_Controller
{

    var $column_order = array(null, 'nama_produk', 'harga_beli', 'harga_jual', 'qty', 'status', 'img', 'kategori', 'created_at', 'created_by', 'updated_at', 'updated_by'); //set column field database for datatable orderable
    var $column_search = array('nama_produk', 'harga_beli', 'harga_jual', 'qty', 'status', 'img', 'kategori', 'created_at', 'created_by', 'updated_at', 'updated_by'); //set column field database for datatable searchable 
    var $order = array('created_at' => 'asc'); // default order


    function __construct()
    {
        parent::__construct();

        $array_akses_boleh = ['su'];

        if (!in_array($this->session->userdata('role'), $array_akses_boleh)) {
            $this->session->set_flashdata('msg', '<script>Swal.fire("Oops..", "Masukkan NIP dan Password dengan Benar!", "error"); </script>');
            redirect('Login');
        }
    }

    public function index()
    {
        $data['pengelolaan'] = 'Produk';
        $data['title_page'] = 'Master ' . $data['pengelolaan'];
        $this->template->back_end('back_end/produk/index', $data);
    }

    public function get()
    {
        $list = $this->M_Datatable->get_datatables(
            'ms_produk',
            $this->column_order,
            $this->column_search,
            $this->order,
            '*',
            "status = '1'"
        );
        // echo json_encode($list);die;

        $data = array();
        $no = $_POST['start'];

        foreach ($list as $row) {
            $baris = array();
            $no = $no + 1;
            $baris[] = $no;
            $baris[] = $row->kategori;
            $baris[] = $row->nama_produk;
            $baris[] = $row->harga_beli;
            $baris[] = $row->harga_jual;
            $baris[] = $row->qty;
            $baris[] = $row->created_at;
            $baris[] = $row->updated_at;
            $edit = '<button class="btn btn-info mr-2" onclick="edit(' . $row->id . ')"><i class="fa fa-pencil-alt"></i></button>';
            $hapus = '<button class="btn btn-danger" onclick="hapus(' . $row->id . ')"><i class="fa fa-trash-alt"></i></button>';
            $baris[] = $edit . $hapus;

            $data[] = $baris;
        }

        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->M_Datatable->count_all(
                'ms_produk',
                $this->column_order,
                $this->column_search,
                $this->order,
                '*',
                "status = '1'"
            ),
            "recordsFiltered" => $this->M_Datatable->count_filtered(
                'ms_produk',
                $this->column_order,
                $this->column_search,
                $this->order,
                '*',
                "status = '1'"
            ),
            "data" => $data,
        );
        //output to json format

        echo json_encode($output);
    }

    public function form()
    {
        $data['pengelolaan'] = 'Tambah Produk';
        $data['title_page'] = 'Form ' . $data['pengelolaan'];
        $this->load->view('back_end/produk/add', $data);
    }

    public function formEdit($id = null)
    {
        $data['pengelolaan'] = 'Edit Produk';
        $data['title_page'] = 'Form ' . $data['pengelolaan'];
        $data['produk'] = $this->DataHandle->getAllWhere('ms_produk', '*', "status = '1' AND id = '" . $id . "'")->row_array();
        $data['kategori'] = $this->DataHandle->getAllWhere('ms_kategori', '*', "status = '1'")->result();
        $this->load->view('back_end/produk/edit', $data);
    }

    public function act($aksi = null)
    {
        $this->load->library('upload');
        $input = $this->input->post();
        if ($aksi == 'add') :
            $cek = $this->DataHandle->getAllWhere('ms_produk', 'id', "status = '1' AND nama_produk = '" . $input['nama_produk'] . "'")->num_rows();
            if ($cek > 0) :
                $response = [
                    'status' => 0,
                    'msg' => '
					<div class="alert alert-danger alert-dismissible fade show" role="alert">
						<button type="button" class="close" data-dismiss="alert" aria-label="Close">
							<span aria-hidden="true">×</span>
						</button>
						<strong>Maaf!</strong> Nama Topik sudah pernah ada!
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
                $nama_file_baru = strtolower(str_replace(" ", "-", $input['nama_produk'])) . date('his') . "." . $ext_file;

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

                    $input['img'] = $nama_file_baru;
                } else {

                    echo json_encode($this->upload->display_errors());
                    die;
                    $response = array(
                        'status' => 0,
                        'msg' => '
						<div class="alert alert-danger alert-dismissible fade show" role="alert">
							<button type="button" class="close" data-dismiss="alert" aria-label="Close">
								<span aria-hidden="true">×</span>
							</button>
							<strong>Maaf!</strong> Gagal mengupload foto. Silahkan diulang kembali dengan format .jpg / .png / .jpeg 
						</div>',
                        'return_url' => '#'
                    );
                    echo json_encode($response);
                    die();
                }
            }

            $input['status'] = 1;
            $save = $this->DataHandle->insert('ms_produk', $input);
            if ($save) :
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
        elseif ($aksi == 'edit') :
            $cek = $this->DataHandle->getAllWhere('ms_produk', 'id', "status = '1' AND nama_produk = '" . $input['nama_produk'] . "' AND id != '" . $input['id'] . "'")->row_array();
            if ($cek > 0) :
                $response = [
                    'status' => 0,
                    'msg' => '
				<div class="alert alert-danger alert-dismissible fade show" role="alert">
					<button type="button" class="close" data-dismiss="alert" aria-label="Close">
						<span aria-hidden="true">×</span>
					</button>
					<strong>Maaf!</strong> Nama Topik sudah pernah ada!
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
                $nama_file_baru = strtolower(str_replace(" ", "-", $input['nama_produk'])) . date('his') . "." . $ext_file;

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

                    $input['img'] = $nama_file_baru;
                } else {
                    $response = array(
                        'status' => 0,
                        'msg' => '
						<div class="alert alert-success alert-dismissible fade show" role="alert">
							<button type="button" class="close" data-dismiss="alert" aria-label="Close">
								<span aria-hidden="true">×</span>
							</button>
							<strong>Berhasil!</strong> Data Berhasil diubah!
						</div>'
                    );
                    echo json_encode($response);
                    die();
                }
            }

            $where = [
                'id' => $input['id']
            ];
            $save = $this->DataHandle->update('ms_produk', $input, $where);
            if ($save) :
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
            $save = $this->DataHandle->update('ms_produk', $data, $where);
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

    private function set_upload_options()
    {
        $config['upload_path'] = PATH_FILE;
        $config['allowed_types'] = 'jpg|JPG|jpeg|JPEG|png|PNG';
        $config['max_size'] = 0;
        $config['encrypt_name'] = FALSE;
        $config['overwrite']     = TRUE;

        return $config;
    }
}

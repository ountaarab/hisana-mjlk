<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User extends CI_Controller
{

    var $column_order = array(null, 'nip', 'nama_lengkap', 'jabatan', 'status', 'role', 'created_at', 'created_by', 'updated_at', 'updated_by'); //set column field database for datatable orderable
    var $column_search = array('nip', 'nama_lengkap', 'jabatan', 'status', 'role', 'created_at', 'created_by', 'updated_at', 'updated_by'); //set column field database for datatable searchable 
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
        $data['pengelolaan'] = 'User';
        $data['title_page'] = 'Master ' . $data['pengelolaan'];
        $this->template->back_end('back_end/user/index', $data);
    }

    public function cari_nip()
    { //getNip
        $input = $this->input->post(null, true);
        $cek = $this->DataHandle->getAllWhere('ms_user', 'id', "status = '1' AND nip = '" . $input['nip'] . "'")->num_rows();
        if ($cek > 0) :
            $response = [
                'status' => 0,
                'tipe' => 'info',
                'msg' => '
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                    <strong>Maaf!</strong> NIP sudah pernah ada!
                </div>',
            ];
            echo json_encode($response);
            die;
        endif;
        $client = new GuzzleHttp\Client(['verify' => false]);
        $response = $client->request('POST', API_OPEN_DATA, [
            'auth' => ['open_data', 'opendata2021##'],
            'form_params' => [
                'nip_pegawai' => $input['nip'],
            ],
        ]);
        $response_1 = json_decode($response->getBody()->getContents(), true);
        $response_2 = json_decode(base64_decode($response_1['data']), true);
        if ($response_2 == null) :
            $response = [
                'status' => 0,
                'msg' => 'NIP Tidak Ditemukan',
            ];
            echo json_encode($response);
            die;
        endif;

        $passphrase = '2112616d706c65206865782064612112';

        $secret_key = hex2bin($passphrase);

        $json = $response_2;
        $iv = base64_decode($json['iv']);


        $encrypted_64 = $json['data'];
        $data_encrypted = base64_decode($encrypted_64);
        $decrypted = openssl_decrypt($data_encrypted, 'aes-256-cbc', $secret_key, OPENSSL_RAW_DATA, $iv);

        $data_new = json_decode($decrypted, true);
        $jabatan = '';
        if (count($data_new['jabatan']) < 1) :
            $jabatan = '';
        else :
            $jabatan = $data_new['jabatan'][0]['nama'];
        endif;


        $id_skpd = $data_new['skpd']['id_skpd'];
        $nama_skpd = strtoupper($data_new['skpd']['nama']);
        $singkatan_skpd = strtolower($data_new['skpd']['singkatan']);

        $cek_skpd = $this->DataHandle->getAllWhere('ms_opd', 'id', "id = '" . $id_skpd . "'")->num_rows();
        if ($cek_skpd < 1) :
            $input_skpd = [
                'nama' => $nama_skpd,
                'id' => $id_skpd,
                'alias' => $singkatan_skpd,
                'status' => 1
            ];
            $this->DataHandle->insert('ms_opd', $input_skpd);
        else :
            $kondisi = [
                'id' => $id_skpd,
            ];
            $input_skpd = [
                'nama' => $nama_skpd,
                'alias' => $singkatan_skpd,
                'status' => 1
            ];
            $this->DataHandle->update('ms_opd', $input_skpd, $kondisi);
        endif;
        $nama_lengkap = $data_new['gelar_depan'] . " " . $data_new['nama_pegawai'] . " " . $data_new['gelar_belakang'];
        $data_new1 = [
            'nip' => $data_new['nip'],
            'nama_orang' => $data_new['nama_pegawai'],
            'nama_pegawai' => $nama_lengkap,
            'jabatan' =>  $jabatan,
            'id_opd' => $data_new['skpd']['id_skpd'],
            'opd' => $data_new['skpd']['nama'],
            'gelar_depan' => $data_new['gelar_depan'],
            'gelar_belakang' => $data_new['gelar_belakang'],
        ];
        $status_pegawai = $data_new['status'];
        if ($status_pegawai != 'active') :
            $status_pegawai = 0;
        else :
            $status_pegawai = 1;
        endif;
        $response = [
            'status' => 20,
            'status_pegawai' => $status_pegawai,
            'msg' => 'Data Ditemukan',
            'data' => $data_new1
        ];
        echo json_encode($response);
        die;
    }

    public function get()
    {
        $list = $this->M_Datatable->get_datatables(
            'v_user_opd',
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
            $baris[] = $row->nip;
            $baris[] = $row->nama_lengkap . "<br>" . $row->nama_opd;
            $baris[] = $row->jabatan;
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
                'v_user_opd',
                $this->column_order,
                $this->column_search,
                $this->order,
                '*',
                "status = '1'"
            ),
            "recordsFiltered" => $this->M_Datatable->count_filtered(
                'v_user_opd',
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
        $data['pengelolaan'] = 'Tambah User';
        $data['title_page'] = 'Form ' . $data['pengelolaan'];
        $data['opd'] = $this->DataHandle->getAllWhere('ms_opd', 'id, nama', "status = '1'");
        $this->load->view('back_end/user/add', $data);
    }

    public function formEdit($id = null)
    {
        $data['pengelolaan'] = 'Edit User';
        $data['title_page'] = 'Form ' . $data['pengelolaan'];
        $data['user'] = $this->DataHandle->getAllWhere('ms_user', '*', "status = '1' AND id = '" . $id . "'")->row_array();
        $data['opd'] = $this->DataHandle->getAllWhere('ms_opd', 'id, nama', "status = '1'");
        $this->load->view('back_end/user/edit', $data);
    }

    public function act($aksi = null)
    {
        $created_by = $this->session->userdata('nip');
        $input = $this->input->post();
        if ($aksi == 'add') :
            $cek = $this->DataHandle->getAllWhere('ms_user', 'id', "status = '1' AND nip = '" . $input['nip'] . "'")->num_rows();
            if ($cek > 0) :
                $response = [
                    'status' => 0,
                    'msg' => '
					<div class="alert alert-danger alert-dismissible fade show" role="alert">
						<button type="button" class="close" data-dismiss="alert" aria-label="Close">
							<span aria-hidden="true">×</span>
						</button>
						<strong>Maaf!</strong> NIP sudah pernah ada!
					</div>',
                ];
                echo json_encode($response);
                die;
            endif;

            if ($input['password'] != $input['repassword']) :
                $response = [
                    'status' => 0,
                    'msg' => '
					<div class="alert alert-danger alert-dismissible fade show" role="alert">
						<button type="button" class="close" data-dismiss="alert" aria-label="Close">
							<span aria-hidden="true">×</span>
						</button>
						<strong>Maaf!</strong> Password dan Konfirmasi harus sesuai!
					</div>',
                ];
                echo json_encode($response);
                die;
            endif;
            $input['created_by'] = $created_by;

            if ($input['tipe'] == '2') :

                $masuk = [
                    'nip' => $input['nip'],
                    'password' => $this->hash_password($input['password']),
                    'nama_lengkap' => $input['nama_lengkap'],
                    'jabatan' => $input['jabatan'],
                    'id_opd' => $input['id_opd'],
                    'tipe' => $input['tipe'],
                    'status' => 1,
                    'role' => $input['role'],
                ];
            else :

                $masuk = [
                    'nip' => $input['nip'],
                    'password' => $this->hash_password($input['password']),
                    'nama_lengkap' => $input['nama_orang'],
                    'gelar_depan' => $input['gelar_depan'],
                    'gelar_belakang' => $input['gelar_belakang'],
                    'jabatan' => $input['jabatan'],
                    'id_opd' => $input['id_opd'],
                    'tipe' => $input['tipe'],
                    'status' => 1,
                    'role' => $input['role'],
                ];
            endif;
            $masuk['created_by'] = $created_by;
            $save = $this->DataHandle->insert('ms_user', $masuk);
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
            $cek = $this->DataHandle->getAllWhere('ms_user', 'id', "status = '1' AND nip = '" . $input['nip'] . "' AND id != '" . $input['id'] . "'")->row_array();
            if ($cek > 0) :
                $response = [
                    'status' => 0,
                    'msg' => '
				<div class="alert alert-danger alert-dismissible fade show" role="alert">
					<button type="button" class="close" data-dismiss="alert" aria-label="Close">
						<span aria-hidden="true">×</span>
					</button>
					<strong>Maaf!</strong> NIP sudah pernah ada!
				</div>',
                ];
                echo json_encode($response);
                die;
            endif;
            $input['updated_by'] = $created_by;

            $where = [
                'id' => $input['id']
            ];
            $save = $this->DataHandle->update('ms_user', $input, $where);
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
            $data['updated_by'] = $created_by;
            $data['status'] = 0;
            $save = $this->DataHandle->update('ms_user', $data, $where);
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

    private function hash_password($password)
    {
        return password_hash($password, PASSWORD_BCRYPT);
    }
}

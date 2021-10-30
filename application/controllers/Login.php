<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Login extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
    }

    public function index()
    {

        $array_akses_boleh = ['opd', 'su', 'wd'];

        if (in_array($this->session->userdata('role'), $array_akses_boleh)) {
            $this->session->set_flashdata('msg', '<script>Swal.fire("Maaf..", "Logout dahulu untuk keluar dari aplikasi", "info"); </script>');
            redirect('Welcome');
        }

        $this->load->helper('captcha');
        $kata = rand(10000, 99999);
        $c1 = rand(100, 255);
        $c2 = rand(100, 255);
        $c3 = rand(100, 255);
        $vals = array(
            'word'          => $kata,
            'img_path'      => FCPATH . 'captcha/',
            'img_url'       => base_url() . 'captcha/',
            'font_path'     => FCPATH . 'system/fonts/texb.ttf',
            'img_width'     => '200',
            'img_height'    => 55,
            'expiration'    => 3600,
            'word_length'   => 8,
            'font_size'     => 30,
            'img_id'        => 'Imageid',
            'pool'          => '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ',

            // White background and border, black text and random grid
            'colors'        => array(
                'background' => array(255, 255, 255),
                'border' => array(255, 255, 255),
                'text' => array(0, 0, 0),
                'grid' => array($c1, $c2, $c3)
            )
        );

        $cap = create_captcha($vals);

        if ($this->session->userdata('captcha_code') != null) {
            $this->session->unset_userdata('captcha_code');
        }
        if ($this->session->userdata('captcha_filename') != null) {
            $this->session->unset_userdata('captcha_filename');
        }
        $this->session->set_userdata('captcha_code', $cap['word']);
        $this->session->set_userdata('captcha_filename', $cap['filename']);
        $data['img_captcha'] = $cap['filename'];
        $data['captcha_full'] = $cap;
        $this->load->view('back_end/login/index', $data);
    }


    function captcha_refresh() /* ref_cap */
    {

        $this->load->helper('captcha');
        $kata = rand(10000, 99999);
        $c1 = rand(100, 255);
        $c2 = rand(100, 255);
        $c3 = rand(100, 255);
        $vals = array(
            'word'          => $kata,
            'img_path'      => FCPATH . 'captcha/',
            'img_url'       => base_url() . 'captcha/',
            'font_path'     => FCPATH . 'system/fonts/texb.ttf',
            'img_width'     => '200',
            'img_height'    => 55,
            'expiration'    => 3600,
            'word_length'   => 8,
            'font_size'     => 30,
            'img_id'        => 'Imageid',
            'pool'          => '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ',

            // White background and border, black text and random grid
            'colors'        => array(
                'background' => array(255, 255, 255),
                'border' => array(255, 255, 255),
                'text' => array(0, 0, 0),
                'grid' => array($c1, $c2, $c3)
            )
        );

        $cap = create_captcha($vals);
        $this->session->unset_userdata('captcha_code');
        $this->session->unset_userdata('captcha_filename');
        $this->session->set_userdata('captcha_code', $cap['word']);
        $this->session->set_userdata('captcha_filename', $cap['filename']);
        echo $cap['image'];
    }

    public function get_data()
    {
        // cek
        $input = $this->input->post(null, true);
        $captcha_code = $this->session->userdata('captcha_code');
        if ($captcha_code != $input['text_capctha']) :
            $response = [
                'status' => 0,
                'message' => "Kode Captcha Tidak Sesuai",
                'tipe' => "info",
                'title' => "Login gagal",
            ];
            echo json_encode($response);
            die;
        endif;

        $where = [
            'nip' => $input['nip'],
        ];

        $cek = $this->DataHandle->getAllWhere('ms_user', '*', $where);



        if ($cek->num_rows() > 0) :
            $user = $cek->row_array();
            $hash_db = $user['password'];
            if (password_verify($input['password'], $hash_db)) :

                $id = $user['id'];
                $id_opd = $user['id_opd'];
                $nama_lengkap = $user['nama_lengkap'];
                $nip = $user['nip'];
                $tipe = $user['tipe'];
                $jabatan = $user['jabatan'];
                $role = $user['role'];
                $status = $user['status'];

                if ($status != 1) :
                    $response = [
                        'status' => 0,
                        'message' => "Akun Anda sedang tidak aktif hubungi Diskominfo",
                        'tipe' => "info",
                        'title' => "Auth gagal",
                    ];
                    echo json_encode($response);
                    die;
                endif;

                $data_session = array(
                    'id' => $id,
                    'id_opd' => $id_opd,
                    'id_opd' => $id_opd,
                    'nama_lengkap' => $nama_lengkap,
                    'nip' => $nip,
                    'tipe' => $tipe,
                    'jabatan' => $jabatan,
                    'role' => $role,
                );

                $this->session->set_userdata($data_session);
                $response = [
                    'status' => 20,
                    'message' => "Selamat datang " . $nama_lengkap,
                    'tipe' => "success",
                    'title' => "Auth Sukses",
                    'return_url' => base_url('Welcome'),
                ];

            else :
                $response = [
                    'status' => 0,
                    'message' => "Password Tidak Sesuai",
                    'tipe' => "info",
                    'title' => "Auth gagal",
                ];
                echo json_encode($response);
                die;
            endif;
        else :
            $response = [
                'status' => 0,
                'message' => "NIP atau Password Tidak Sesuai",
                'tipe' => "info",
                'title' => "Auth gagal",
            ];
        endif;
        echo json_encode($response);
        die;
    }

    public function out()
    {
        //Logout
        $session_items = array(
            'id',
            'id_opd',
            'tipe',
            'nama_lengkap',
            'nip',
            'jabatan',
            'role',
        );
        $this->session->unset_userdata($session_items);
        redirect('Login');
    }
}

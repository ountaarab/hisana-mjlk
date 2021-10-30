<?php
defined('BASEPATH') or exit('No direct script access allowed');

use chriskacerguis\RestServer\RestController;

class MasterCT extends RestController
{

    function __construct()
    {
        // Construct the parent class
        parent::__construct();
        $this->load->helper('convert');
        $this->load->model('DataHandle', 'dataHandle');
    }

    public function topik_get()
    {
        $topik = $this->dataHandle->get('ms_topik', ['status' => 1])->result();
        $response = [];
        foreach ($topik as $dt) :
            $periksa_dulu = ($dt->img == NULL) ? 'default.png' : $dt->img;
            $response[] = [
                'id' => $dt->id,
                "nama_topik" => $dt->nama_topik,
                "slug" => str_replace(' ', '-', str_replace('& ', '', strtolower(trim($dt->nama_topik)))),
                "status" => $dt->status,
                "img" => base_url('uploads/image/') . $periksa_dulu,
                "created_at" => $dt->created_at,
                "created_by" => $dt->created_by,
                "updated_at" => $dt->updated_at,
                "updated_by" => $dt->updated_by
            ];
        endforeach;
        if (count($response) > 0) {
            $slug = $this->get('slug');

            if ($slug === null) {
                $this->response([
                    'status' => true,
                    'message' => 'Data found',
                    'count' => count($response),
                    'data' => $response
                ], 200);
            } else {
                $keys = 'salah';
                foreach ($response as $key => $res) :
                    $arr_search = array_search($slug, $res);
                    if ($arr_search != FALSE) {
                        $keys = $key;
                        $this->response([
                            'status' => true,
                            'message' => 'Data found',
                            'count' => count($response[$keys]),
                            'data' => $response[$keys]
                        ], 200);
                    }
                endforeach;
                if ($keys == 'salah') {
                    $this->response([
                        'status' => false,
                        'message' => 'Data not found',
                        'count' => 0
                    ], 404);
                }
            }
        } else {
            $this->response([
                'status' => false,
                'message' => 'Data not found',
                'count' => 0
            ], 404);
        }
    }

    public function organisasi_get()
    {
        $kondisi = ['status' => 1];
        $alias = $this->get('alias');
        $id_opd = $this->get('id_opd');
        if ($alias) {
            $kondisi['alias'] = $alias;
        }
        if ($id_opd) {
            $kondisi['id'] = $id_opd;
        }
        $organisasi = $this->dataHandle->get('ms_opd', $kondisi)->result();
        $response = [];
        foreach ($organisasi as $opd) :
            $periksa_dulu = ($opd->img == NULL) ? 'default.png' : $opd->img;
            $response[] = [
                'id' => $opd->id,
                "nama_organisasi" => $opd->nama,
                "alias" => $opd->alias,
                "alamat" => $opd->alamat,
                "img" => base_url('uploads/image/') . $periksa_dulu,
                "no_telp" => $opd->no_telepon,
                "created_at" => $opd->created_at,
                "created_by" => $opd->created_by,
                "updated_at" => $opd->updated_at,
                "updated_by" => $opd->updated_by
            ];
        endforeach;
        if (count($response) > 0) {
            $this->response([
                'status' => true,
                'message' => 'Data found',
                'count' => count($response),
                'data' => $response
            ], 200);
        } else {
            $this->response([
                'status' => false,
                'message' => 'Data not found',
                'count' => 0
            ], 404);
        }
    }
}

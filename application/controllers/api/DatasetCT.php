<?php
defined('BASEPATH') or exit('No direct script access allowed');

use chriskacerguis\RestServer\RestController;

class DatasetCT extends RestController
{

    function __construct()
    {
        // Construct the parent class
        parent::__construct();
        $this->load->helper('convert');
        $this->load->model('DataHandle', 'dataHandle');
        $this->load->database();
        header('Access-Control-Allow-Origin: *');
        header("Access-Control-Allow-Headers: X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method, Authorization");
        header("Access-Control-Allow-Methods: GET, POST");
    }

    public function all_get()
    {
        $kondisi = ['status' => 1, 'publish' => 1];
        $slug = $this->get('slug');
        $id_opd = $this->get('id_opd');
        $id_topik = $this->get('id_topik');
        $slug_topik = $this->get('slug_topik');
        $urut = $this->get('sort');
        $page = $this->get('page');
        $order = 'published_date desc';
        if ($slug) {
            $kondisi['slug'] = $slug;
        }
        if ($id_opd) {
            $kondisi['id_opd'] = $id_opd;
        }
        if ($id_topik) {
            $kondisi['id_topik'] = $id_topik;
        }
        if ($slug_topik) {
            $kondisi['slug_topik'] = $slug_topik;
        }
        if ($urut) {
            switch ($urut) {
                case 'abjad':
                    $order = 'judul asc';
                    break;
                case 'populer':
                    $order = 'views desc';
                    break;
                case 'baru':
                    $order = 'published_date desc';
                    break;

                default:
                    $order = 'published_date desc';
                    break;
            }
        }
        $start = null;
        $limit = null;
        // if ($page) {
        //     $start = 0;
        //     $limit = 10;
        //     if ($page > 1) {
        //         $start = ($limit * $page) - $limit;
        //     }
        // }
        $dataset = $this->dataHandle->getAllWhereLimm('v_dataset', '*', $kondisi, $order, $limit, $start)->result();
        $response = [];
        foreach ($dataset as $dt) :
            $periksa_file = ($dt->file == NULL) ? 'default.csv' : $dt->file;
            $file_img_opd = ($dt->img_opd == NULL) ? 'default.png' : $dt->img_opd;
            $response[] = [
                'id' => $dt->id,
                'judul' => $dt->judul,
                "slug" => $dt->slug,
                "id_opd" => $dt->id_opd,
                "nama_opd" => $dt->nama_opd,
                "alias" => $dt->alias,
                "img_opd" => base_url('uploads/image/') . $file_img_opd,
                "file" => base_url('ddl_dataset/') . en_crypt($dt->id_file),
                "id_topik" => $dt->id_topik,
                "nama_topik" => $dt->nama_topik,
                "slug_topik" => $dt->slug_topik,
                "img_topik" => base_url('uploads/image/') . $dt->img_topik,
                'pengukuran' => $dt->pengukuran,
                'satuan' => $dt->satuan,
                'versi' => $dt->versi,
                'tahun_tersedia' => $dt->tahun_tersedia,
                'format_tersedia' => json_decode($dt->format_tersedia),
                'deskripsi' => $dt->deskripsi,
                'tingkat_penyajian' => $dt->tingkat_penyajian,
                'cakupan' => $dt->cakupan,
                'frekuensi' => $dt->frekuensi,
                'views' => (int) $dt->views,
                'published_date' => $dt->published_date,
                'created_at' => $dt->created_at,
                'updated_at' => $dt->updated_at
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
    public function detail_get()
    {
        $kondisi = ['status' => 1, 'publish' => 1];
        $slug = $this->get('slug');
        $id_opd = $this->get('id_opd');

        if (count($this->get()) == 0 || $slug == '' || $slug == NULL) {
            $this->response([
                'status' => false,
                'message' => 'Parameter tidak ditemukan',
                'count' => 0
            ], 404);
            die;
        }
        if (isset($slug) && $slug != '' && $slug != NULL) {
            $kondisi['slug'] = $slug;
        }
        if ($id_opd) {
            $kondisi['id_opd'] = $id_opd;
        }


        $dataset = $this->dataHandle->get('v_dataset', $kondisi)->row();
        if ($dataset) :
            $views_awal = ((int) $dataset->views) + 1;
            $data = ['views' => $views_awal];
            $this->dataHandle->update('ms_dataset', $data, $kondisi);
            $response = [];
            $periksa_file = ($dataset->file == NULL) ? 'default.csv' : $dataset->file;
            $file_img_opd = ($dataset->img_opd == NULL) ? 'default.png' : $dataset->img_opd;
            $response = [
                'id' => $dataset->id,
                'judul' => $dataset->judul,
                "slug" => $dataset->slug,
                "id_opd" => $dataset->id_opd,
                "nama_opd" => $dataset->nama_opd,
                "alias" => $dataset->alias,
                "img_opd" => base_url('uploads/image/') . $file_img_opd,
                "file" => base_url('ddl_dataset/') . en_crypt($dataset->id_file),
                "id_topik" => $dataset->id_topik,
                "nama_topik" => $dataset->nama_topik,
                "img_topik" => base_url('uploads/image/') . $dataset->img_topik,
                'pengukuran' => $dataset->pengukuran,
                'satuan' => $dataset->satuan,
                'versi' => $dataset->versi,
                'tahun_tersedia' => $dataset->tahun_tersedia,
                'format_tersedia' => json_decode($dataset->format_tersedia),
                'deskripsi' => $dataset->deskripsi,
                'tingkat_penyajian' => $dataset->tingkat_penyajian,
                'cakupan' => $dataset->cakupan,
                'frekuensi' => $dataset->frekuensi,
                'views' => $views_awal,
                'published_date' => $dataset->published_date,
                'created_at' => $dataset->created_at,
                'updated_at' => $dataset->updated_at
            ];
            $preview = csv2Json('./uploads/data/' . $periksa_file);

            if (count($response) > 0) {

                $this->response([
                    'status' => true,
                    'message' => 'Data found',
                    'count' => ($preview != NULL) ? count($preview) : 0,
                    'data' => $response,
                    'dataset' => $preview
                ], 200);
            } else {
                $this->response([
                    'status' => false,
                    'message' => 'Data not found',
                    'count' => 0
                ], 404);
            }
        else :
            $this->response([
                'status' => false,
                'message' => 'Data not found',
                'count' => 0
            ], 404);
        endif;
    }
}

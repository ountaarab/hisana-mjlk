<?php $controller_name = $this->uri->segment(1);
$role_aktif = $this->session->userdata('role');
$id_opd = $this->session->userdata('id_opd');
?>
<div class="content">
    <div id="notif-apps">
    </div>
    <div class="container-fluid" id="tujuan"></div>
    <div class="container-fluid" id="utama">

        <div class="row">
            <div class="col-sm-12">
                <div class="page-title-box">
                    <h4 class="page-title"><?= $title_page ?></h4>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="javascript:void(0);">Dashboard</a></li>
                        <li class="breadcrumb-item active"><?= $pengelolaan ?></li>
                    </ol>
                </div>
            </div>
        </div>
        <!-- end row -->

        <div class="row">
            <div class="col-12">
                <div class="card m-b-20">
                    <div class="card-body">
                        <div class="row">
                            <?php
                            if ($role_aktif == 'opd') :
                                $style = 'col-4 text-left mt-4';
                            ?>
                                <input type="hidden" id="id_opd_filter" value="<?= $id_opd ?>">
                                <?php
                            else :
                                $style = 'col-12 text-right';

                                if ($opd->num_rows() > 0) :
                                ?>
                                    <div class="col-4">
                                        <div class="form-group">
                                            <label>OPD</label>
                                            <select name="id_opd" id="id_opd_filter" class="form-control select2">
                                                <option value="-">-Semua-</option>
                                                <?php
                                                foreach ($opd->result() as $baris) :
                                                ?>
                                                    <option value="<?= $baris->id ?>"><?= $baris->nama ?></option>
                                                <?php
                                                endforeach;
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                            <?php
                                endif;
                            endif;
                            ?>
                            <?php
                            if ($topik->num_rows() > 0) :
                            ?>
                                <div class="col-4">
                                    <div class="form-group">
                                        <label>Topik</label>
                                        <select name="id_topik" id="id_topik_filter" class="form-control select2">
                                            <option value="-">-Semua-</option>
                                            <?php
                                            foreach ($topik->result() as $baris) :
                                            ?>
                                                <option value="<?= $baris->id ?>"><?= $baris->nama_topik ?></option>
                                            <?php
                                            endforeach;
                                            ?>
                                        </select>
                                    </div>
                                </div>
                            <?php
                            endif;
                            ?>
                            <div class="col-4">
                                <div class="form-group">
                                    <label>Status</label>
                                    <select name="status" class="form-control select2" id="status">
                                        <option value="-">-Semua-</option>
                                        <option value="0">Menunggu Persetujuan</option>
                                        <option value="1">Sudah Publish</option>
                                        <option value="-1">Ditolak untuk diperbaiki</option>
                                    </select>
                                </div>
                            </div>
                            <div class="<?= $style ?>">
                                <div class="form-group">
                                    <button id="btn_cari_data" class="btn btn-primary" onclick="view()"><i class="fa fa-search mr-1"></i>Cari</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card m-b-20">
                    <div class="card-body">
                        <button class="btn btn-primary mb-2" onclick="add()"><i class="fa fa-plus"></i> Dataset</button>
                        <table id="datatable-buttons" class="table table-striped table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>Produsen/Judul/Pengukuran</th>
                                    <th>Tanggal</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div> <!-- end col -->
        </div> <!-- end row -->


        <!--  Modal content for the above example -->
        <div class="modal fade modal-detail" tabindex="-1" role="dialog" aria-labelledby="MyDetailModal" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content" style="width: 145%; margin-left:-160px">
                    <div class="modal-header">
                        <h5 class="modal-title mt-0" id="MyDetailModal">Detail Dataset</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    </div>
                    <div class="modal-body" id="detail-modal-data">
                    </div>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->

        <!--  Modal content for the above example -->
        <div class="modal fade modal-verifikasi" id="MyVerifikasiModal" tabindex="-1" role="dialog" aria-labelledby="MyVerifikasiModal" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content" style="width: 145%; margin-left:-160px">
                    <div class="modal-header">
                        <h5 class="modal-title mt-0">Verifikasi Dataset</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    </div>
                    <div class="modal-body" id="verifikasi-modal-data">
                    </div>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->



    </div> <!-- container-fluid -->

</div> <!-- content -->

<script>
    $(document).ready(function() {
        view();
        $(".select2").select2();
    });

    function view() {
        let id_opd = $('#id_opd_filter').val();
        let id_topik = $('#id_topik_filter').val();
        let status = $('#status').val();
        $('#datatable-buttons').dataTable().fnDestroy();
        $('#datatable-buttons').DataTable({
            processing: true,
            serverSide: true,
            order: [],
            ajax: {
                "url": GLOBAL_C + '/get',
                "type": "POST",
                data: {
                    id_opd: id_opd,
                    id_topik: id_topik,
                    status: status,
                },
            }
        });
    }


    function add() {
        $('#notif-apps').html('');
        $.get(GLOBAL_C + '/form', function(result) {
            $('#utama').hide();
            $('#tujuan').show();
            $('#tujuan').html(result);
            $('#form-ajax')[0].reset();
        });
    }

    function edit(id) {
        $('#notif-apps').html('');
        $.get(GLOBAL_C + '/formedit/' + id, function(result) {
            $('#utama').hide();
            $('#tujuan').show();
            $('#tujuan').html(result);
        });
    }

    function detail(id) {
        $.get(GLOBAL_C + '/getDetail/' + id, function(result) {
            $('#detail-modal-data').html(result);
        });
    }

    function verifikasi(id) {
        $.get(GLOBAL_C + '/getVerifikasi/' + id, function(result) {
            $('#verifikasi-modal-data').html(result);
        });
    }

    function batal() {
        $('#utama').show();
        $('#tujuan').html('');
        $('#tujuan').hide();
    }

    function hapus(id) {

        Swal.fire({
            title: "Anda Yakin?",
            text: "Menghapus data terpilih?",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#ec536c",
            cancelButtonColor: "#bb7be3",
            confirmButtonText: "Ya hapus"
        }).then(function(result) {
            if (result.value) {
                $.ajax({
                    type: 'POST',
                    url: GLOBAL_C + '/act/hapus',
                    dataType: 'json',
                    data: {
                        id: id
                    },
                    success: function(data) {
                        $('#notif-apps').html('');
                        $('#notif-apps').html(data.msg);
                        setInterval(function() {
                            $('#notif-apps').html('');
                        }, 7000);
                        if (data.status == 20) {
                            view();
                            Swal.fire("Berhasil!", "Data Berhasil dihapus!", "success");
                        }
                    },
                    error: function(data) {

                    }
                });
            }
        });
    }
</script>
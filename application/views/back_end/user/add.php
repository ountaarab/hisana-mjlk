<?= $controller_name = $this->uri->segment(1); ?>
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
<div class="row" id="first">
    <div class="col-lg-6">
        <div class="card m-b-20">
            <div class="card-body">
                <button class="btn btn-danger mb-3" onclick="batal()"><i class="fa fa-reply"></i> Batal</button>
                <div class="form-group">
                    <label>Tipe Pegawai</label>
                    <select name="tipe-pegawai" id="tipe-pegawai" class="form-control">
                        <option>-PILIH-</option>
                        <option value="1">PNS / Pegawai Pemerintah</option>
                        <option value="2">Non-PNS</option>
                    </select>
                </div>
                <div class="form-group">
                    <button class="btn btn-primary" id="button_cari" onclick="pegawai_tipe()"><i class="fa fa-search" id="loadings"></i> Kirim</button>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row" id="pegawai-non-pns" style="display: none;">
    <div class="col-lg-6">
        <div class="card m-b-20">
            <div class="card-body">
                <button class="btn btn-danger mb-3" onclick="batal()"><i class="fa fa-reply"></i> Batal</button>
                <form method="POST" id="form-ajax-non" autocomplete="off" action="<?= base_url($controller_name . '/act/add') ?>" enctype="multipart/form-data">
                    <div class="form-group">
                        <label>NIP</label>
                        <input type="hidden" class="form-control" name="tipe" value="2" required />
                        <input type="text" class="form-control" name="nip" id="nip" required placeholder="" />
                    </div>
                    <div class="form-group">
                        <label>OPD</label>
                        <select name="id_opd" class="form-control select2">
                            <option>-Pilih-</option>
                            <?php
                            if (!empty($opd)) :
                                foreach ($opd->result() as $baris) :
                            ?>
                                    <option value="<?= $baris->id ?>"><?= $baris->nama ?></option>
                            <?php
                                endforeach;
                            endif;
                            ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Nama Lengkap</label>
                        <input type="text" class="form-control" name="nama_lengkap" id="nama_lengkap" required placeholder="" />
                    </div>
                    <div class="form-group">
                        <label>Jabatan</label>
                        <input type="text" class="form-control" name="jabatan" id="jabatan" required placeholder="" />
                    </div>
                    <div class="form-group">
                        <label>Role User</label>
                        <select class="form-control select2" name="role" required>
                            <option>Pilih</option>
                            <option value="su">Super User</option>
                            <option value="wd">Wali Data</option>
                            <option value="opd">Instansi Non Pemerintah</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Password</label>
                        <input type="password" class="form-control" name="password" id="password" required placeholder="Masukkan Password" />
                    </div>
                    <div class="form-group">
                        <label>Konfirmasi Password</label>
                        <input type="password" class="form-control" name="repassword" id="repassword" required placeholder="Masukkan Konfirmasi Password" />
                    </div>
                    <div class="form-group mb-0">
                        <div>
                            <button type="submit" id="button_submit" class="btn btn-primary waves-effect waves-light mr-1">
                                Simpan
                            </button>
                            <button type="reset" id="button_reset" class="btn btn-secondary waves-effect">
                                Reset
                            </button>
                        </div>
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>
<div class="row" id="pegawai-pns" style="display: none;">
    <div class="col-lg-6">
        <div class="card m-b-20">
            <div class="card-body">
                <button class="btn btn-danger mb-3" onclick="batal()"><i class="fa fa-reply"></i> Batal</button>
                <div class="form-group">
                    <label>NIP</label>
                    <input type="text" class="form-control" name="nip_pegawai" id="nip_pegawai" required placeholder="Masukkan NIP pegawai.." />
                </div>
                <div class="form-group">
                    <button class="btn btn-primary" id="button_cari-pns" onclick="cari_nik()"><i class="fa fa-search" id="loadings-pns"></i> Cari NIP</button>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-6">
        <div class="card m-b-20">
            <div class="card-body">
                <form method="POST" id="form-ajax-pns" autocomplete="off" action="<?= base_url($controller_name . '/act/add') ?>" enctype="multipart/form-data">
                    <div class="form-group">
                        <label>NIP</label>
                        <input type="hidden" class="form-control" name="tipe" value="1" required />
                        <input type="text" class="form-control" name="nip" id="nip_pns" required placeholder="" />
                    </div>
                    <div class="form-group">
                        <label>OPD</label>
                        <input type="text" class="form-control" name="nama_opd" id="nama_opd_pns" required placeholder="" />
                        <input type="hidden" class="form-control" name="id_opd" id="id_opd_pns" required placeholder="" />
                        <input type="hidden" class="form-control" name="gelar_depan" id="gelar_depan_pns" required placeholder="" />
                        <input type="hidden" class="form-control" name="gelar_belakang" id="gelar_belakang_pns" required placeholder="" />
                        <input type="hidden" class="form-control" name="nama_orang" id="nama_orang_pns" required placeholder="" />
                    </div>
                    <div class="form-group">
                        <label>Nama Lengkap</label>
                        <input type="text" class="form-control" name="nama_lengkap" id="nama_lengkap_pns" required placeholder="" />
                    </div>
                    <div class="form-group">
                        <label>Jabatan</label>
                        <input type="text" class="form-control" name="jabatan" id="jabatan_pns" required placeholder="" />
                    </div>
                    <div class="form-group">
                        <label>Role User</label>
                        <select class="form-control select2" name="role" required>
                            <option>Pilih</option>
                            <option value="su">Super User</option>
                            <option value="wd">Wali Data</option>
                            <option value="opd">OPD</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Password</label>
                        <input type="password" class="form-control" name="password" id="password_pns" required placeholder="Masukkan Password" />
                    </div>
                    <div class="form-group">
                        <label>Konfirmasi Password</label>
                        <input type="password" class="form-control" name="repassword" id="repassword_pns" required placeholder="Masukkan Konfirmasi Password" />
                    </div>
                    <div class="form-group mb-0">
                        <div>
                            <button type="submit" id="button_submit" class="btn btn-primary waves-effect waves-light mr-1">
                                Simpan
                            </button>
                            <button type="reset" id="button_reset" class="btn btn-secondary waves-effect">
                                Reset
                            </button>
                        </div>
                    </div>
                </form>

            </div>
        </div>
    </div> <!-- end col -->
</div>

<script>
    $(document).ready(function() {
        $(".select2").select2();
    });

    function disable_form() {
        $('#form-ajax-pns input').prop('readonly', true);
        $('#form-ajax-pns select').attr('readonly', true);
        $('#form-ajax-pns button').prop('disabled', true);
    }

    $('#form-ajax-non').submit(function(e) {
        $.ajax({
            type: 'POST',
            url: $(this).attr('action'),
            data: new FormData($(this)[0]),
            cache: false,
            contentType: false,
            processData: false,
            success: function(data) {
                data = JSON.parse(data);
                $('#notif-apps').html('');
                $('#notif-apps').html(data.msg);
                setInterval(function() {
                    $('#notif-apps').html('');
                }, 3000);
                if (data.status == 20) {
                    view();
                    batal();
                }
            },
            error: function(data) {

            }
        });
        e.preventDefault();
    });

    $('#form-ajax-pns').submit(function(e) {
        $.ajax({
            type: 'POST',
            url: $(this).attr('action'),
            data: new FormData($(this)[0]),
            cache: false,
            contentType: false,
            processData: false,
            success: function(data) {
                data = JSON.parse(data);
                $('#notif-apps').html('');
                $('#notif-apps').html(data.msg);
                setInterval(function() {
                    $('#notif-apps').html('');
                }, 3000);
                if (data.status == 20) {
                    view();
                    batal();
                }
            },
            error: function(data) {

            }
        });
        e.preventDefault();
    });

    function cari_nik() {
        $('#loadings-pns').removeClass('fa fa-search');
        $('#button_cari-pns').prop('disabled', true);
        $('#loadings-pns').addClass('fa fa-spinner fa-spin');
        let nip = $('#nip_pegawai').val()
        var data = {
            nip: nip
        };

        $.post("<?= base_url('getNip') ?>", data)
            .done(function(result) {
                result = JSON.parse(result);
                $('#button_cari-pns').prop('disabled', false);
                $('#loadings-pns').removeClass('fa fa-spinner fa-spin');
                $('#loadings-pns').addClass('fa fa-search');
                if (result.status == 20) {
                    $('#form-ajax-pns button').prop('disabled', false);
                    $('#form-ajax-pns select').attr('readonly', false);
                    $('#password_pns').prop('readonly', false);
                    $('#repassword_pns').prop('readonly', false);
                    $('#nip_pns').val(result.data.nip);
                    $('#nama_lengkap_pns').val(result.data.nama_pegawai);
                    $('#nama_orang_pns').val(result.data.nama_orang);
                    $('#jabatan_pns').val(result.data.jabatan);
                    $('#id_opd_pns').val(result.data.id_opd);
                    $('#nama_opd_pns').val(result.data.opd);
                    $('#gelar_depan_pns').val(result.data.gelar_depan);
                    $('#gelar_belakang_pns').val(result.data.gelar_belakang);
                }
                if (result.status == 0) {
                    Swal.fire("Maaf!", result.msg, result.tipe);
                }
            });
    }

    function pegawai_tipe() {
        let tipe = $('#tipe-pegawai').val();
        if (tipe == '1') {
            $('#pegawai-pns').show();
            disable_form();
        } else {
            $('#pegawai-non-pns').show();

        }
        $('#first').hide();
    }
</script>